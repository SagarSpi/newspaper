@extends('backend.layouts.headerSidebar')

@section('title')
    Users List
@endsection

@section('content')
    <div class="user-list-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar">
                    <form action="" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="search" placeholder="Name">
                            <input class="form-control" name="search" placeholder="Email">
                            <input class="form-control" name="search" placeholder="Phone">
                            <input class="form-control" name="search" placeholder="Role">
                            <button type="submit" class="btn btn-outline-success" id="search-btn">Search</button>
                            <button type="button" class="btn btn-outline-danger" id="reset-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="heading">
                    <h5>Manage Users</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="{{route('user.create')}}" class="btn btn-success btn-sm">Add New User</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contacts</th>
                            <th scope="col">Rols</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td><img src="{{$user->image_url}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->contacts}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#"><i class="fa-solid fa-eye pe-2"></i> View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('user.edit',$user->id)}}"><i class="fa-solid fa-pen-to-square pe-2"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"><i class="fa-solid fa-trash pe-2"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    <div class="col-12">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection