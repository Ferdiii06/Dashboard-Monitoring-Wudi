<!-- Mobile Backdrop Overlay -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-30 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden cursor-pointer" onclick="toggleSidebarMobile()"></div>

<!-- Minimalist Fixed Sidebar Component -->
<!-- Consistent rounded-r-[2.5rem] on all screens, h-screen height boundary for scrollable nav, and lg: sticky for desktop/laptop -->
<aside id="sidebar-container" class="fixed inset-y-0 left-0 z-40 -translate-x-full lg:translate-x-0 lg:sticky top-0 h-screen bg-[#fff8e7] border-r border-slate-200/80 flex flex-col w-64 shadow-xl shadow-yellow-950/5">
    
    <div class="flex h-full flex-col p-6">
        
        <!-- USER PROFILE CARD (TOP SECTION) -->
        <div id="sidebar-user-card" class="flex items-center gap-3 relative">
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="h-12 w-12 rounded-full bg-yellow-950 border-2 border-white shadow-md flex items-center justify-center text-white font-extrabold text-sm" id="sidebar-avatar-container">
                    <span id="sidebar-avatar-initials">WA</span>
                    <img id="sidebar-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Avatar" />
                </div>
                <!-- Active status dot -->
                <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-emerald-500 border-2 border-[#fff8e7]"></span>
            </div>

            <!-- Profile Info Texts -->
            <div class="flex-1 min-w-0">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none">Dashboard</p>
                <p id="sidebar-user-name" class="text-sm font-extrabold text-yellow-950 truncate mt-1">Wudi Admin</p>
            </div>
        </div>

        <!-- Divider Line -->
        <div class="h-px bg-slate-200/70 my-6 mx-1"></div>
        
        <!-- NAVIGATION ITEMS -->
        <nav class="flex-1 space-y-6 overflow-y-auto no-scrollbar">
            
            <!-- MAIN CATEGORY -->
            <div class="space-y-2">
                <p class="category-header text-[10px] font-bold text-slate-400 uppercase tracking-widest pl-4 mb-2">Main</p>
                <div class="space-y-1.5">
                    @php
                        $activeClass = 'flex items-center gap-3 px-4 h-12 rounded-xl bg-yellow-950/10 text-yellow-950 font-bold transition-all';
                        $inactiveClass = 'flex items-center gap-3 px-4 h-12 rounded-xl text-slate-600 hover:bg-yellow-950/5 hover:text-yellow-950 transition-all';
                        
                        $activeSubClass = 'flex items-center justify-between px-3 py-2 rounded-xl bg-yellow-950/10 text-yellow-950 font-bold transition-all';
                        $inactiveSubClass = 'flex items-center justify-between px-3 py-2 rounded-xl text-slate-500 hover:text-yellow-950 transition-all';
                    @endphp

                    <!-- Dashboard Link -->
                    <a href="/dashboard" class="{{ Request::is('dashboard') ? $activeClass : $inactiveClass }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="text-sm">Dashboard</span>
                    </a>

                    <!-- Analytics Link (With Submenu) -->
                    <div class="space-y-1">
                        <button onclick="toggleSubmenu('analytics-submenu', 'analytics-arrow')" class="w-full flex items-center justify-between px-4 h-12 rounded-xl text-slate-600 hover:bg-yellow-950/5 hover:text-yellow-950 transition-all cursor-pointer focus:outline-none">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                                <span class="text-sm">Analytics</span>
                            </div>
                            <svg id="analytics-arrow" class="h-4 w-4 shrink-0 transition-transform duration-200 {{ Request::is('analytics') ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Tree Submenu -->
                        <div id="analytics-submenu" class="pl-7 space-y-1 border-l border-slate-300 ml-6 {{ Request::is('analytics*') ? '' : 'hidden' }} transition-all duration-300">
                            <a href="/analytics" class="{{ Request::is('analytics') ? $activeSubClass : $inactiveSubClass }}">
                                <span class="text-xs">Productivity</span>
                                <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="/analytics/system" class="{{ Request::is('analytics/system') ? $activeSubClass : $inactiveSubClass }}">
                                <span class="text-xs">System Health</span>
                                <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="/analytics/security" class="{{ Request::is('analytics/security') ? $activeSubClass : $inactiveSubClass }}">
                                <span class="text-xs">Security Logs</span>
                                <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Report Link -->
                    <a href="/report" class="{{ Request::is('report') ? $activeClass : $inactiveClass }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm">Report</span>
                        <span id="report-badge" class="ml-auto inline-flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shrink-0">4</span>
                    </a>
                </div>
            </div>

            <!-- SETTINGS CATEGORY -->
            <div class="space-y-2">
                <p class="category-header text-[10px] font-bold text-slate-400 uppercase tracking-widest pl-4 mb-2">Settings</p>
                <div class="space-y-1.5">
                    <!-- Settings Link -->
                    <a href="/settings" class="{{ Request::is('settings') ? $activeClass : $inactiveClass }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <span class="text-sm">Settings</span>
                    </a>
                </div>
            </div>

        </nav>

        <!-- Divider Line -->
        <div class="h-px bg-slate-200/70 my-6 mx-1"></div>

        <!-- HELP & LOGOUT (BOTTOM SECTION) -->
        <div class="bottom-links space-y-1.5 mt-auto">
            <!-- Help Link -->
            <a href="/help" class="flex items-center gap-3 px-4 h-12 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition {{ Request::is('help') ? 'bg-slate-100 text-slate-800 font-bold' : '' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">Help</span>
            </a>

            <!-- Logout Link -->
            <button onclick="handleLogout()" class="w-full flex items-center gap-3 px-4 h-12 rounded-xl text-red-600 hover:bg-red-50 transition font-bold text-left cursor-pointer focus:outline-none">
                <svg class="h-5 w-5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-sm">Logout Account</span>
            </button>
        </div>
        
    </div>
</aside>