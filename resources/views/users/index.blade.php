@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="container py-5">
    <h2 class="text-center">Users Management</h2>

    <div class="card rounded shadow-lg mx-auto my-4 w-50">
    <div class="card-body">
        <h5 class="card-title text-center">Manage Users</h5>
       
        <table class="table">
        <thead>
            <tr class="text-center">
                <th>Name</th>
                <th>Gmail</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr class="text-center">
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role_id}}</td>
                    <td>
                            <!-- Modal Trigger Buttons -->
                                <div class="d-flex justify-content-center gap-1">
                                    @if(auth() && (auth()->user()->role_id == 1 || auth()->user()->role_id === 2))

                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $user->id }}">
                                            Edit
                                        </button>

                                        @if(auth() && auth()->user()->role_id != $user->role_id)
                                        <form action="/users/{{$user->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove User</button>
                                        </form>
                                        @endif

                                        <div class="modal fade" id="editmodal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Form</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <form action="/users/{{$user->id}}" class="text-start" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <!-- input  -->
                                                         <input type="hidden" name="user_id" value={{$user->id}} />
                                                         <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                             <input type="text" name="name" class="form-control" value={{ $user->name }}>
                                                         </div>
                                                         <div class="mb-3">
                                                            <label class="form-label">Email</label>

                                                             <input class="form-control" type="text" name="email" value={{ $user->email}}>
                                                         </div>
                                                 
                                                         
                                                         <select name="role_id" class="form-control">
                                                            <option value="1" {{$user->role_id == 1 ? 'selected' : null}}>Admin</option>
                                                            <option value="2" {{$user->role_id == 2 ? 'selected' : null}}>Editor</option>
                                                            <option value="3" {{$user->role_id == 3 ? 'selected' : null}}>User</option>
                                                        </select>
                                                        
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        


                                    @else
                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
  </div>
</div>

@endsection