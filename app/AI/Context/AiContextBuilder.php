<?php

namespace App\AI\Context;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AiContextBuilder
{
    public function build(User $user): array
    {
        return Cache::remember("ai:context:{$user->id}", now()->addSeconds(45), function () use ($user) {
            $tasks = Todo::query()
                ->where('user_id', $user->id)
                ->orderBy('is_completed')
                ->orderByRaw('deadline is null')
                ->orderBy('deadline')
                ->limit(80)
                ->get(['id', 'judul', 'deskripsi', 'deadline', 'priority', 'is_completed']);

            $now = now();
            $todayStart = $now->copy()->startOfDay();
            $todayEnd = $now->copy()->endOfDay();
            $monthStart = $now->copy()->startOfMonth();
            $monthEnd = $now->copy()->endOfMonth();
            $unfinished = $tasks->where('is_completed', false)->values();
            $overdue = $unfinished->filter(fn (Todo $todo) => $todo->deadline && $todo->deadline->lt($now))->values();
            $nearest = $unfinished->filter(fn (Todo $todo) => $todo->deadline && $todo->deadline->gte($now))->sortBy('deadline')->take(5)->values();
            $todayTasks = $tasks->filter(fn (Todo $todo) => $todo->deadline && $todo->deadline->betweenIncluded($todayStart, $todayEnd))->values();
            $monthTasks = $tasks->filter(fn (Todo $todo) => $todo->deadline && $todo->deadline->betweenIncluded($monthStart, $monthEnd))->values();
            $memory = DB::table('ai_memories')->where('user_id', $user->id)->value('summary');

            $monitoring = app(\App\Services\MonitoringService::class);
            $dash = [];
            try {
                $dash = $monitoring->dashboard();
            } catch (\Throwable $e) {
                // Keep empty
            }

            // Fetch newly registered users (limit 5)
            $newUsers = [];
            try {
                $newUsers = \App\Models\User::latest()
                    ->limit(5)
                    ->get()
                    ->map(fn($u) => [
                        'name' => $u->name,
                        'email' => $u->email,
                        'status' => $u->status,
                        'joined_at' => $u->created_at?->toIso8601String(),
                    ])->all();
            } catch (\Throwable $e) {}

            // Fetch recent audit logs safely
            $recentAuditLogs = [];
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('audit_logs')) {
                    $recentAuditLogs = \App\Models\AuditLog::with('actor')
                        ->latest()
                        ->limit(5)
                        ->get()
                        ->map(fn($log) => [
                            'actor' => $log->actor?->name ?? 'System',
                            'action' => $log->action,
                            'ip' => $log->ip_address,
                            'time' => $log->created_at?->toIso8601String(),
                        ])->all();
                }
            } catch (\Throwable $e) {}

            return [
                'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
                'memory' => $memory,
                'counts' => [
                    'unfinished' => $unfinished->count(),
                    'overdue' => $overdue->count(),
                    'completed' => $tasks->where('is_completed', true)->count(),
                ],
                'today_counts' => $this->countsFor($todayTasks, $now),
                'month_counts' => $this->countsFor($monthTasks, $now),
                'month_priority_counts' => [
                    'high' => $monthTasks->where('priority', 'high')->count(),
                    'medium' => $monthTasks->where('priority', 'medium')->count(),
                    'low' => $monthTasks->where('priority', 'low')->count(),
                ],
                'month_label' => $now->format('F Y'),
                'nearest_deadlines' => $nearest->map(fn (Todo $todo) => $this->taskPayload($todo))->values()->all(),
                'overdue_tasks' => $overdue->take(8)->map(fn (Todo $todo) => $this->taskPayload($todo))->values()->all(),
                'today_tasks' => $todayTasks->take(12)->map(fn (Todo $todo) => $this->taskPayload($todo))->values()->all(),
                'month_tasks' => $monthTasks->take(30)->map(fn (Todo $todo) => $this->taskPayload($todo))->values()->all(),
                'tasks' => $tasks->take(30)->map(fn (Todo $todo) => $this->taskPayload($todo))->values()->all(),
                'monitoring' => [
                    'active_users_daily' => $dash['active_users']['daily'] ?? 0,
                    'active_users_monthly' => $dash['active_users']['monthly'] ?? 0,
                    'total_interactions_daily' => $dash['api']['daily'] ?? 0,
                    'total_interactions_monthly' => $dash['api']['monthly'] ?? 0,
                    'security_status' => [
                        'flagged_users' => $dash['security']['flagged_users'] ?? 0,
                        'warning_users' => $dash['security']['warning_users'] ?? 0,
                        'banned_users' => $dash['security']['banned_users'] ?? 0,
                    ],
                    'recent_joined_users' => $newUsers,
                    'recent_audit_logs' => $recentAuditLogs,
                ],
            ];
        });
    }

    private function countsFor($tasks, $now): array
    {
        $unfinished = $tasks->where('is_completed', false);

        return [
            'unfinished' => $unfinished->count(),
            'overdue' => $unfinished->filter(fn (Todo $todo) => $todo->deadline && $todo->deadline->lt($now))->count(),
            'completed' => $tasks->where('is_completed', true)->count(),
            'total' => $tasks->count(),
        ];
    }

    private function taskPayload(Todo $todo): array
    {
        return [
            'id' => $todo->id,
            'title' => $todo->judul,
            'description' => $todo->deskripsi,
            'deadline' => $todo->deadline?->toDateTimeString(),
            'priority' => $todo->priority,
            'completed' => (bool) $todo->is_completed,
        ];
    }
}
