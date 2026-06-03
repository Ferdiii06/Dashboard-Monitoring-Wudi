<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WUDI Monitoring')</title>
    <link rel="icon" type="image/png" href="/Logo.png?v=2" />
    <!-- Check Authentication Client-Side before rendering to prevent flash of content -->
    <script>
        window.API_BASE_URL = "{{ env('API_URL', 'https://laravel-app-437363373527.asia-southeast2.run.app/api') }}";
        if (!localStorage.getItem('auth_token')) {
            window.location.href = '/login';
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <div class="flex flex-col lg:flex-row min-h-screen bg-slate-50">
        <!-- Mobile Sticky Top Nav Bar -->
        <div class="flex lg:hidden items-center justify-between bg-[#fff2dc] border-b border-slate-200 px-6 py-4 sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-yellow-950 text-white shadow-sm">
                    <img class="h-6 w-6 object-contain" src="/Logo.png" alt="Wudi Logo" />
                </div>
                <span class="text-sm font-extrabold tracking-tight text-yellow-950">WUDI Dashboard</span>
            </div>
            <button onclick="toggleSidebarMobile()" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-700 shadow-sm hover:bg-slate-50 transition cursor-pointer">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Reusable Sidebar Component -->
        <x-sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto px-6 py-8">
            <div class="mx-auto max-w-6xl">
                <!-- Session/Auth Info Header -->
                <div id="layout-header" class="mb-8 flex flex-col gap-4 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">@yield('section_title', 'Dashboard Monitoring')</p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-900">Hello, <span id="auth-username">User</span></h1>
                        <p class="mt-1 text-slate-500 text-sm">@yield('section_description', 'Berikut ringkasan aktivitas tugas Wudi hari ini.')</p>
                    </div>
                    <!-- User Header Profile Avatar -->
                    <a href="/settings" class="h-10 w-10 rounded-full border-2 border-[#3c2a21]/20 bg-yellow-950 text-white flex items-center justify-center font-bold text-xs shadow-sm overflow-hidden" id="layout-header-avatar-container">
                        <span id="layout-header-avatar-initials">WA</span>
                        <img id="layout-header-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Avatar" />
                    </a>
                </div>

                @yield('content')
            </div>
        </main>
    </div>
    
    <script>
        window.addEventListener('user-data-loaded', (e) => {
            const user = e.detail;
            if (user) {
                const initialsEl = document.getElementById('layout-header-avatar-initials');
                if (initialsEl) {
                    const parts = user.name.split(' ');
                    const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                    initialsEl.textContent = initials || 'WA';
                }

                if (user.avatar_url) {
                    const imgEl = document.getElementById('layout-header-avatar-img');
                    if (imgEl) {
                        imgEl.src = user.avatar_url;
                        imgEl.classList.remove('hidden');
                        if (initialsEl) initialsEl.classList.add('hidden');
                    }
                }
            }
        });
    </script>
</body>
</html>
