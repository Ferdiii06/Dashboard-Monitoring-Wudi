@extends('layouts.app')

@section('title', 'Help & Support - WUDI Monitoring')
@section('section_title', 'Help & Support')
@section('section_description', 'Pusat bantuan dan dokumentasi untuk penggunaan WUDI.')

@section('content')
    <div class="space-y-6">
        
        <!-- HEADER CARD -->
        <div class="rounded-[2.5rem] bg-[#3c2a21] text-white p-10 shadow-lg relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/5 blur-3xl"></div>
            
            <div class="relative z-10 max-w-2xl">
                <h1 class="text-3xl font-extrabold mb-4">How can we help you?</h1>
                <p class="text-white/80 text-sm leading-relaxed mb-6">
                    Temukan panduan, FAQ, dan dokumentasi lengkap mengenai penggunaan sistem Monitoring WUDI. Jika Anda mengalami kendala teknis, tim dukungan kami siap membantu 24/7.
                </p>
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="faq-search" class="block w-full p-4 pl-12 text-sm text-slate-900 border border-slate-200 rounded-2xl bg-white focus:ring-yellow-950 focus:border-yellow-950" placeholder="Search for help topics, guides, etc...">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- FAQ Section -->
            <div class="md:col-span-2 space-y-6">
                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-yellow-500"></span>
                        Frequently Asked Questions
                    </h2>
                    
                    <div class="space-y-4">
                        <details class="faq-item group border border-slate-100 rounded-2xl bg-slate-50 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer">
                                <h2 class="font-bold text-slate-800 text-sm">Bagaimana cara melihat laporan aktivitas user?</h2>
                                <span class="relative ml-1.5 h-5 w-5 shrink-0">
                                    <svg class="absolute inset-0 w-5 h-5 opacity-100 group-open:opacity-0 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <svg class="absolute inset-0 w-5 h-5 opacity-0 group-open:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </summary>
                            <div class="px-4 pb-4 text-xs text-slate-600 leading-relaxed border-t border-slate-200 pt-4">
                                Anda dapat menavigasi ke menu <strong>Report</strong> di bilah sisi. Di sana, Anda bisa melakukan pemfilteran berdasarkan tanggal, mengekspor laporan dalam bentuk CSV atau PDF, dan melihat aktivitas pengguna secara detail.
                            </div>
                        </details>

                        <details class="faq-item group border border-slate-100 rounded-2xl bg-slate-50 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer">
                                <h2 class="font-bold text-slate-800 text-sm">Bagaimana cara kerja AI Assistant (WUDI)?</h2>
                                <span class="relative ml-1.5 h-5 w-5 shrink-0">
                                    <svg class="absolute inset-0 w-5 h-5 opacity-100 group-open:opacity-0 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <svg class="absolute inset-0 w-5 h-5 opacity-0 group-open:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </summary>
                            <div class="px-4 pb-4 text-xs text-slate-600 leading-relaxed border-t border-slate-200 pt-4">
                                WUDI AI Assistant terintegrasi secara *real-time* dengan database monitoring Anda. Anda cukup mengetik pertanyaan seperti <em>"Beri summary dashboard hari ini"</em>, dan AI akan merangkum metrik aktif, log keamanan, dan peringatan dalam poin-poin natural.
                            </div>
                        </details>

                        <details class="faq-item group border border-slate-100 rounded-2xl bg-slate-50 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer">
                                <h2 class="font-bold text-slate-800 text-sm">Dimana saya bisa mengatur integrasi API?</h2>
                                <span class="relative ml-1.5 h-5 w-5 shrink-0">
                                    <svg class="absolute inset-0 w-5 h-5 opacity-100 group-open:opacity-0 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <svg class="absolute inset-0 w-5 h-5 opacity-0 group-open:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </summary>
                            <div class="px-4 pb-4 text-xs text-slate-600 leading-relaxed border-t border-slate-200 pt-4">
                                Buka menu <strong>Settings</strong> pada *sidebar*, lalu navigasikan ke *API Integrations* atau konfigurasi sistem. Seluruh konfigurasi sensitif hanya bisa diakses oleh *Administrator*.
                            </div>
                        </details>
                    </div>
                </div>
            </div>

            <!-- Contact Support Widget -->
            <div class="md:col-span-1 space-y-6">
                <div class="rounded-[2.5rem] border border-yellow-950/20 bg-[#fff8e7] p-8 shadow-sm">
                    <div class="h-12 w-12 rounded-2xl bg-yellow-950 text-white flex items-center justify-center mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-yellow-950 mb-2">Butuh bantuan lebih?</h3>
                    <p class="text-xs text-slate-600 mb-6 leading-relaxed">
                        Jika FAQ tidak menjawab pertanyaan Anda, silakan hubungi tim dukungan IT atau teknisi jaringan Anda.
                    </p>
                    <button class="w-full text-center rounded-2xl bg-yellow-950 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition shadow-md border-0 cursor-pointer">
                        Kontak Tim IT WUDI
                    </button>
                </div>

                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm text-center">
                    <div class="h-12 w-12 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center mb-6 mx-auto">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 mb-2">Dokumentasi API</h3>
                    <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                        Pelajari cara menghubungkan aplikasi mobile/web ke WUDI backend.
                    </p>
                    <a href="#" class="inline-block w-full text-center rounded-2xl border border-slate-200 bg-white py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition shadow-sm" onclick="alert('Dokumentasi sedang dalam pengembangan.')">
                        Baca Dokumentasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('faq-search');
            const faqs = document.querySelectorAll('.faq-item');

            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                
                faqs.forEach(faq => {
                    const text = faq.innerText.toLowerCase();
                    if (text.includes(term)) {
                        faq.style.display = 'block';
                    } else {
                        faq.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
