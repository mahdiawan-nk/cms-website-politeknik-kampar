@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between w-full">

        <!-- Mobile View (Tombol Simple Prev/Next) -->
        <div class="flex justify-between flex-1 sm:hidden gap-2">
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed">
                    &laquo; Sebelumnya
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-300 transition">
                    &laquo; Sebelumnya
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-300 transition">
                    Berikutnya &raquo;
                </button>
            @else
                <span
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed">
                    Berikutnya &raquo;
                </span>
            @endif
        </div>

        <!-- Desktop View -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-6">

            <!-- Info Jumlah Data -->
            <div>
                <p class="text-xs text-slate-500">
                    Menampilkan
                    <span class="font-bold text-slate-800">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-bold text-slate-800">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
                    artikel
                </p>
            </div>

            <!-- Angka Pagination & Tombol Navigasi -->
            <div>
                <span
                    class="inline-flex items-center gap-1.5 p-1.5 bg-slate-100/80 border border-slate-200/80 rounded-2xl shadow-inner">

                    {{-- Previous Page Button --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true">
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 text-slate-300 bg-white/50 border border-slate-200/50 rounded-xl cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                            class="inline-flex items-center justify-center w-9 h-9 text-slate-600 bg-white border border-slate-200/80 rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 shadow-sm transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-slate-400">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-white bg-emerald-600 rounded-xl shadow-md shadow-emerald-600/30 border border-emerald-500">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                        class="inline-flex items-center justify-center w-9 h-9 text-xs font-semibold text-slate-700 bg-white border border-slate-200/80 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-300 transition duration-200">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Button --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                            class="inline-flex items-center justify-center w-9 h-9 text-slate-600 bg-white border border-slate-200/80 rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 shadow-sm transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    @else
                        <span aria-disabled="true">
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 text-slate-300 bg-white/50 border border-slate-200/50 rounded-xl cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </span>
                    @endif

                </span>
            </div>

        </div>
    </nav>
@endif
