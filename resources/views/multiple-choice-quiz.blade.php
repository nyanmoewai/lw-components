@extends('layouts.master')

@section('content')
<div class="row pt-5">
    <div class="col-12 col-md-6 offset-md-3">
        @livewire('multiple-choice-quiz', [
            [
                'question' => 'What is the name of the U.S president?',
                'answers' => [
                    'Joe Biden' => true,
                    'Donald Trump' => false,
                ]
            ],
            [
                'question' => 'What color is an apple?',
                'answers' => [
                    'Blue' => false,
                    'Yellow' => false,
                    'Green' => true,
                    'Red' => true,
                    'Orange' => false,
                    'Brown' => false,
                ]
            ],
            [
                'question' => 'What color is an orange?',
                'answers' => [
                    'Blue' => false,
                    'Yellow' => false,
                    'Green' => false,
                    'Red' => false,
                    'Orange' => true,
                    'Brown' => false,
                ]
            ]
        ])
    </div>
</div>
@endsection
