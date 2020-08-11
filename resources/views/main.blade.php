@extends('layouts.app')

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">The best pizzas for you</h1>
    <p class="lead">Pizza is the perfect satisfying, crowd-pleasing food whatever the time, occasion or craving.</p>
</div>
<div class="container">
    @php
        $numberItemInRow = 0;
    @endphp
    @foreach($pizzas as $key => $pizza)
        @if($numberItemInRow === 0)
            <div class="card-deck mb-3 text-center">
        @endif
        @php
            $numberItemInRow++;
        @endphp
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{ $pizza->title }}</h4>
                </div>
                <div class="card-body">
                    <img class="img-thumbnail" src="{{ asset('storage/images/pizzas/'.$pizza->picture) }}" alt="">
                    <p>{{ $pizza->description }}</p>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Add to cart </button>
                </div>
            </div>
        @if($numberItemInRow === 3)
            </div>
            @php
                $numberItemInRow = 0;
            @endphp
        @endif
    @endforeach
</div>
@endsection
