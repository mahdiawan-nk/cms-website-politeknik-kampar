<?php

use Livewire\Component;

new class extends Component {
    // Logika tema dihapus untuk permanen ke Stanford Style
}; ?>

<footer class="mt-auto bg-[#FFF5EE] text-[#5C271E] border-t border-[#F1D0B7]">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12">

            {{-- Kolom Identitas (Stanford Serif Style) --}}
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-2xl font-bold font-serif text-[#8C1515]">
                    POLITEKNIK KAMPAR
                </h2>
                <p class="text-sm leading-relaxed max-w-sm font-sans text-[#7A4B42]">
                    Menjadi institusi pendidikan vokasi unggulan yang menghasilkan lulusan berintegritas, inovatif, dan
                    siap berkompetisi di skala global.
                </p>
                <div class="flex space-x-4 pt-4">
                    @foreach (['Facebook', 'Instagram', 'Twitter', 'YouTube'] as $social)
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-[#F1D0B7] text-[#8C1515] hover:bg-[#8C1515] hover:text-white transition-all">
                            <span class="sr-only">{{ $social }}</span>
                            <span class="text-xs">in</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Kolom Link Navigasi --}}
            <div>
                <h3 class="font-bold mb-6 uppercase tracking-widest font-serif text-[#8C1515]">Akademik</h3>
                <ul class="space-y-3 text-sm font-sans">
                    <li><a href="#" class="hover:underline">Pendaftaran PMB</a></li>
                    <li><a href="#" class="hover:underline">Program Studi</a></li>
                    <li><a href="#" class="hover:underline">Kalender Akademik</a></li>
                    <li><a href="#" class="hover:underline">Perpustakaan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-6 uppercase tracking-widest font-serif text-[#8C1515]">Layanan</h3>
                <ul class="space-y-3 text-sm font-sans">
                    <li><a href="#" class="hover:underline">SIAKAD</a></li>
                    <li><a href="#" class="hover:underline">E-Learning</a></li>
                    <li><a href="#" class="hover:underline">Lowongan Kerja</a></li>
                    <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-6 uppercase tracking-widest font-serif text-[#8C1515]">Kontak</h3>
                <ul class="space-y-3 text-sm font-sans">
                    <li>Jl. Lingkar Luar, Kampar</li>
                    <li>Riau, Indonesia</li>
                    <li>info@poltek-kampar.ac.id</li>
                    <li>(0761) 123456</li>
                </ul>
            </div>
        </div>

        {{-- Footer Bawah --}}
        <div
            class="mt-16 pt-8 border-t border-[#F1D0B7] text-xs font-sans text-[#7A4B42] flex flex-col md:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} Politeknik Kampar. All rights reserved.</p>
            <div class="flex space-x-6">
                <a href="#" class="hover:underline">Privasi</a>
                <a href="#" class="hover:underline">Ketentuan Layanan</a>
                <a href="#" class="hover:underline">Peta Situs</a>
            </div>
        </div>
    </div>
</footer>
