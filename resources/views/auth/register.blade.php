<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WUDI Monitoring</title>
    <link class="w-6 h-6 object-contain" rel="icon" type="image/png" href="/Logo.png?v=2" />
    
    <!-- Load Google Identity Services SDK -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    
    <script>
        window.API_BASE_URL = "{{ env('API_URL', 'https://laravel-app-437363373527.asia-southeast2.run.app/api') }}";
        window.GOOGLE_CLIENT_ID = "{{ env('GOOGLE_CLIENT_ID', '') }}";
        
        if (localStorage.getItem('auth_token')) {
            window.location.href = '/dashboard';
        }
    </script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#fffcf6] min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans">

    <!-- MAIN CONTAINER -->
    <div class="w-full max-w-6xl bg-white rounded-[2.5rem] shadow-xl overflow-hidden grid md:grid-cols-12 min-h-[750px]">
        
        <!-- LEFT SIDE (FORM) -->
        <div class="md:col-span-6 flex flex-col justify-between p-8 sm:p-12 lg:p-16">
            
            <!-- TOP BRAND LOGO -->
            <div class="flex justify-center">
                <div class="flex h-16 w-16 items-center justify-center">
                    <img class="h-16 w-16 object-contain" src="/Logo.png" alt="Wudi Logo" />
                </div>
            </div>

            <!-- FORM CONTENT -->
            <div class="my-auto max-w-md w-full mx-auto space-y-6">
                <div class="text-center space-y-2">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Create an Account</h1>
                    <p class="text-sm text-gray-500">Sign up to monitor and manage tasks in real-time.</p>
                </div>

                <form id="register-form" class="space-y-4">
                    <!-- Username field -->
                    <div class="space-y-1">
                        <label for="username" class="text-xs font-bold text-gray-700 uppercase tracking-wider">Username</label>
                        <input
                            id="username"
                            class="w-full border border-gray-200 rounded-2xl p-4 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                            type="text"
                            placeholder="Enter your username"
                            required
                        />
                    </div>

                    <!-- Email field -->
                    <div class="space-y-1">
                        <label for="email" class="text-xs font-bold text-gray-700 uppercase tracking-wider">Email Address</label>
                        <input
                            id="email"
                            class="w-full border border-gray-200 rounded-2xl p-4 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                            type="email"
                            placeholder="Enter your email address"
                            required
                        />
                    </div>

                    <!-- Password field -->
                    <div class="space-y-1 relative">
                        <label for="password" class="text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                        <div class="relative">
                            <input
                                id="password"
                                class="w-full border border-gray-200 rounded-2xl p-4 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all pr-12"
                                type="password"
                                placeholder="Create a strong password"
                                required
                            />
                            <!-- Eye icon toggle -->
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                                <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Terms & conditions checkbox -->
                    <div class="flex items-center text-sm">
                        <label class="flex items-center gap-2 text-gray-600">
                            <input type="checkbox" class="rounded border-gray-300 text-yellow-950 focus:ring-yellow-950" required />
                            I agree to the Terms & Conditions
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full bg-yellow-950 text-white p-4 rounded-2xl font-bold hover:bg-yellow-900 transition-all active:scale-[0.98] cursor-pointer shadow-md" type="submit">
                        Register
                    </button>
                </form>

                <!-- Status Messages -->
                <p id="error-message" class="text-sm text-red-600 text-center font-medium hidden"></p>
                <p id="success-message" class="text-sm text-emerald-600 text-center font-medium hidden"></p>

                <!-- Social Logins Divider -->
                <div class="relative flex items-center justify-center">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <span class="relative px-4 bg-white text-xs text-gray-400 font-bold uppercase tracking-wider">Or register with</span>
                </div>

                <!-- Google Sign-In Container -->
                <div class="space-y-3">
                    <div id="google-signin-wrapper" class="w-full flex justify-center">
                        <!-- Custom Google Button (Placeholder / Fallback) -->
                        <button id="custom-google-btn" onclick="triggerGoogleLogin()" class="w-full flex items-center justify-center gap-2 border border-gray-200 rounded-2xl p-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition cursor-pointer">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                            </svg>
                            Continue with Google
                        </button>
                        
                        <!-- Official Google GIS Button Container -->
                        <div id="gis-google-btn" class="hidden w-full"></div>
                    </div>
                </div>

                <!-- Switch Link -->
                <p class="text-sm text-gray-600 text-center font-medium">
                    Already have an account? <a href="/login" class="text-yellow-950 font-bold hover:underline">Login</a>
                </p>
            </div>

            <!-- FOOTER -->
            <div class="flex justify-between items-center text-xs text-gray-400 mt-8 pt-4 border-t border-gray-100">
                <span>© 2026 Wudi Inc. All rights reserved.</span>
                <div class="flex gap-3">
                    <a href="#" class="hover:text-gray-600">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-gray-600">Terms & Conditions</a>
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE (PROMO / CAROUSEL PANEL) -->
        <div class="hidden md:col-span-6 md:flex flex-col justify-between bg-yellow-950 p-12 text-white m-4 rounded-[2rem] relative overflow-hidden select-none">
            <!-- Background Glow -->
            <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/20 blur-3xl"></div>
            <div class="absolute -left-24 -bottom-24 h-96 w-96 rounded-full bg-yellow-600/10 blur-3xl"></div>

            <!-- Dynamic Slides Container -->
            <div id="slides-container" class="relative flex-1 flex flex-col justify-center min-h-[350px]">
                
                <!-- SLIDE 1 (Productivity Stats) -->
                <div class="carousel-slide absolute inset-0 flex flex-col justify-center space-y-6 transition-all duration-500 opacity-100 transform translate-x-0" data-slide-index="0">
                    <!-- Mock Card 1 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm ml-auto">
                        <div class="flex items-center justify-between text-xs text-amber-200/80 font-bold uppercase tracking-wide">
                            <span>Task Completed</span>
                            <span>This Month</span>
                        </div>
                        <div class="mt-4 flex items-baseline gap-2">
                            <span class="text-3xl font-extrabold">92.4%</span>
                            <span class="text-xs text-emerald-400 font-bold">↑ 12%</span>
                        </div>
                        <div class="mt-4 h-1.5 w-full rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-gradient-to-r from-amber-400 to-yellow-500" style="width: 92%"></div>
                        </div>
                    </div>

                    <!-- Mock Card 2 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm mr-auto">
                        <div class="flex justify-between items-center text-xs text-amber-200/80 font-bold uppercase tracking-wide">
                            <span>Active Sessions</span>
                            <svg class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="mt-2 text-2xl font-extrabold">2,758</div>
                        <div class="mt-3 flex gap-2">
                            <span class="rounded-full bg-amber-400/20 px-2.5 py-0.5 text-[10px] font-bold text-amber-300">ADMIN: 24</span>
                            <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-[10px] font-bold text-gray-300">USER: 2,734</span>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 (Security & Performance) -->
                <div class="carousel-slide absolute inset-0 flex flex-col justify-center space-y-6 transition-all duration-500 opacity-0 transform translate-x-12 hidden" data-slide-index="1">
                    <!-- Mock Card 1 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm ml-auto">
                        <div class="flex items-center justify-between text-xs text-amber-200/80 font-bold uppercase tracking-wide">
                            <span>System Uptime</span>
                            <span>Live SLA</span>
                        </div>
                        <div class="mt-4 flex items-baseline gap-2">
                            <span class="text-3xl font-extrabold">99.98%</span>
                            <span class="text-xs text-emerald-400 font-bold">ONLINE</span>
                        </div>
                    </div>

                    <!-- Mock Card 2 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm mr-auto">
                        <div class="flex justify-between items-center text-xs text-amber-200/80 font-bold uppercase tracking-wide">
                            <span>Threats Blocked</span>
                            <span class="rounded bg-red-500/20 px-2 py-0.5 text-[10px] font-bold text-red-300">SECURE</span>
                        </div>
                        <div class="mt-2 text-2xl font-extrabold">0 incidents</div>
                        <p class="mt-1 text-xs text-slate-300 font-medium">Real-time firewall filters active</p>
                    </div>
                </div>

                <!-- SLIDE 3 (AI assistant) -->
                <div class="carousel-slide absolute inset-0 flex flex-col justify-center space-y-6 transition-all duration-500 opacity-0 transform translate-x-12 hidden" data-slide-index="2">
                    <!-- Mock Card 1 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm ml-auto">
                        <div class="flex items-center justify-between text-xs text-amber-200/80 font-bold uppercase tracking-wide">
                            <span>AI Accuracy</span>
                            <span>Model Feedback</span>
                        </div>
                        <div class="mt-4 flex items-baseline gap-2">
                            <span class="text-3xl font-extrabold">94.8%</span>
                            <span class="text-xs text-amber-400 font-bold">EXCELLENT</span>
                        </div>
                    </div>

                    <!-- Mock Card 2 -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-md shadow-lg max-w-sm mr-auto">
                        <div class="text-xs text-amber-200/80 font-bold uppercase tracking-wide">Daily AI Requests</div>
                        <div class="mt-2 text-2xl font-extrabold">12.4k requests</div>
                        <p class="mt-1 text-xs text-slate-300 font-medium">Token utilization optimized</p>
                    </div>
                </div>

            </div>

            <!-- BOTTOM CONTENT AND SLIDER DOTS -->
            <div class="relative z-10 mt-8 space-y-6">
                <div class="space-y-3 min-h-[100px]">
                    <h2 id="carousel-title" class="text-3xl font-extrabold leading-tight tracking-tight">Transform Data into Cool Insights</h2>
                    <p id="carousel-description" class="text-sm text-amber-100/70 max-w-md">
                        Make informed decisions with Wudi's powerful analytics tools. Harness the power of data to drive your business forward with Wudi Analytics.
                    </p>
                </div>
                
                <!-- Slider dots -->
                <div class="flex gap-2">
                    <span id="dot-0" class="carousel-dot h-2 w-6 rounded-full bg-amber-400 transition-all duration-300 cursor-pointer"></span>
                    <span id="dot-1" class="carousel-dot h-2 w-2 rounded-full bg-white/40 transition-all duration-300 cursor-pointer"></span>
                    <span id="dot-2" class="carousel-dot h-2 w-2 rounded-full bg-white/40 transition-all duration-300 cursor-pointer"></span>
                </div>
            </div>

        </div>

    </div>

    <!-- SCRIPT FOR PASSWORD TOGGLE, CAROUSEL, & FETCH -->
    <script>
        // --- Carousel Logic ---
        const slideTitles = [
            "Transform Data into Cool Insights",
            "Monitor Security & Performance",
            "Leverage AI-Powered Assistance"
        ];
        const slideDescriptions = [
            "Make informed decisions with Wudi's powerful analytics tools. Harness the power of data to drive your business forward with Wudi Analytics.",
            "Ensure maximum reliability and keep your cloud environment secure with Wudi's real-time threat monitoring and automatic audit logging.",
            "Resolve user inquiries and debug pipelines automatically using Wudi's advanced LLM integration and conversational AI assistant."
        ];

        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const titleEl = document.getElementById('carousel-title');
        const descEl = document.getElementById('carousel-description');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden');
                    setTimeout(() => {
                        slide.classList.remove('opacity-0', 'translate-x-12');
                        slide.classList.add('opacity-100', 'translate-x-0');
                    }, 50);
                } else {
                    slide.classList.remove('opacity-100', 'translate-x-0');
                    slide.classList.add('opacity-0', 'translate-x-12');
                    setTimeout(() => {
                        if (slide.classList.contains('opacity-0')) {
                            slide.classList.add('hidden');
                        }
                    }, 500);
                }
            });

            // Update text with soft transition
            titleEl.style.opacity = 0;
            descEl.style.opacity = 0;
            setTimeout(() => {
                titleEl.textContent = slideTitles[index];
                descEl.textContent = slideDescriptions[index];
                titleEl.style.opacity = 1;
                descEl.style.opacity = 1;
            }, 250);

            // Update dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = "carousel-dot h-2 w-6 rounded-full bg-amber-400 transition-all duration-300 cursor-pointer";
                } else {
                    dot.className = "carousel-dot h-2 w-2 rounded-full bg-white/40 transition-all duration-300 cursor-pointer";
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Run auto slide loop every 6 seconds
        let slideInterval = setInterval(nextSlide, 6000);

        // Click handler for dots
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(slideInterval);
                currentSlide = i;
                showSlide(currentSlide);
                slideInterval = setInterval(nextSlide, 6000);
            });
        });

        // Initialize transitions styling
        titleEl.style.transition = 'opacity 0.25s ease-in-out';
        descEl.style.transition = 'opacity 0.25s ease-in-out';


        // --- Password toggle ---
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }


        // --- Google Sign-In Integration ---
        document.addEventListener('DOMContentLoaded', () => {
            if (window.GOOGLE_CLIENT_ID) {
                // Initialize Google GIS
                try {
                    google.accounts.id.initialize({
                        client_id: window.GOOGLE_CLIENT_ID,
                        callback: handleGoogleCredentialResponse
                    });
                    
                    // Show standard GIS button instead of fallback button
                    document.getElementById('custom-google-btn').classList.add('hidden');
                    document.getElementById('gis-google-btn').classList.remove('hidden');
                    
                    google.accounts.id.renderButton(
                        document.getElementById("gis-google-btn"),
                        { 
                            theme: "outline", 
                            size: "large", 
                            width: "380", 
                            text: "continue_with",
                            shape: "circle"
                        }
                    );
                } catch (e) {
                    console.warn("Google Identity Services SDK failed to initialize: ", e);
                }
            }
        });

        function triggerGoogleLogin() {
            alert("Silakan atur variabel GOOGLE_CLIENT_ID di file .env terlebih dahulu untuk mengaktifkan login Google!");
        }

        async function handleGoogleCredentialResponse(response) {
            const errorMessage = document.getElementById('error-message');
            errorMessage.classList.add('hidden');
            
            try {
                // Decode the base64 JWT payload client-side
                const base64Url = response.credential.split('.')[1];
                const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                const jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                const payload = JSON.parse(jsonPayload);

                // Send user data payload to backend /api/auth/google
                const res = await fetch(window.API_BASE_URL + '/auth/google', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        google_id: payload.sub,
                        email: payload.email,
                        name: payload.name,
                        avatar_url: payload.picture
                    })
                });

                const data = await res.json();
                
                if (res.ok) {
                    localStorage.setItem('auth_token', data.token);
                    window.location.href = '/dashboard';
                } else {
                    errorMessage.textContent = data.message || 'Login Google gagal diverifikasi oleh server.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (err) {
                console.error(err);
                errorMessage.textContent = 'Gagal memproses autentikasi Google';
                errorMessage.classList.remove('hidden');
            }
        }


        // --- Form submit (Email/Password) ---
        const registerForm = document.getElementById('register-form');
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');

        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            errorMessage.classList.add('hidden');
            errorMessage.textContent = '';
            successMessage.classList.add('hidden');
            successMessage.textContent = '';

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const res = await fetch(window.API_BASE_URL + '/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: username,
                        email,
                        password,
                        password_confirmation: password
                    })
                });
                
                const data = await res.json();
                
                if (res.ok) {
                    successMessage.textContent = data.message || 'Registrasi berhasil. Mengarahkan Anda ke halaman verifikasi...';
                    successMessage.classList.remove('hidden');
                    setTimeout(() => {
                        window.location.href = '/verify-otp?email=' + encodeURIComponent(email);
                    }, 2000);
                } else {
                    errorMessage.textContent = data.message || 'Registrasi gagal';
                    errorMessage.classList.remove('hidden');
                }
            } catch (err) {
                errorMessage.textContent = 'Gagal terhubung ke server backend';
                errorMessage.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
