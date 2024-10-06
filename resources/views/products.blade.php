@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mt-5">
    <hr>
</div>

<!-- Popular Products Section -->
<div class="container">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Popular Right Now</h2>
</div>
<div class="container text-center">
    <div class="row mt-5 mb-5">
        @foreach($popularProducts as $product)
            <div class="col-12 col-md-6 col-lg-4 pt-2">
                <div class="card rounded shadow-lg">
                    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top"/>
                    <div class="card-box">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>From RM {{ number_format($product->price, 2) }}</p>

                        <!-- Modal Trigger Button -->
                        <button type="button" class="btn btn-primary mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                            Add to cart
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to add this item to your cart?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <hr>
</div>

<!-- Latest Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Latest Products</h2>
</div>
<div class="container text-center">
    <div class="row mt-5 mb-5">
        @foreach($latestProducts as $product)
            <div class="col-12 col-md-6 col-lg-4 pt-2">
                <div class="card rounded shadow-lg">
                    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top"/>
                    <div class="card-box">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>From RM {{ number_format($product->price, 2) }}</p>

                        <!-- Modal Trigger Button -->
                        <button type="button" class="btn btn-primary mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                            Add to cart
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to add this item to your cart?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <hr>
</div>
@endsection
