<?php

use Livewire\Component;
new class extends Component {
    public string $badge = '';
    public string $title = '';
    public string $description = '';

    public function mount(string $badge = '', string $title = '', string $description = ''): void
    {
        $this->title = $title;
        $this->description = $description;
        $this->badge = $badge;
    }
};
?>

<div class="mb-12 lg:mb-16 max-w-2xl">

    @if ($badge)
        <h2 class="text-xs font-bold tracking-widest uppercase mb-3 font-sans text-amber-600">
            {{ $badge }}
        </h2>
    @endif

    @if ($title)
        <h3 class="text-3xl sm:text-4xl tracking-tight font-bold font-serif text-[#8C1515]">
            {{ $title }}
        </h3>
    @endif

    @if ($description)
        <p class="mt-4 text-sm leading-relaxed text-stone-500 font-sans">
            {{ $description }}
        </p>
    @endif

</div>
