<div>
    <div class="fs-2 mb-5">{{ $question }}</div>

    @foreach($answers as $answer => $result)
        <div
            class="mb-2 border rounded
                {{ false === $showResult && $this->isSelectedAnswer($answer) ? 'border-info' : '' }}
                {{ $showResult && $this->isSelectedAnswer($answer) && $result ? 'bg-success-subtle' : '' }}
                {{ $showResult && $this->isSelectedAnswer($answer) && false === $result ? 'bg-danger-subtle' : '' }}
            "
        >
            <a href="#" class="d-flex justify-content-between w-100 px-4 py-3 text-black text-decoration-none" wire:click.prevent="toggleAnswer('{{ $answer }}')">
                {{ $answer }}
                @if($showResult && $this->isSelectedAnswer($answer))
                    @if($result)
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

    @includeWhen(
        $showResult && false === $isCorrectAll,
        'livewire.quiz.correct-answers-display', [
            'answers' => $correctAnswers
        ]
    )
</div>
