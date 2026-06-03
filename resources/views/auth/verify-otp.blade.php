<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - WUDI Monitoring</title>
    <link rel="icon" type="image/png" href="/Logo.png?v=2" />
    <script>
        window.API_BASE_URL = "{{ env('API_URL', 'https://laravel-app-437363373527.asia-southeast2.run.app/api') }}";
        
        if (localStorage.getItem('auth_token')) {
            window.location.href = '/dashboard';
        }
    </script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#fffcf6] min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans">

    <!-- MAIN CARD CONTAINER -->
    <div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-xl p-8 sm:p-10 text-center space-y-6">
        
        <!-- LOGO -->
        <div class="flex justify-center">
            <div class="flex h-16 w-16 items-center justify-center">
                <img class="h-16 w-16 object-contain" src="/Logo.png" alt="Wudi Logo" />
            </div>
        </div>

        <!-- TITLE -->
        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Verify Email</h1>
            <p class="text-sm text-gray-500">Kami telah mengirimkan 4-digit kode verifikasi ke email Anda.</p>
            <p id="target-email" class="text-sm text-yellow-950 font-bold bg-yellow-50 rounded-xl py-2 px-4 inline-block mt-2"></p>
        </div>

        <!-- OTP FORM -->
        <form id="otp-form" class="space-y-6">
            <!-- 4-Digit Input Boxes -->
            <div class="flex justify-center gap-3">
                <input
                    type="text"
                    maxLength="1"
                    class="otp-input w-16 h-16 text-center text-2xl font-extrabold text-gray-900 border border-gray-200 rounded-2xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                    required
                />
                <input
                    type="text"
                    maxLength="1"
                    class="otp-input w-16 h-16 text-center text-2xl font-extrabold text-gray-900 border border-gray-200 rounded-2xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                    required
                />
                <input
                    type="text"
                    maxLength="1"
                    class="otp-input w-16 h-16 text-center text-2xl font-extrabold text-gray-900 border border-gray-200 rounded-2xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                    required
                />
                <input
                    type="text"
                    maxLength="1"
                    class="otp-input w-16 h-16 text-center text-2xl font-extrabold text-gray-900 border border-gray-200 rounded-2xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                    required
                />
            </div>

            <!-- Submit Button -->
            <button class="w-full bg-yellow-950 text-white p-4 rounded-2xl font-bold hover:bg-yellow-900 transition-all active:scale-[0.98] cursor-pointer shadow-md" type="submit">
                Verifikasi & Masuk
            </button>
        </form>

        <!-- Messages -->
        <p id="error-message" class="text-sm text-red-600 font-medium hidden"></p>
        <p id="success-message" class="text-sm text-emerald-600 font-medium hidden"></p>

        <!-- Resend Section -->
        <div class="pt-4 border-t border-gray-100 text-sm">
            <span class="text-gray-500">Tidak menerima kode?</span>
            <div class="mt-2 font-bold">
                <span id="timer-text" class="text-gray-400">Kirim ulang dalam <span id="timer-sec">60</span> detik</span>
                <button id="resend-btn" onclick="resendOtp()" class="text-yellow-950 hover:underline cursor-pointer hidden">
                    Kirim Ulang Kode
                </button>
            </div>
        </div>

        <p class="text-xs text-gray-400">
            Kembali ke <a href="/login" class="text-yellow-950 font-bold hover:underline">Login</a>
        </p>

    </div>

    <!-- CODE CONTROLLER -->
    <script>
        // Extract email from query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const email = urlParams.get('email');

        if (!email) {
            alert('Parameter email tidak ditemukan. Anda akan diarahkan ke halaman login.');
            window.location.href = '/login';
        } else {
            document.getElementById('target-email').textContent = email;
        }

        // --- OTP Input Auto Tabbing ---
        const inputs = document.querySelectorAll('.otp-input');
        
        inputs.forEach((input, index) => {
            // Set focus on first input
            if (index === 0) input.focus();

            input.addEventListener('input', (e) => {
                const value = e.target.value;
                // If input matches numeric digit
                if (value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                checkAutoSubmit();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            // Prevent typing non-digits
            input.addEventListener('keypress', (e) => {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        });

        function checkAutoSubmit() {
            const code = Array.from(inputs).map(i => i.value).join('');
            if (code.length === 4) {
                // Auto trigger form submit for a super slick feel
                document.getElementById('otp-form').dispatchEvent(new Event('submit'));
            }
        }


        // --- Countdown Timer ---
        let countdown = 60;
        const timerText = document.getElementById('timer-text');
        const timerSec = document.getElementById('timer-sec');
        const resendBtn = document.getElementById('resend-btn');
        let timerInterval;

        function startTimer() {
            countdown = 60;
            resendBtn.classList.add('hidden');
            timerText.classList.remove('hidden');
            timerSec.textContent = countdown;
            
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                countdown--;
                timerSec.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(timerInterval);
                    timerText.classList.add('hidden');
                    resendBtn.classList.remove('hidden');
                }
            }, 1000);
        }

        startTimer();


        // --- Resend OTP Logic ---
        async function resendOtp() {
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');

            try {
                const res = await fetch(window.API_BASE_URL + '/auth/resend-verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email })
                });

                const data = await res.json();

                if (res.ok) {
                    successMessage.textContent = 'Kode OTP baru berhasil dikirim!';
                    successMessage.classList.remove('hidden');
                    startTimer();
                } else {
                    errorMessage.textContent = data.message || 'Gagal mengirim ulang OTP';
                    errorMessage.classList.remove('hidden');
                }
            } catch (err) {
                errorMessage.textContent = 'Gagal menghubungi server';
                errorMessage.classList.remove('hidden');
            }
        }


        // --- OTP Form Submission ---
        document.getElementById('otp-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');

            const code = Array.from(inputs).map(i => i.value).join('');

            try {
                const res = await fetch(window.API_BASE_URL + '/auth/verify-email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Timezone': Intl.DateTimeFormat().resolvedOptions().timeZone
                    },
                    body: JSON.stringify({
                        email,
                        otp: code
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    successMessage.textContent = 'Verifikasi berhasil! Mengarahkan Anda...';
                    successMessage.classList.remove('hidden');
                    
                    // Save local token and redirect
                    localStorage.setItem('auth_token', data.token);
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1500);
                } else {
                    errorMessage.textContent = data.message || 'Kode OTP salah atau telah kadaluarsa.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (err) {
                errorMessage.textContent = 'Gagal menghubungi server';
                errorMessage.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
