<?php

use Livewire\Component;

new class extends Component {
    public $contentBlocks = [];

    public function mount(array $content)
    {
        $this->contentBlocks = $content;
    }
};
?>

<div class="w-full relative z-20">
    <div class="w-full">

        {{-- 1. LAYOUT: SINGLE COLUMN --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'single_col')
            <!-- Diperbaiki: Penambahan tanda kutip ganda penutup yang sebelumnya hilang -->
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col space-y-8 md:space-y-12">
                    @foreach ($contentBlocks['columns']['main'] ?? [] as $item)
                        @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                    @endforeach
                </div>
            </div>
        @endif

        {{-- 2. LAYOUT: KATA SAMBUTAN (Khusus) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'kata_sambutan')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Menggunakan basis 12 kolom untuk proporsi yang lebih premium (Misal 5:7) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                    {{-- Kolom Kiri (Biasanya untuk Foto Profil) --}}
                    <div class="lg:col-span-5 flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['left'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>

                    {{-- Kolom Kanan (Teks Sambutan) --}}
                    <div class="lg:col-span-7 flex flex-col space-y-6">
                        @foreach ($contentBlocks['columns']['right'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- 3. LAYOUT: TWO COLUMNS (50% : 50%) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'two_col')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14">
                    <div class="flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['left'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                    <div class="flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['right'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- 4. LAYOUT: TWO COLUMNS (1/3 : 2/3) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'two_col_1_2')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Diubah ke sistem 12 kolom: 4 kolom kiri, 8 kolom kanan --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                    <div class="lg:col-span-4 flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['left'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                    <div class="lg:col-span-8 flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['right'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- 5. LAYOUT: TWO COLUMNS (2/3 : 1/3) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'two_col_2_1')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Diubah ke sistem 12 kolom: 8 kolom kiri, 4 kolom kanan --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                    <div class="lg:col-span-8 flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['left'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                    <div class="lg:col-span-4 flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['right'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- 6. LAYOUT: THREE COLUMNS (33.3% : 33.3% : 33.3%) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'three_col')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                    <div class="flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['col1'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                    <div class="flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['col2'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                    <div class="flex flex-col space-y-8">
                        @foreach ($contentBlocks['columns']['col3'] ?? [] as $item)
                            @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- 7. LAYOUT: GALLERY GRID (Eco-Industrial Premium Wrapper) --}}
        @if (($contentBlocks['layout_type'] ?? '') === 'gallery_grid')
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                    @foreach ($contentBlocks['columns']['gallery'] ?? [] as $item)
                        <!-- Premium Gallery Card Wrapper -->
                        <div class="group relative overflow-hidden bg-white rounded-[1.5rem] border border-slate-200/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.2)] hover:border-emerald-300 hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)]">
                            
                            <!-- Overlay Inner Shadow -->
                            <div class="absolute inset-0 border-[3px] border-black/5 pointer-events-none z-20 rounded-[1.5rem]"></div>
                            
                            <!-- Komponen Gambar/Konten -->
                            <div class="relative w-full h-full transform transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                                @include('components.thema.ecoindustrial.render-component', ['item' => $item])
                            </div>
                            
                            <!-- Subtle Emerald Gradient Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none z-10"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>