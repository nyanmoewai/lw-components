@extends('layouts.master')

@section('content')
<div class="row h-100 align-items-center">
    <div class="col-12 col-md-6 offset-md-3">
        <form action="#" method="GET">
            <div class="form-group">
                <label class="form-label" for="country">Choose a Country</label>

                @livewire('auto-complete-input', [
                    'input_name' => "country",
                    'source' => [
                        1 => 'Myanmar',
                        2 => 'Singapore',
                        3 => 'Malaysia',
                        4 => 'Malaysia 2'
                    ]
                ])
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="country">Choose Food</label>

                @livewire('auto-complete-input', [
                    'input_name' => "food",
                    'source' => [
                        1 => 'Mote Hin Gar',
                        2 => 'Chicken Oil Rice',
                        3 => 'Lazanga'
                    ]
                ])
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="country">Choose Account</label>

                @livewire('auto-complete-input', [
                    'input_name' => "account",
                    'source' => new \App\Models\Account,
                    'options' => [
                        'min_chars' => 5,
                        'source_method' => 'filterResult',
                        'limit' => 3
                    ]
                ])
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
