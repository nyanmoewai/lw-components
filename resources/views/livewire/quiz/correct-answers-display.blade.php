<div class="mt-5 border rounded px-3 py-4">
    <div class="mb-3 fs-5">
        @if(count($answers) > 1)
            Correct answers are
        @else
            Correct answer is
        @endif
    </div>

    <ul>
        @foreach($answers as $answer)
            <li>{{ $answer }}</li>
        @endforeach
    </ul>
</div>
