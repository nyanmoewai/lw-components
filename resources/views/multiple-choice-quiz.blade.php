@extends('layouts.master')

@section('content')
<div class="row pt-5">
    <div class="col-12 col-md-6 offset-md-3">
        @livewire('quiz.multiple-choice-quiz', [
            'What is the name of the U.S president?',
            [
                'Joe Biden' => true,
                'Donald Trump' => false,
            ]
        ])

        <div class="mt-5 text-end">
            <button class="btn btn-outline-success" id="btn-check-answer">
                <span>Check Answer</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        document.getElementById('btn-check-answer').addEventListener('click', function(e) {
            Livewire.emit('checkAnswer');
        });
    </script>
@endpush
