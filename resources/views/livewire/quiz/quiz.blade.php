<div>
    <div class="fs-1 mb-3 text-secondary">
        <span>Quiz {{ $currentQuizIndex + 1 }}</span>
    </div>

    <div>
        @if($currentQuiz['type'] === 'multiple_choice')
            @livewire('quiz.multiple-choice-quiz', [
                $currentQuiz['question'],
                $currentQuiz['choices'],
                $currentQuiz['answers']
            ], key($currentQuizIndex))
        @endif
    </div>
    <div class="small text-danger">{{ $failedValidationMessage }}</div>

   <div class="mt-5 text-end">
        <button class="btn btn-outline-success" type="button" wire:click="checkAnswer" @disabled($isCheckingAnswer || $isCheckedAnswer)>
            @if($isCheckingAnswer)
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            @endif
            Check Answer
        </button>

        @if($this->hasNext())
            <button class="btn btn-outline-success" wire:click="goNext" @disabled(false === $isCheckedAnswer)>
                <span>Next</span>
            </button>
        @endif
    </div>

    @if(
        $isCheckedAnswer
        && $checkedAnswerData['show_result']
        && false === $checkedAnswerData['is_correct_all']
    )
        @include('livewire.quiz.correct-answers-display', [
            'answers' => $checkedAnswerData['correct_answers']
        ])
    @endif

</div>
