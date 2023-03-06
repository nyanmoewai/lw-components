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
        @elseif($currentQuiz['type'] === 'fill_in_blank')
            @livewire('quiz.fill-in-blank-quiz', [
                $currentQuiz['question'],
                $currentQuiz['answers']
            ], key($currentQuizIndex))
        @elseif($currentQuiz['type'] === 'question_and_answer')
            @livewire('quiz.question-and-answer-quiz', [
                $currentQuiz['question'],
                $currentQuiz['answers']
            ], key($currentQuizIndex))
        @elseif($currentQuiz['type'] === 'rearrange_words')
            @livewire('quiz.rearrange-words-quiz', [
                $currentQuiz['question'],
                $currentQuiz['answers']
            ], key($currentQuizIndex))
        @elseif($currentQuiz['type'] === 'matching')
            @livewire('quiz.matching-quiz', [
                $currentQuiz['question'],
                $currentQuiz['matches']
            ], key($currentQuizIndex))
        @endif
    </div>
    <div class="small text-danger mt-2">{{ $failedValidationMessage }}</div>

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
        $isCheckedAnswer && false === $checkedAnswerData['is_correct_all']
    )
        @include('livewire.quiz.correct-answers-display', [
            'type' => $currentQuiz['type'],
            'answers' => $checkedAnswerData['correct_answers']
        ])
    @endif

</div>
