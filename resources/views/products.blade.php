@extends('layouts.app')

@section('title', 'Products')

@section('content')

<!-- Button to trigger the Add Product modal -->
@if($user)
@if($user->role_id == 1)
<div class="container d-flex justify-content-end">
  <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
    Add Product
  </button>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductLabel">Add New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Add Product Form -->
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Laravel CSRF token for security -->
    
    <div class="modal-body d-flex flex-column">
        <!-- Product Name -->
        <label class="mt-3">Product Name:</label>
        <input type="text" name="name" class="px-3 py-2" placeholder="Enter product name" required>
        
        <!-- Product Image -->
        <label class="mt-3">Product Image:</label>
        <input type="file" name="image" class="px-3 py-2" required>
        
        <!-- Product Price -->
        <label class="mt-3">Product Price:</label>
        <input type="number" name="price" class="px-3 py-2" placeholder="Enter product price" min="1" required>
        
        <!-- Product Type -->
        <label class="mt-3">Product Type:</label>
        <select name="type" required>
            <option selected disabled>Select a type</option>
            <option value="popular">Popular</option>
            <option value="latest">Latest</option>
            <option value="sale">Sale</option>
        </select>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </div>
</form>

        </div>
    </div>
</div>

@endif

<!-- Modal for Adding Product -->

<div class="container mt-1">
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
                            @if($user->role_id == 1)
                                <div class="d-flex justify-content-center gap-1 align-items-center w-100 ">
                                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-3">Remove</button>
                                </form>
                                <button type="button" class="btn btn-success mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Laravel CSRF token for security -->
    @method('PUT')
    <div class="modal-body d-flex flex-column">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
        <!-- Product Name -->
        <label class="mt-3">Product Name:</label>
        <input type="text" name="name" class="px-3 py-2" placeholder="Enter product name" required value="{{$product->name}}">
        
        <!-- Product Image -->
        <label class="mt-3">Product Image:</label>
        <input type="file" name="image" class="px-3 py-2">
        
        <!-- Product Price -->
        <label class="mt-3">Product Price:</label>
        <input type="number" name="price" class="px-3 py-2" placeholder="Enter product price" min="1" required value="{{$product->price}}">
        
        <!-- Product Type -->
        <label class="mt-3">Product Type:</label>
        <select name="type" required>
    <option value="" disabled>Select a type</option>
    <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
    <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
    <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
</select>

    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </div>
</form>
                                        </div>
                                    </div>
                                </div>
                                @else

                               <!-- Button to trigger the modal -->

                               <!--User-->
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
                                            <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf <!-- Laravel CSRF token for security -->

                                                <div class="modal-body">
                                                    <p>Do you want to add this item to your cart?</p>
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" name="quantity" class="px-3 py-2" min="1" value="1" max="10">

                                                    <!-- Hidden field to pass the product ID -->
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                         </div>
                     </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</div>

<div class="container mt-5">
    <hr>
</div>

<!-- Latest Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Checkout The Latest Realese</h2>
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
                            @if($user->role_id == 1)
                                <div class="d-flex justify-content-center gap-1 align-items-center w-100 ">
                                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-3">Remove</button>
                                </form>
                                <button type="button" class="btn btn-success mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Laravel CSRF token for security -->
    @method('PUT')
    <div class="modal-body d-flex flex-column">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
        <!-- Product Name -->
        <label class="mt-3">Product Name:</label>
        <input type="text" name="name" class="px-3 py-2" placeholder="Enter product name" required value="{{$product->name}}">
        
        <!-- Product Image -->
        <label class="mt-3">Product Image:</label>
        <input type="file" name="image" class="px-3 py-2">
        
        <!-- Product Price -->
        <label class="mt-3">Product Price:</label>
        <input type="number" name="price" class="px-3 py-2" placeholder="Enter product price" min="1" required value="{{$product->price}}">
        
        <!-- Product Type -->
        <label class="mt-3">Product Type:</label>
        <select name="type" required>
    <option value="" disabled>Select a type</option>
    <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
    <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
    <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
</select>

    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </div>
</form>
                                        </div>
                                    </div>
                                </div>
                                @else

                               <!-- Button to trigger the modal -->

                               <!--User-->
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
                                            <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf <!-- Laravel CSRF token for security -->

                                                <div class="modal-body">
                                                    <p>Do you want to add this item to your cart?</p>
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" name="quantity" class="px-3 py-2" min="1" value="1" max="10">

                                                    <!-- Hidden field to pass the product ID -->
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                         </div>
                     </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</div>


<div class="container mt-5">
    <hr>
</div>

<!-- Sales Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Checkout The Sales</h2>
</div>
<div class="container text-center">
    <div class="row mt-5 mb-5">
        @foreach($saleProducts as $product)
            <div class="col-12 col-md-6 col-lg-4 pt-2">
                <div class="card rounded shadow-lg">
                    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top"/>
                     <div class="card-box">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>From RM {{ number_format($product->price, 2) }}</p>

                        <!-- Modal Trigger Button -->
                            @if($user->role_id == 1)
                                <div class="d-flex justify-content-center gap-1 align-items-center w-100 ">
                                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-3">Remove</button>
                                </form>
                                <button type="button" class="btn btn-success mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Laravel CSRF token for security -->
    @method('PUT')
    <div class="modal-body d-flex flex-column">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
        <!-- Product Name -->
        <label class="mt-3">Product Name:</label>
        <input type="text" name="name" class="px-3 py-2" placeholder="Enter product name" required value="{{$product->name}}">
        
        <!-- Product Image -->
        <label class="mt-3">Product Image:</label>
        <input type="file" name="image" class="px-3 py-2">
        
        <!-- Product Price -->
        <label class="mt-3">Product Price:</label>
        <input type="number" name="price" class="px-3 py-2" placeholder="Enter product price" min="1" required value="{{$product->price}}">
        
        <!-- Product Type -->
        <label class="mt-3">Product Type:</label>
        <select name="type" required>
    <option value="" disabled>Select a type</option>
    <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
    <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
    <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
</select>

    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </div>
</form>
                                        </div>
                                    </div>
                                </div>
                                @else

                               <!-- Button to trigger the modal -->

                               <!--User-->
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
                                            <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf <!-- Laravel CSRF token for security -->

                                                <div class="modal-body">
                                                    <p>Do you want to add this item to your cart?</p>
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" name="quantity" class="px-3 py-2" min="1" value="1" max="10">

                                                    <!-- Hidden field to pass the product ID -->
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                         </div>
                     </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</div>

@else
@php
        abort(404);
    @endphp
@endif

@endsection
