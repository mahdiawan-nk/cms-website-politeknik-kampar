<x-filament-panels::page>
    <div class="space-y-4">
        @forelse ($navigations as $menu)
            {{-- LEVEL 1: Card Root Menu --}}
            {{-- Tambahkan x-data="{ isExpanded: true }" di sini. Ubah 'true' ke 'false' jika ingin menu tertutup secara default --}}
            <div x-data="{ isExpanded: true }"
                class="overflow-hidden bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm transition-all duration-200 hover:shadow-md">

                {{-- Header Level 1 --}}
                <div
                    class="p-4 bg-gray-50/70 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between gap-4">

                    {{-- Area Kiri (Bisa diklik untuk expand/collapse) --}}
                    <div class="flex items-center gap-3 cursor-pointer select-none" @click="isExpanded = !isExpanded">
                        {{-- Icon Chevron Buka/Tutup --}}
                        <div class="text-gray-400 transition-transform duration-300"
                            :class="isExpanded ? 'rotate-180' : ''">
                            <x-heroicon-m-chevron-down class="w-5 h-5" />
                        </div>

                        <div class="p-2 rounded-lg bg-primary-500/10 text-primary-600 dark:text-primary-400">
                            <x-heroicon-m-folder class="w-5 h-5" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3
                                    class="font-semibold text-gray-900 dark:text-white text-base hover:text-primary-600 transition-colors">
                                    {{ $menu->label_text }}
                                </h3>
                                <x-filament::badge :color="$menu->is_active ? 'success' : 'gray'" size="sm">
                                    {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                </x-filament::badge>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-mono mt-0.5">
                                {{ $menu->url }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions Level 1 --}}
                    <div class="flex items-center gap-1">
                        <x-filament::icon-button :icon="$menu->is_active ? 'heroicon-m-eye-slash' : 'heroicon-m-eye'" :color="$menu->is_active ? 'warning' : 'success'"
                            tooltip="{{ $menu->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                            wire:click="toggleActive({{ $menu->id }})" />
                        <x-filament::icon-button icon="heroicon-m-pencil-square" color="info" tooltip="Edit"
                            wire:click="mountAction('edit', { record: {{ $menu->id }} })" />
                        <x-filament::icon-button icon="heroicon-m-trash" color="danger" tooltip="Hapus"
                            wire:click="mountAction('delete', { record: {{ $menu->id }} })" />
                    </div>
                </div>

                {{-- LEVEL 2 & 3 Container (Dibungkus x-show dan x-collapse) --}}
                @if ($menu->children->isNotEmpty())
                    <div x-show="isExpanded" x-collapse>
                        <div class="p-4 space-y-3">
                            @foreach ($menu->children as $child)
                                {{-- x-data untuk Level 2 --}}
                                <div x-data="{ isChildExpanded: true }" class="group/level2">

                                    {{-- Item Level 2 --}}
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-gray-50/50 dark:bg-gray-800/30 border border-gray-100 dark:border-gray-800/80 hover:border-gray-300 dark:hover:border-gray-700 transition-all">

                                        {{-- Area Kiri Level 2 --}}
                                        <div class="flex items-center gap-3 pl-2 cursor-pointer select-none"
                                            @if ($child->children->isNotEmpty()) @click="isChildExpanded = !isChildExpanded" @endif>

                                            {{-- Jika punya anak (Level 3), tampilkan Chevron. Jika tidak, tampilkan Dot (titik) --}}
                                            @if ($child->children->isNotEmpty())
                                                <div class="text-gray-400 transition-transform duration-300"
                                                    :class="isChildExpanded ? 'rotate-180' : ''">
                                                    <x-heroicon-m-chevron-down class="w-4 h-4" />
                                                </div>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                                            @endif

                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-medium text-sm text-gray-800 dark:text-gray-200 hover:text-primary-600 transition-colors">
                                                        {{ $child->label_text }}
                                                    </span>
                                                    <x-filament::badge :color="$child->is_active ? 'success' : 'gray'" size="xs">
                                                        {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </x-filament::badge>
                                                </div>
                                                <span class="text-xs text-gray-400 font-mono">
                                                    {{ $child->url}}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Actions Level 2 --}}
                                        <div
                                            class="flex items-center gap-1 opacity-80 group-hover/level2:opacity-100 transition-opacity">
                                            <x-filament::icon-button :icon="$child->is_active ? 'heroicon-m-eye-slash' : 'heroicon-m-eye'" :color="$child->is_active ? 'warning' : 'success'" size="sm"
                                                tooltip="{{ $child->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                wire:click="toggleActive({{ $child->id }})" />
                                            <x-filament::icon-button icon="heroicon-m-pencil-square" color="info"
                                                size="sm" tooltip="Edit"
                                                wire:click="mountAction('edit', { record: {{ $child->id }} })" />
                                            <x-filament::icon-button icon="heroicon-m-trash" color="danger"
                                                size="sm" tooltip="Hapus"
                                                wire:click="mountAction('delete', { record: {{ $child->id }} })" />
                                        </div>
                                    </div>

                                    {{-- LEVEL 3 Container (Dibungkus x-show dan x-collapse) --}}
                                    @if ($child->children->isNotEmpty())
                                        <div x-show="isChildExpanded" x-collapse>
                                            <div
                                                class="mt-2 ml-6 pl-4 border-l-2 border-dashed border-gray-200 dark:border-gray-800 space-y-1.5">
                                                @foreach ($child->children as $grandchild)
                                                    <div
                                                        class="flex items-center justify-between p-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group/level3">
                                                        <div class="flex items-center gap-2">
                                                            <x-heroicon-m-arrow-turn-down-right
                                                                class="w-3.5 h-3.5 text-gray-400" />
                                                            <span
                                                                class="text-xs text-gray-600 dark:text-gray-400 font-medium">
                                                                {{ $grandchild->label_text }}
                                                            </span>
                                                            <span class="text-[10px] text-gray-400 font-mono">
                                                                ({{ $grandchild->url}})
                                                            </span>
                                                            <x-filament::badge :color="$grandchild->is_active ? 'success' : 'gray'" size="xs">
                                                                {{ $grandchild->is_active ? 'Aktif' : 'Nonaktif' }}
                                                            </x-filament::badge>
                                                        </div>

                                                        {{-- Actions Level 3 --}}
                                                        <div
                                                            class="flex items-center gap-1 opacity-0 group-hover/level3:opacity-100 transition-opacity">
                                                            <x-filament::icon-button :icon="$grandchild->is_active
                                                                ? 'heroicon-m-eye-slash'
                                                                : 'heroicon-m-eye'" :color="$grandchild->is_active ? 'warning' : 'success'"
                                                                size="sm"
                                                                tooltip="{{ $grandchild->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                                wire:click="toggleActive({{ $grandchild->id }})" />
                                                            <x-filament::icon-button icon="heroicon-m-pencil-square"
                                                                color="info" size="sm" tooltip="Edit"
                                                                wire:click="mountAction('edit', { record: {{ $grandchild->id }} })" />

                                                            <x-filament::icon-button icon="heroicon-m-trash"
                                                                color="danger" size="sm" tooltip="Hapus"
                                                                wire:click="mountAction('delete', { record: {{ $grandchild->id }} })" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div
                class="text-center p-12 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                <x-heroicon-o-queue-list class="w-12 h-12 mx-auto text-gray-400 mb-3" />
                <h3 class="text-base font-semibold text-gray-900 dark:text-white">Belum Ada Navigasi</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tambahkan menu baru menggunakan tombol di atas.
                </p>
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
