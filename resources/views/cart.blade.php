@extends('layouts.app')

@section('header', View::make('layouts.main_header', ['cartTotalPrice' => $cartTotalPrice]))

@section('footer', View::make('layouts.main_footer'))

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Your cart</h1>
</div>
<div class="container">

</div>
@endsection
