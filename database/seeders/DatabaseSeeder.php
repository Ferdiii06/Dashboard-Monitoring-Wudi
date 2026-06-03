<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use App\Models\ApiActivityLog;
use App\Models\MonitoringEvent;
use App\Models\ChatMessage;
use App\Models\UserSession;
use App\Models\UserDeviceHistory;
use App\Models\AuditLog;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Login User
        $defaultUser = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Ferdi Admin',
                'password' => Hash::make('password'),
                'status' => 'active',
                'last_seen_at' => now(),
            ]
        );

        // 2. Create multiple mock users
        $users = [$defaultUser];
        $names = ['Ahmad', 'Budi', 'Chandra', 'Dedy', 'Eka', 'Fajar', 'Gita', 'Hendra', 'Indra', 'Jaya'];
        foreach ($names as $idx => $name) {
            $users[] = User::updateOrCreate(
                ['email' => strtolower($name) . '@example.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'status' => $idx === 2 ? 'warning' : ($idx === 5 ? 'flagged' : 'active'),
                    'last_seen_at' => now()->subHours(rand(0, 48)),
                ]
            );
        }

        // 3. Create mock Todos (Tasks)
        $priorities = ['low', 'medium', 'high'];
        for ($i = 0; $i < 60; $i++) {
            $user = $users[array_rand($users)];
            Todo::create([
                'user_id' => $user->id,
                'judul' => 'Task #' . ($i + 1) . ' - ' . fake()->sentence(3),
                'deskripsi' => fake()->paragraph(),
                'is_completed' => rand(0, 1) === 1,
                'priority' => $priorities[array_rand($priorities)],
                'deadline' => now()->addDays(rand(-5, 10)),
                'created_at' => now()->subDays(rand(0, 10)),
                'updated_at' => now(),
            ]);
        }

        // 4. Create mock API activity logs
        $paths = ['/api/login', '/api/todos', '/api/teams', '/api/chat/conversations', '/api/ai/chat', '/api/notifications'];
        $methods = ['GET', 'POST', 'PUT', 'DELETE'];
        
        for ($i = 0; $i < 200; $i++) {
            $user = rand(0, 5) > 0 ? $users[array_rand($users)] : null;
            $statusCode = rand(0, 10) > 8 ? (rand(0, 1) === 1 ? 401 : 429) : 200;
            $path = $paths[array_rand($paths)];
            $method = $path === '/api/login' ? 'POST' : $methods[array_rand($methods)];
            
            ApiActivityLog::create([
                'user_id' => $user?->id,
                'method' => $method,
                'path' => $path,
                'status_code' => $statusCode,
                'duration_ms' => rand(50, 1200),
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'action' => strtolower($method) . ' ' . $path,
                'blocked' => $statusCode === 429,
                'suspicious' => $statusCode === 401 || $statusCode === 429,
                'occurred_at' => now()->subMinutes(rand(1, 1440)),
            ]);
        }

        // 5. Create mock Mobile Monitoring events
        $eventTypes = ['app_opened', 'app_foregrounded', 'session_started', 'chat_opened', 'chat_message_sent', 'ai_request_started'];
        for ($i = 0; $i < 80; $i++) {
            $user = $users[array_rand($users)];
            MonitoringEvent::create([
                'user_id' => $user->id,
                'device_id' => Str::uuid()->toString(),
                'session_key' => Str::random(32),
                'event_type' => $eventTypes[array_rand($eventTypes)],
                'category' => 'mobile',
                'source' => 'mobile',
                'duration_ms' => rand(500, 15000),
                'occurred_at' => now()->subMinutes(rand(1, 1440)),
            ]);
        }

        // 6. Create User device history and session records
        foreach ($users as $user) {
            UserDeviceHistory::create([
                'user_id' => $user->id,
                'device_id' => Str::uuid()->toString(),
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'first_seen_at' => now()->subDays(5),
                'last_seen_at' => now(),
                'seen_count' => rand(5, 50),
            ]);

            UserSession::create([
                'user_id' => $user->id,
                'session_key' => Str::random(32),
                'started_at' => now()->subHours(1),
                'last_seen_at' => now(),
                'duration_seconds' => rand(120, 3600),
                'ip_address' => '192.168.1.' . rand(1, 254),
            ]);
        }

        // 7. Create mock Audit Logs (User Actions)
        $auditActions = [
            'logged in to dashboard',
            'created a new task',
            'completed task',
            'updated team settings',
            'sent message in chat',
            'changed profile avatar',
            'downloaded monthly PDF report',
            'edited task deadline',
        ];

        for ($i = 0; $i < 40; $i++) {
            $actor = $users[array_rand($users)];
            $action = $auditActions[array_rand($auditActions)];
            
            if ($action === 'created a new task' || $action === 'completed task' || $action === 'edited task deadline') {
                $action .= ' #' . rand(1, 60);
            }

            AuditLog::create([
                'actor_user_id' => $actor->id,
                'action' => $action,
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'occurred_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }

        // 8. Create mock Notifications
        $notifMessages = [
            'A suspicious access attempt was detected from IP 182.2.14.90',
            'New user registration completed: Dody Kurniawan',
            'Database backup operation completed successfully',
            'Weekly usage report is ready for download',
            'A user reported a bug in the chat module',
        ];

        foreach ($users as $u) {
            for ($j = 0; $j < 4; $j++) {
                Notification::create([
                    'user_id' => $u->id,
                    'type' => 'info',
                    'message' => $notifMessages[$j % count($notifMessages)],
                    'read_at' => $j > 1 ? now() : null,
                ]);
            }
        }
    }
}
