<div>
    <div class="fs-2 mb-5">{{ $question }}</div>

    @foreach($choices as $choice)
        <div
            class="mb-2 border rounded
                {{ false === $showResult && $this->isSelectedAnswer($choice) ? 'border-info' : '' }}
                {{ $showResult && $this->isSelectedAnswer($choice) && $this->isCorrectChoice($choice) ? 'bg-success-subtle' : '' }}
                {{ $showResult && $this->isSelectedAnswer($choice) && false === $this->isCorrectChoice($choice) ? 'bg-danger-subtle' : '' }}
            "
        >
            <a href="#" class="d-flex justify-content-between w-100 px-4 py-3 text-black text-decoration-none" wire:click.prevent="toggleAnswer('{{ $choice }}')">
                {{ $choice }}
                @if($showResult && $this->isSelectedAnswer($choice))
                    @if($this->isCorrectChoice($choice))
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px;" class="text-success">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                    @else
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px;" class="text-danger">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    @endif
                @endif
            </a>
        </div>
    @endforeach
</div>
