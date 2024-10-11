@extends('layouts.app')

@section('title', 'Delete')

@section('content')
<div class="container">
    <h3>Delete User</h3>
    <p>Are you sure you want to delete the user <strong>{{ $user->name }}</strong>?</p>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
