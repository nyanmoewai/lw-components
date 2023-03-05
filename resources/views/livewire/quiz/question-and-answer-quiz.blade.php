<div>
    <div class="fs-2 mb-5">{{ $question }}</div>

    <div>
        <textarea
            rows="6"
            wire:model="submitAnswer"
            class="
                form-control
                {{ $showResult && $this->isAnswerCorrect() ? 'bg-success-subtle' : '' }}
                {{ $showResult && false === $this->isAnswerCorrect() ? 'bg-danger-subtle' : '' }}
            "
            @disabled($showResult)
        ></textarea>
    </div>
</div>
