// Global functions attached to window for HTML event handlers
window.toggleSubmenu = function (id, arrowId) {
    const submenu = document.getElementById(id);
    const arrow = document.getElementById(arrowId);
    if (submenu && arrow) {
        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }
};

window.toggleSidebarMobile = function () {
    const sidebar = document.getElementById('sidebar-container');
    const backdrop = document.getElementById('sidebar-backdrop');
    
    if (sidebar && backdrop) {
        if (sidebar.classList.contains('-translate-x-full')) {
            // Open mobile drawer
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('pointer-events-none');
            backdrop.classList.add('opacity-100');
        } else {
            // Close mobile drawer
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('pointer-events-none');
        }
    }
};

window.handleLogout = async function () {
    const token = localStorage.getItem('auth_token');
    if (token) {
        try {
            await fetch(window.API_BASE_URL + '/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'X-Timezone': Intl.DateTimeFormat().resolvedOptions().timeZone
                }
            });
        } catch (e) {}
    }
    localStorage.removeItem('auth_token');
    window.location.href = '/login';
};

// Listen to page load to fetch user details and sync with UI
document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('auth_token');
    if (token) {
        fetch(window.API_BASE_URL + '/user', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'X-Timezone': Intl.DateTimeFormat().resolvedOptions().timeZone
            }
        })
        .then(res => {
            if (res.ok) return res.json();
            throw new Error('invalid-token');
        })
        .then(userData => {
            // Sync desktop header
            const headerNameEl = document.getElementById('auth-username');
            if (headerNameEl) headerNameEl.textContent = userData.name;
            
            // Invoke custom callbacks if page defined it
            if (typeof window.onUserLoaded === 'function') {
                window.onUserLoaded(userData);
            }
            
            // Dispatch dynamic event for sidebar sync
            window.dispatchEvent(new CustomEvent('user-data-loaded', { detail: userData }));
        })
        .catch(() => {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        });
    }

    // Sidebar Specific dynamic profile card synchronization
    window.addEventListener('user-data-loaded', (e) => {
        const user = e.detail;
        if (user) {
            // Sidebar name
            const nameEl = document.getElementById('sidebar-user-name');
            if (nameEl) nameEl.textContent = user.name;

            // Initials avatar
            const initialsEl = document.getElementById('sidebar-avatar-initials');
            if (initialsEl) {
                const parts = user.name.split(' ');
                const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                initialsEl.textContent = initials || 'WA';
            }

            // Avatar image url if present
            if (user.avatar_url) {
                const imgEl = document.getElementById('sidebar-avatar-img');
                if (imgEl) {
                    imgEl.src = user.avatar_url;
                    imgEl.classList.remove('hidden');
                    if (initialsEl) initialsEl.classList.add('hidden');
                }
            }
        }
    });
});
