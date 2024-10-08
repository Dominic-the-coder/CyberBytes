@extends('layouts.app')

@section('title', 'Cart')

@section('content')

@if($user)
<!-- Cart page -->
<div class="container card rounded shadow-lg mt-5 mb-5">
    <h2 class="fw-bold mt-3">Your Shopping Cart</h2>

    @if($userCart->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            Your cart is currently empty.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered mt-4">
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
                                        <h6>{{ $cartItem->product->name }}</h6>
                                        <p class="mb-0">From RM {{ number_format($cartItem->product->price, 2) }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Price -->
                            <td>
                                {{ $cartItem->quantity }}
                            </td>
                            <td>RM {{ number_format($cartItem->product->price, 2) }}</td>
                            <td>RM {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td>

                            <!-- Button to trigger the modal -->
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-2">Remove</button>
                                
                                    <button type="button" class="btn btn-success mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#modal-{{ $cartItem->id }}">
                                      Edit
                                    </button>
                                </form>

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
                                        <div class="modal-body d-flex flex-column">
                                            <div>
                                                <label class="mt-3">New quantity number:</label>
                                                <input type="number" name="quantity" class="px-3 py-2" placeholder="Quantity" value="{{ $cartItem->quantity }}" min="1" max="10"/>
                                            </div>
                                            <!-- Hidden fields to pass the product_id -->
                                            <input type="hidden" name="cartItem_id" value="{{ $cartItem->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </form>
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
                RM {{ number_format($userCart->sum(function($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                }), 2) }}
            </h4>
        </div>
    @endif
</div>
@else
<?php
abort(404)
?>
@endif
@endsection
