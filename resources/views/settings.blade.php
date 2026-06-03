@extends('layouts.app')

@section('title', 'Settings - WUDI Monitoring')

@section('content')
    <!-- Hide the default header to render high-fidelity mockup header -->
    <style>
        #layout-header {
            display: none !important;
        }
    </style>

    <!-- HIGH-FIDELITY SETTINGS HEADER -->
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between relative">
        <div class="flex items-center gap-3">
            <a href="/dashboard" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 transition cursor-pointer">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Settings</h1>
                <p class="text-xs text-slate-400 mt-1">Manage your account settings and preferences.</p>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- User Header Profile Avatar -->
            <a href="/settings" class="h-10 w-10 rounded-full border-2 border-[#3c2a21]/20 bg-yellow-950 text-white flex items-center justify-center font-bold text-xs shadow-sm overflow-hidden" id="header-avatar-container">
                <span id="header-avatar-initials">WA</span>
                <img id="header-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Avatar" />
            </a>
        </div>
    </div>

    <!-- MAIN SETTINGS CONTAINER -->
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- SETTINGS SIDEBAR NAV -->
        <div class="w-full lg:w-64 shrink-0 space-y-2">
            <button onclick="switchTab('tab-profile')" id="nav-profile" class="settings-nav-btn w-full flex items-center gap-3 px-5 py-4 rounded-2xl bg-yellow-950 text-white font-bold text-sm shadow-md transition-all text-left">
                <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profile
            </button>
            <button onclick="switchTab('tab-display')" id="nav-display" class="settings-nav-btn w-full flex items-center gap-3 px-5 py-4 rounded-2xl bg-transparent text-slate-500 font-bold text-sm hover:bg-slate-100 transition-all text-left">
                <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                Display & Theme
            </button>
            <button onclick="switchTab('tab-security')" id="nav-security" class="settings-nav-btn w-full flex items-center gap-3 px-5 py-4 rounded-2xl bg-transparent text-slate-500 font-bold text-sm hover:bg-slate-100 transition-all text-left">
                <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                Privacy & Security
            </button>
            <button onclick="switchTab('tab-notifications')" id="nav-notifications" class="settings-nav-btn w-full flex items-center gap-3 px-5 py-4 rounded-2xl bg-transparent text-slate-500 font-bold text-sm hover:bg-slate-100 transition-all text-left">
                <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                Notifications & Sound
            </button>
        </div>

        <!-- TAB CONTENT AREA -->
        <div class="flex-1">
            
            <!-- TAB 1: PROFILE -->
            <div id="tab-profile" class="settings-tab animate-in fade-in duration-300">
                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-8 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-[#3c2a21]"></span>
                        Profile Information
                    </h2>
                    
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Avatar side -->
                        <div class="flex flex-col items-center gap-4 shrink-0">
                            <div class="h-32 w-32 rounded-full border-4 border-[#3c2a21]/10 bg-yellow-950 text-white flex items-center justify-center font-extrabold text-3xl shadow-md overflow-hidden relative group" id="profile-avatar-container">
                                <span id="profile-avatar-initials">WA</span>
                                <img id="profile-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Profile Image" />
                            </div>
                            <div class="w-full space-y-2">
                                <label class="block w-full text-center rounded-2xl border border-slate-200 bg-white py-3 px-4 text-xs font-extrabold text-slate-800 hover:bg-slate-50 transition cursor-pointer shadow-sm">
                                    Choose Photo
                                    <input type="file" id="avatar-file-input" accept="image/*" class="hidden" onchange="previewSelectedAvatar(event)" />
                                </label>
                                <button id="avatar-save-btn" onclick="uploadProfileAvatar()" class="w-full text-center rounded-2xl bg-yellow-950 py-3 text-xs font-extrabold text-white hover:bg-yellow-900 transition shadow-sm border-0 cursor-pointer hidden">
                                    Upload Avatar
                                </button>
                            </div>
                        </div>

                        <!-- Form side -->
                        <form id="profile-info-form" onsubmit="saveProfileInfo(event)" class="flex-1 space-y-5">
                            <div class="space-y-1">
                                <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Full Name</label>
                                <input type="text" id="profile-name-input" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" />
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Email Address</label>
                                <input type="email" id="profile-email-input" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" />
                            </div>
                            <div id="email-confirm-pass-container" class="space-y-1 hidden">
                                <label class="text-xs font-extrabold text-rose-500 uppercase tracking-wide">Confirm Password</label>
                                <input type="password" id="profile-email-pass-input" placeholder="Current password required for email change" class="w-full rounded-2xl border border-rose-200 bg-rose-50/50 p-4 text-sm focus:ring-2 focus:ring-rose-500 focus:bg-white focus:outline-none transition-all" />
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="rounded-2xl bg-yellow-950 px-6 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer border-0">
                                    Save Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TAB 2: DISPLAY & THEME -->
            <div id="tab-display" class="settings-tab hidden animate-in fade-in duration-300">
                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-8 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-blue-500"></span>
                        Display & Theme
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- Light Mode -->
                            <div class="rounded-2xl border-2 border-yellow-950 bg-slate-50 p-4 text-center cursor-pointer">
                                <div class="h-20 bg-white border border-slate-200 rounded-xl mb-3 shadow-sm mx-auto"></div>
                                <p class="text-xs font-bold text-slate-900">Light Mode</p>
                            </div>
                            <!-- Dark Mode -->
                            <div class="rounded-2xl border-2 border-slate-200 bg-slate-900 p-4 text-center cursor-pointer opacity-60 hover:opacity-100 transition">
                                <div class="h-20 bg-slate-800 border border-slate-700 rounded-xl mb-3 shadow-sm mx-auto"></div>
                                <p class="text-xs font-bold text-white">Dark Mode</p>
                                <p class="text-[9px] text-slate-400 mt-1">Coming Soon</p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Compact Sidebar</p>
                                    <p class="text-xs text-slate-400">Reduce sidebar width to maximize workspace.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-950"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PRIVACY & SECURITY -->
            <div id="tab-security" class="settings-tab hidden animate-in fade-in duration-300">
                <div class="space-y-6">
                    <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-rose-500"></span>
                            Change Password
                        </h2>
                        
                        <form id="profile-password-form" onsubmit="savePasswordInfo(event)" class="space-y-4">
                            <div class="space-y-1">
                                <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Current Password</label>
                                <input type="password" id="current-password-input" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">New Password</label>
                                    <input type="password" id="new-password-input" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" />
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Confirm Password</label>
                                    <input type="password" id="confirm-password-input" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="rounded-2xl bg-yellow-950 px-6 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer border-0">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-emerald-500"></span>
                            Security Features
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 border border-slate-100 rounded-2xl">
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Two-Factor Authentication (2FA)</p>
                                    <p class="text-xs text-slate-400">Protect your account with an extra layer of security.</p>
                                </div>
                                <button class="rounded-xl bg-slate-100 px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-200 transition">Enable</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: NOTIFICATIONS & SOUND -->
            <div id="tab-notifications" class="settings-tab hidden animate-in fade-in duration-300">
                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-amber-500"></span>
                        Alerts & Notifications
                    </h2>
                    
                    <div class="space-y-5">
                        <div class="flex items-center justify-between py-2">
                            <div>
                                <p class="text-sm font-bold text-slate-800">Security Alerts Toggle</p>
                                <p class="text-xs text-slate-400">Receive system-wide alerts for failed login spikes or suspicious activities.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="remote-alerts" checked class="sr-only peer" onchange="saveNotificationSettings()">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-950"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between py-2 border-t border-slate-100">
                            <div>
                                <p class="text-sm font-bold text-slate-800">Device Vibration Feedback</p>
                                <p class="text-xs text-slate-400">Vibrate mobile client interface for errors, system-wide alerts or updates.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="vibration" checked class="sr-only peer" onchange="saveNotificationSettings()">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-950"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Tab Switcher Logic
        function switchTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.settings-tab').forEach(t => t.classList.add('hidden'));
            // Remove active classes from all nav buttons
            document.querySelectorAll('.settings-nav-btn').forEach(btn => {
                btn.classList.remove('bg-yellow-950', 'text-white', 'shadow-md');
                btn.classList.add('bg-transparent', 'text-slate-500');
            });

            // Show selected tab
            document.getElementById(tabId).classList.remove('hidden');
            // Add active classes to selected nav button
            const activeBtn = document.getElementById('nav-' + tabId.replace('tab-', ''));
            if(activeBtn) {
                activeBtn.classList.add('bg-yellow-950', 'text-white', 'shadow-md');
                activeBtn.classList.remove('bg-transparent', 'text-slate-500');
            }
        }

        // Profile logic matching the previous profile page
        let initialUser = null;
        let selectedAvatarFile = null;

        window.addEventListener('user-data-loaded', (e) => {
            const user = e.detail;
            if (user) {
                initialUser = user;
                document.getElementById('profile-name-input').value = user.name || '';
                document.getElementById('profile-email-input').value = user.email || '';
                
                const emailInput = document.getElementById('profile-email-input');
                emailInput.addEventListener('input', (event) => {
                    const changed = event.target.value !== initialUser.email;
                    document.getElementById('email-confirm-pass-container').classList.toggle('hidden', !changed);
                    document.getElementById('profile-email-pass-input').required = changed;
                });

                updateAvatarUI(user.name, user.avatar_url);
            }
        });

        function updateAvatarUI(name, avatarUrl) {
            // Update Header & Settings Avatar UI
            const elements = ['header', 'profile'].map(prefix => ({
                initials: document.getElementById(`${prefix}-avatar-initials`),
                img: document.getElementById(`${prefix}-avatar-img`)
            }));

            elements.forEach(({initials, img}) => {
                if (initials) {
                    const parts = name.split(' ');
                    initials.textContent = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase() || 'WA';
                }
                if (img) {
                    if (avatarUrl) {
                        img.src = avatarUrl;
                        img.classList.remove('hidden');
                        if (initials) initials.classList.add('hidden');
                    } else {
                        img.classList.add('hidden');
                        if (initials) initials.classList.remove('hidden');
                    }
                }
            });
        }

        function previewSelectedAvatar(event) {
            const files = event.target.files;
            if (files && files[0]) {
                selectedAvatarFile = files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgEl = document.getElementById('profile-avatar-img');
                    const initialsEl = document.getElementById('profile-avatar-initials');
                    if (imgEl && initialsEl) {
                        imgEl.src = e.target.result;
                        imgEl.classList.remove('hidden');
                        initialsEl.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(selectedAvatarFile);
                document.getElementById('avatar-save-btn').classList.remove('hidden');
            }
        }

        async function uploadProfileAvatar() {
            if (!selectedAvatarFile) return;
            const formData = new FormData();
            formData.append('avatar', selectedAvatarFile);

            try {
                const token = localStorage.getItem('auth_token');
                const headers = {};
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/profile/avatar', {
                    method: 'POST',
                    headers,
                    body: formData
                });

                if (res.ok) {
                    const data = await res.json();
                    alert('Avatar uploaded successfully!');
                    document.getElementById('avatar-save-btn').classList.add('hidden');
                    if (data.avatar_url) {
                        updateAvatarUI(initialUser.name, data.avatar_url);
                        window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: { ...initialUser, avatar_url: data.avatar_url } }));
                    }
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function saveProfileInfo(e) {
            e.preventDefault();
            const name = document.getElementById('profile-name-input').value.trim();
            const email = document.getElementById('profile-email-input').value.trim();
            const confirmPass = document.getElementById('profile-email-pass-input').value;

            const token = localStorage.getItem('auth_token');
            const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
            if (token) headers['Authorization'] = `Bearer ${token}`;

            if (name !== initialUser.name) {
                try {
                    await fetch(window.API_BASE_URL + '/profile/update', { method: 'POST', headers, body: JSON.stringify({ name }) });
                    initialUser.name = name;
                    updateAvatarUI(name, initialUser.avatar_url);
                    window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: initialUser }));
                } catch (err) {
                    console.error(err);
                }
            }

            if (email !== initialUser.email) {
                try {
                    const resEmail = await fetch(window.API_BASE_URL + '/profile/email', {
                        method: 'POST', headers, body: JSON.stringify({ email, current_password: confirmPass })
                    });
                    if (resEmail.ok) {
                        initialUser.email = email;
                        document.getElementById('email-confirm-pass-container').classList.add('hidden');
                        document.getElementById('profile-email-pass-input').value = '';
                        document.getElementById('profile-email-pass-input').required = false;
                        window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: initialUser }));
                    } else {
                        alert('Incorrect current password for email change.');
                        return;
                    }
                } catch (err) {
                    console.error(err);
                }
            }
            alert('Profile saved successfully!');
        }

        async function savePasswordInfo(e) {
            e.preventDefault();
            const currentPass = document.getElementById('current-password-input').value;
            const newPass = document.getElementById('new-password-input').value;
            const confirmPass = document.getElementById('confirm-password-input').value;

            if (newPass !== confirmPass) {
                alert('New passwords do not match.');
                return;
            }

            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/profile/password', {
                    method: 'POST', headers, body: JSON.stringify({ current_password: currentPass, password: newPass, password_confirmation: confirmPass })
                });

                if (res.ok) {
                    document.getElementById('profile-password-form').reset();
                    alert('Password changed successfully!');
                } else {
                    alert('Failed to change password (incorrect current password).');
                }
            } catch (err) {
                console.error(err);
            }
        }

        // Notification logic
        async function loadNotificationSettings() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/notification-settings', { headers });
                if (res.ok) {
                    const data = await res.json();
                    document.getElementById('remote-alerts').checked = !!data.remote_alerts;
                    document.getElementById('vibration').checked = !!data.vibration;
                }
            } catch (err) { console.error(err); }
        }

        async function saveNotificationSettings() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                await fetch(window.API_BASE_URL + '/notification-settings', {
                    method: 'POST', headers,
                    body: JSON.stringify({
                        reminder_days: [0, 1, 2, 3, 4, 5, 6],
                        reminder_time: '09:00',
                        vibration: document.getElementById('vibration').checked,
                        remote_alerts: document.getElementById('remote-alerts').checked
                    })
                });
            } catch (err) { console.error(err); }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadNotificationSettings();
        });
    </script>
@endsection
