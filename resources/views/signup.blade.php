@extends('layouts.app')

@section('title', 'Signup')

@section('content')

<!--signup page-->
<div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
    <div class="card-body">
        <h5 class="card-title text-center mb-3 py-3 border-bottom">
            Sign Up a New Account
        </h5>
        <!-- error box -->
        @if ( $errors->any() )
            <div class="alert alert-danger">
                @foreach ( $errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <!-- sign up form-->
        <form action="/signup" method="POST">
        <!-- sign up form-->
        <form action="/signup" method="POST">
            <!--Cross-Site Request Forgery or CSRF Token-->
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
            />
            </div>
            <div class="mb-3">
            <label for="confirm_password" class="form-label"
                >Confirm Password</label
            >
            <input
                type="password"
                class="form-control"
                id="confirm_password"
                name="password_confirmation"
            />
            </div>
            <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-fu">
                Sign Up
            </button>
            </div>
        </form>
        <!--Login-->
     <div class="text-center mt-3">
      <a href="/login" class="text-decoration-none"
        ><i class="bi bi-arrow-left-circle"></i>Have an Account</a
      >
     </div>
    </div>
</div>

@endsection  