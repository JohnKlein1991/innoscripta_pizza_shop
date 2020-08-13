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
                <input type="number" data-pizza-id="{{ $pizza->id }}" value="{{ $cart_data[$pizza->id] }}" min="1">
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

    <form method="POST" action="/order/create">
        @csrf
        <div class="form-group row">
            <label for="inputFirstName" class="col-sm-2 col-form-label">First name</label>
            <div class="col-sm-10">
                <input required name="first_name" type="text" class="form-control" id="inputFirstName" placeholder="First name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputLastName" class="col-sm-2 col-form-label">Last name</label>
            <div class="col-sm-10">
                <input required name="last_name" type="text" class="form-control" id="inputLastName" placeholder="Last name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input required name="phone" type="text" class="form-control" id="inputPhone" placeholder="+1234567">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input required name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Checkout</button>
            </div>
        </div>
    </form>
</div>
@endsection
