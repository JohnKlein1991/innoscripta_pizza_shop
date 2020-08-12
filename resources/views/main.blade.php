@extends('layouts.app')

@section('header', View::make('layouts.main_header', ['cart_total_price' => $cart_total_price]))

@section('footer', View::make('layouts.main_footer'))

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
            <div class="pizza-card card mb-4 box-shadow" data-pizza-id="{{ $pizza->id }}">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{ $pizza->title }}</h4>
                </div>
                <div class="card-body">
                    <img class="img-thumbnail" src="{{ asset('storage/images/pizzas/'.$pizza->picture) }}" alt="">
                    <p>{{ $pizza->description }}</p>
                    <p>{{ sprintf("%.2f", $pizza->price/100) }} $</p>
                    <button type="button" class="add_to_cart btn btn-lg btn-block btn-primary">
                        Add to cart
                    </button>
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
