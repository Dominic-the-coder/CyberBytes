@extends('layouts.app')

@section('title', 'Cart')

@section('content')

@if($user)
<!-- Cart page -->
<div class="container card rounded shadow-lg mt-5 mb-5 p-4">
    <h2 class="fw-bold mt-3">Your Shopping Cart</h2>

    @if($userCart->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            Your cart is currently empty.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-4">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userCart as $cartItem)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ url($cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" width="50" class="me-3">
                                    <div>
                                        <h6 class="mb-0">{{ $cartItem->product->name }}</h6>
                                        <p class="mb-0 text-muted">From RM {{ number_format($cartItem->product->price, 2) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>RM {{ number_format($cartItem->product->price, 2) }}</td>
                            <td>RM {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td>
                                <div class="d-flex gap-1 justify-content-start">
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mb-2">Remove</button>
                                    </form>
                                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-{{ $cartItem->id }}">
                                        Edit
                                    </button>
                                </div>

                                <!-- Reusable Modal -->
                                <div class="modal fade" id="modal-{{ $cartItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $cartItem->product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('cart.edit', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="quantity-{{ $cartItem->id }}" class="form-label">New quantity number:</label>
                                                        <input type="number" id="quantity-{{ $cartItem->id }}" name="quantity" class="form-control" placeholder="Quantity" value="{{ $cartItem->quantity }}" min="1" max="10" />
                                                    </div>
                                                    <input type="hidden" name="cartItem_id" value="{{ $cartItem->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cart Total Section -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <h4>Total Amount: 
                <span class="text-danger">RM {{ number_format($userCart->sum(function($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                }), 2) }}</span>
            </h4>
        </div>

        <!-- Checkout Button -->
        <div class="text-end">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $userCart->sum(function($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                }) }}">
                <button type="submit" class="btn btn-primary mt-3">Checkout</button>
            </form>
        </div>
    @endif
</div>

@else

<!-- Lead to 404 page -->
<?php
  abort(404);
?>
@endif
@endsection
