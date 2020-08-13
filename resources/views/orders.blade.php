@extends('layouts.app')

@section('header', View::make('layouts.main_header', ['cart_total_price' => $cart_total_price]))

@section('footer', View::make('layouts.main_footer'))

@section('content')
    <h1>Orders history</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Items</th>
            <th scope="col">Total price</th>
            <th scope="col">Datetime</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <th scope="row">{{ $order->surname }} {{ $order->name }}</th>
            <th scope="row">{{ $order->phone }}</th>
            <th scope="row">{{ $order->address }}</th>
            <td>
                <ul>
                    @foreach($order->pizzas as $pizza)
                        <li>{{ $pizza->title }} - {{ $pizza->pivot->quantity }} it.</li>
                    @endforeach
                </ul>
            </td>
            <td>$ {{ sprintf("%.2f", $order->price/100) }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
