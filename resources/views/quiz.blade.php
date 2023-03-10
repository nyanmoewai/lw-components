@extends('layouts.master')

@section('content')
<div class="row pt-5">
    <div class="col-12 col-md-6 offset-md-3">
        @livewire('quiz.quiz', [
            // [
            //     'type' => 'rearrange_words',
            //     'question' => 'Please rearrange words.',
            //     'answers' => [
            //         'You',
            //         'are',
            //         'my',
            //         'angel',
            //         'you',
            //         'are',
            //         'so',
            //         'beautiful',
            //     ]
            // ],
            // [
            //     'type' => 'question_and_answer',
            //     'question' => 'What is your name',
            //     'answers' => [
            //         'Nyan',
            //         'Nyan Moe',
            //         'Nyan Moe Wai Thwin'
            //     ]
            // ],
            // [
            //     'type' => 'fill_in_blank',
            //     'question' => 'The color of an orange is {___} or {___}?',
            //     'answers' => [
            //         'orange',
            //         'red'
            //     ]
            // ],
            // [
            //     'type' => 'fill_in_blank',
            //     'question' => 'The color of an apple is {___} or {___}?',
            //     'answers' => [
            //         'red',
            //         'green'
            //     ]
            // ],
            // [
            //     'type' => 'multiple_choice',
            //     'question' => 'What is the name of the U.S president?',
            //     'choices' => ['Joe Biden', 'Donald Trump'],
            //     'answers' => ['Joe Biden']
            // ],
            [
                'type' => 'matching',
                'question' => 'Please match the fruit and its color.',
                'matches' => [
                    'Apple' => 'Red',
                    'Orange' => 'Orange',
                    'Banana' => 'Yellow',
                    'Grape' => 'Purple',
                    'Guava' => 'Green'
                ]
            ],
            [
                'type' => 'multiple_choice',
                'question' => '{___} is the president of the U.S?',
                'choices' => ['Joe Biden', 'Donald Trump'],
                'answers' => ['Joe Biden']
            ],
        ])
    </div>
</div>
@endsection
