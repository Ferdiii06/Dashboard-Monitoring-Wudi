@extends('layouts.app')

@section('title', 'Profile - WUDI Monitoring')

@section('content')
    <!-- Hide the default header to render high-fidelity mockup header -->
    <style>
        #layout-header {
            display: none !important;
        }
    </style>

    <!-- HIGH-FIDELITY PROFILE HEADER -->
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between relative">
        <div class="flex items-center gap-3">
            <a href="/dashboard" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 transition cursor-pointer">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Admin Profile</h1>
                <p class="text-xs text-slate-400 mt-1">Manage your administrator details, authentication, and avatar settings.</p>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- User Header Profile Avatar -->
            <div class="h-10 w-10 rounded-full border-2 border-[#3c2a21]/20 bg-yellow-950 text-white flex items-center justify-center font-bold text-xs shadow-sm overflow-hidden" id="header-avatar-container">
                <span id="header-avatar-initials">WA</span>
                <img id="header-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Avatar" />
            </div>
        </div>
    </div>

    <!-- MAIN PROFILE GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT/CENTER CONTENT (2/3 width on Desktop) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- PROFILE DETAILS CARD -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-[#3c2a21]"></span>
                    Profile Information
                </h2>
                
                <form id="profile-info-form" onsubmit="saveProfileInfo(event)" class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Full Name</label>
                        <input 
                            type="text" 
                            id="profile-name-input"
                            required
                            placeholder="Enter your name"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" 
                        />
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Email Address</label>
                        <input 
                            type="email" 
                            id="profile-email-input"
                            required
                            placeholder="Enter your email"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" 
                        />
                    </div>

                    <div id="email-confirm-pass-container" class="space-y-1 hidden">
                        <label class="text-xs font-extrabold text-rose-500 uppercase tracking-wide">Confirm Password to Change Email</label>
                        <input 
                            type="password" 
                            id="profile-email-pass-input"
                            placeholder="Enter current password"
                            class="w-full rounded-2xl border border-slate-200 bg-rose-50/50 p-4 text-sm focus:ring-2 focus:ring-rose-500 focus:bg-white focus:outline-none transition-all" 
                        />
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="rounded-2xl bg-yellow-950 px-6 py-3 text-xs font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer border-0">
                            Update Profile Details
                        </button>
                    </div>
                </form>
            </div>

            <!-- PASSWORD CHANGE CARD -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-red-500"></span>
                    Update Security Password
                </h2>
                
                <form id="profile-password-form" onsubmit="savePasswordInfo(event)" class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Current Password</label>
                        <input 
                            type="password" 
                            id="current-password-input"
                            required
                            placeholder="Enter current password"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" 
                        />
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">New Password</label>
                            <input 
                                type="password" 
                                id="new-password-input"
                                required
                                placeholder="Enter new password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" 
                            />
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-extrabold text-slate-500 uppercase tracking-wide">Confirm New Password</label>
                            <input 
                                type="password" 
                                id="confirm-password-input"
                                required
                                placeholder="Confirm new password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all" 
                            />
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="rounded-2xl bg-yellow-950 px-6 py-3 text-xs font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer border-0">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: AVATAR PREVIEW & IMAGE UPDATE (1/3 width on Desktop) -->
        <div class="space-y-6">
            
            <!-- AVATAR UPLOAD CARD -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm text-center">
                <h3 class="text-md font-bold text-slate-900 mb-6">Profile Photo</h3>
                
                <div class="flex flex-col items-center gap-4">
                    <!-- Avatar preview container -->
                    <div class="h-32 w-32 rounded-full border-4 border-[#3c2a21]/10 bg-yellow-950 text-white flex items-center justify-center font-extrabold text-3xl shadow-md overflow-hidden relative group" id="profile-avatar-container">
                        <span id="profile-avatar-initials">WA</span>
                        <img id="profile-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Profile Image" />
                    </div>

                    <div class="w-full space-y-2 mt-4">
                        <label class="block w-full text-center rounded-2xl border border-slate-200 bg-white py-3 px-4 text-xs font-extrabold text-slate-800 hover:bg-slate-50 transition cursor-pointer shadow-sm">
                            Choose Avatar Photo
                            <input type="file" id="avatar-file-input" accept="image/*" class="hidden" onchange="previewSelectedAvatar(event)" />
                        </label>
                        <button 
                            id="avatar-save-btn"
                            onclick="uploadProfileAvatar()"
                            class="w-full text-center rounded-2xl bg-yellow-950 py-3 text-xs font-extrabold text-white hover:bg-yellow-900 transition shadow-sm border-0 cursor-pointer hidden"
                        >
                            Upload Avatar
                        </button>
                    </div>
                </div>
            </div>

            <!-- LOGOUT CARD -->
            <div class="rounded-[2.5rem] border border-rose-200/50 bg-rose-50/20 p-8 shadow-sm text-center">
                <h4 class="text-xs font-extrabold text-rose-500 uppercase tracking-widest mb-3">Terminate Current Session</h4>
                <button 
                    onclick="handleLogout()"
                    class="w-full rounded-2xl bg-rose-50 px-6 py-3.5 text-xs font-bold text-rose-600 transition hover:bg-rose-600 hover:text-white border-0 cursor-pointer"
                >
                    Log Out from Wudi System
                </button>
            </div>
        </div>
    </div>

    <script>
        let initialUser = null;
        let selectedAvatarFile = null;

        // Set dynamic initials in page
        window.addEventListener('user-data-loaded', (e) => {
            const user = e.detail;
            if (user) {
                initialUser = user;
                
                // Set text input values
                document.getElementById('profile-name-input').value = user.name || '';
                document.getElementById('profile-email-input').value = user.email || '';
                
                // Show confirm password if email input changed
                const emailInput = document.getElementById('profile-email-input');
                emailInput.addEventListener('input', (event) => {
                    const changed = event.target.value !== initialUser.email;
                    document.getElementById('email-confirm-pass-container').classList.toggle('hidden', !changed);
                    document.getElementById('profile-email-pass-input').required = changed;
                });

                // Update preview initials & image
                updateAvatarUI(user.name, user.avatar_url);
            }
        });

        function updateAvatarUI(name, avatarUrl) {
            // Header Avatar
            const headInitials = document.getElementById('header-avatar-initials');
            if (headInitials) {
                const parts = name.split(' ');
                const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                headInitials.textContent = initials || 'WA';
            }
            if (avatarUrl) {
                const headImg = document.getElementById('header-avatar-img');
                if (headImg) {
                    headImg.src = avatarUrl;
                    headImg.classList.remove('hidden');
                    if (headInitials) headInitials.classList.add('hidden');
                }
            }

            // Profile Page Avatar
            const initialsEl = document.getElementById('profile-avatar-initials');
            if (initialsEl) {
                const parts = name.split(' ');
                const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                initialsEl.textContent = initials || 'WA';
            }

            const imgEl = document.getElementById('profile-avatar-img');
            if (imgEl) {
                if (avatarUrl) {
                    imgEl.src = avatarUrl;
                    imgEl.classList.remove('hidden');
                    if (initialsEl) initialsEl.classList.add('hidden');
                } else {
                    imgEl.classList.add('hidden');
                    if (initialsEl) initialsEl.classList.remove('hidden');
                }
            }
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
                        // Refresh cache or reload
                        updateAvatarUI(initialUser.name, data.avatar_url);
                        // Trigger event to refresh sidebar
                        const customEvent = new CustomEvent('user-data-loaded', { 
                            detail: { ...initialUser, avatar_url: data.avatar_url } 
                        });
                        window.dispatchEvent(customEvent);
                    }
                } else {
                    const err = await res.json();
                    alert('Failed to upload avatar: ' + (err.message || 'unknown error'));
                }
            } catch (err) {
                console.error(err);
                alert('Connection error uploading avatar.');
            }
        }

        async function saveProfileInfo(e) {
            e.preventDefault();
            const name = document.getElementById('profile-name-input').value.trim();
            const email = document.getElementById('profile-email-input').value.trim();
            const confirmPass = document.getElementById('profile-email-pass-input').value;

            const token = localStorage.getItem('auth_token');
            const headers = { 
                'Content-Type': 'application/json',
                'Accept': 'application/json' 
            };
            if (token) headers['Authorization'] = `Bearer ${token}`;

            // 1. If name changed
            if (name !== initialUser.name) {
                try {
                    const resName = await fetch(window.API_BASE_URL + '/profile/update', {
                        method: 'POST',
                        headers,
                        body: JSON.stringify({ name })
                    });
                    if (!resName.ok) {
                        const err = await resName.json();
                        alert('Failed to update name: ' + (err.message || 'unknown error'));
                        return;
                    }
                    initialUser.name = name;
                    updateAvatarUI(name, initialUser.avatar_url);
                    // Dispatch reload event
                    window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: initialUser }));
                } catch (err) {
                    console.error(err);
                    alert('Connection issue updating name.');
                    return;
                }
            }

            // 2. If email changed
            if (email !== initialUser.email) {
                try {
                    const resEmail = await fetch(window.API_BASE_URL + '/profile/email', {
                        method: 'POST',
                        headers,
                        body: JSON.stringify({ email, current_password: confirmPass })
                    });
                    if (resEmail.ok) {
                        initialUser.email = email;
                        document.getElementById('email-confirm-pass-container').classList.add('hidden');
                        document.getElementById('profile-email-pass-input').value = '';
                        document.getElementById('profile-email-pass-input').required = false;
                        alert('Email updated successfully!');
                        window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: initialUser }));
                    } else {
                        const err = await resEmail.json();
                        alert('Failed to update email: ' + (err.message || 'incorrect current password'));
                        return;
                    }
                } catch (err) {
                    console.error(err);
                    alert('Connection issue updating email.');
                    return;
                }
            }

            alert('Profile details updated successfully!');
        }

        async function savePasswordInfo(e) {
            e.preventDefault();
            const currentPass = document.getElementById('current-password-input').value;
            const newPass = document.getElementById('new-password-input').value;
            const confirmPass = document.getElementById('confirm-password-input').value;

            if (newPass !== confirmPass) {
                alert('New password and confirm password do not match.');
                return;
            }

            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json' 
                };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/profile/password', {
                    method: 'POST',
                    headers,
                    body: JSON.stringify({ 
                        current_password: currentPass, 
                        password: newPass, 
                        password_confirmation: confirmPass 
                    })
                });

                if (res.ok) {
                    document.getElementById('profile-password-form').reset();
                    alert('Password changed successfully!');
                } else {
                    const err = await res.json();
                    alert('Failed to change password: ' + (err.message || 'incorrect current password'));
                }
            } catch (err) {
                console.error(err);
                alert('Connection issue changing password.');
            }
        }
    </script>
@endsection
