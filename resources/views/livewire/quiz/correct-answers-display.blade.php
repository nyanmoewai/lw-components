<div class="mt-5 border rounded px-3 py-4">
    <div class="mb-3 fs-5">
        {{ count($answers) > 1 ? 'Correct answers are' : 'Correct answer is' }}
    </div>

    <ul>
        @foreach($answers as $answer)
            <li>{{ $answer }}</li>
        @endforeach
    </ul>
</div>
