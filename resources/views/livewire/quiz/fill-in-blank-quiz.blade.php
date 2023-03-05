<div>
    <div class="fs-2 mb-5">
        @php $counter = 0; @endphp
        @foreach($question_chunks as $question_chunk)
            @if($question_chunk === '{___}')
                <input
                    type="text"
                    class="
                        blank-input form-control fs-4 d-inline-block
                        {{ $showResult && $this->isAnswerCorrect($counter) ? 'bg-success-subtle' : '' }}
                        {{ $showResult && false === $this->isAnswerCorrect($counter) ? 'bg-danger-subtle' : '' }}
                    "
                    wire:model="filledAnswers.{{ $counter }}"
                >
                @php $counter++; @endphp
            @else
                {{ $question_chunk }}
            @endif
        @endforeach
    </div>
</div>
