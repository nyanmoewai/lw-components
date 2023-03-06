<div>
    <div class="fs-2 mb-5">{{ $question }}</div>

    <div class="mb-5 border rounded p-3" style="min-height: 150px;">
        @foreach($arrangedWords as $index => $word)
            <a href="#"
                class="
                    fw-normal border rounded px-3 py-2 me-1 text-black text-decoration-none position-relative
                    {{ $showResult && $this->isAnswerCorrect() ? 'bg-success-subtle' : '' }}
                    {{ $showResult && false === $this->isAnswerCorrect() ? 'bg-danger-subtle' : '' }}
                "
                wire:click="remove('{{ $index }}')"

            >{{ $word }}</a>
        @endforeach
    </div>

    <div>
        @foreach($unArrangedWords as $index => $word)
            <a href="#"
                class="fw-normal border rounded px-3 py-2 me-1 text-black text-decoration-none"
                wire:click="arrange('{{ $index }}')"
            >{{ $word }}</a>
        @endforeach
    </div>
</div>
