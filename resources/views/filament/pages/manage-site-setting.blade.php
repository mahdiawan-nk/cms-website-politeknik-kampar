<x-filament-panels::page>
    <form wire:submit.prevent="save"
        class="space-y-6 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-6 rounded-xl shadow-sm">
        {{ $this->form }}

        <div class="flex justify-end gap-3 border-t border-gray-100 dark:border-gray-800 pt-4">
            <!-- Tombol Batal -->
            <x-filament::button type="button" color="gray" wire:click="toggleEdit">
                Batal
            </x-filament::button>

            <!-- Tombol Simpan -->
            <x-filament::button type="submit" color="primary">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
