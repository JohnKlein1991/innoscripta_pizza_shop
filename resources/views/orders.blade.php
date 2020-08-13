@extends('layouts.app')

@section('header', View::make('layouts.main_header', ['cart_total_price' => $cart_total_price]))

@section('footer', View::make('layouts.main_footer'))

@section('content')
    <h1>Orders history</h1>
@endsection
