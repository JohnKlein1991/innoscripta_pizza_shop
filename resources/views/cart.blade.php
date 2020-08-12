@extends('layouts.app')

@section('header', View::make('layouts.main_header', ['cart_total_price' => $cart_total_price]))

@section('footer', View::make('layouts.main_footer'))

@section('content')
<h1>Shopping Cart</h1>

<div class="shopping-cart">

    <div class="column-labels">
        <label class="product-image">Image</label>
        <label class="product-details">Product</label>
        <label class="product-price">Price</label>
        <label class="product-quantity">Quantity</label>
        <label class="product-removal">Remove</label>
        <label class="product-line-price">Total</label>
    </div>

    @foreach($pizzas as $pizza)
        <div class="product" data-pizza-id="{{ $pizza->id }}">
            <div class="product-image">
                <img src="{{ asset('storage/images/pizzas/'.$pizza->picture) }}">
            </div>
            <div class="product-details">
                <div class="product-title">{{ $pizza->title }}</div>
                <p class="product-description">{{ $pizza->description }}</p>
            </div>
            <div class="product-price">{{ sprintf("%.2f", $pizza->price/100) }}</div>
            <div class="product-quantity">
                <input type="number" value="{{ $cart_data[$pizza->id] }}" min="1">
            </div>
            <div class="product-removal">
                <button class="remove-product" data-pizza-id="{{ $pizza->id }}">
                    Remove
                </button>
            </div>
            <div class="product-line-price">{{ sprintf("%.2f", $pizza->price * $cart_data[$pizza->id]/100) }} $</div>
        </div>
    @endforeach

    <div class="totals">
        <div class="totals-item">
            <label>Subtotal</label>
            <div class="totals-value" id="cart-subtotal"><span class="total_price">{{ $cart_total_price }}</span></div>
        </div>
        <div class="totals-item">
            <label>Shipping</label>
            <div class="totals-value" id="cart-shipping"><span class="delivery_price">{{ $delivery_price }}</span></div>
        </div>
        <div class="totals-item totals-item-total">
            <label>Grand Total</label>
            <div class="totals-value" id="cart-total"><span class="grand_total">{{ $cart_total_price + $delivery_price }}</span></div>
        </div>
    </div>

    <button class="checkout">Checkout</button>

</div>
@endsection
