@extends('layouts.master')

@section('content')
<div class="row pt-5">
    <div class="col-12 col-md-6 offset-md-3">
        @livewire('quiz.quiz', [
            // [
            //     'type' => 'multiple_choice',
            //     'question' => 'What is the color of an apple?',
            //     'choices' => ['Red', 'Orange'],
            //     'answers' => ['Red']
            // ],
            [
                'type' => 'fill_in_blank',
                'question' => 'The color of an orange is {___} or {___}?',
                'answers' => [
                    'orange',
                    'red'
                ]
            ],
            [
                'type' => 'fill_in_blank',
                'question' => 'The color of an apple is {___} or {___}?',
                'answers' => [
                    'red',
                    'green'
                ]
            ],
            [
                'type' => 'multiple_choice',
                'question' => 'What is the name of the U.S president?',
                'choices' => ['Joe Biden', 'Donald Trump'],
                'answers' => ['Joe Biden']
            ],
        ])
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
