@extends('layouts.headerSidebar')

@section('title')
    Users List
@endsection

@section('content')
    <div class="user-list-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mt-3">
                    <form action="{{route('user.search')}}" method="GET">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <input type="text" class="form-control" name="contact" placeholder="Phone">
                            <input type="text" class="form-control" name="role" placeholder="Role">
                            <select class="form-select" name="date_filter">
                                <option selected disabled>Filter By Date</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month">This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="this_year">This Year</option>
                                <option value="last_year">Last Year</option>
                            </select>
                            <button type="submit" class="btn btn-outline-success" id="search-btn">Search</button>
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
                    <a href="{{route('user.list')}}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-arrows-rotate"></i></a>
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
                                <th scope="row">{{$user->id ??''}}</th>
                                <td><img src="{{$user->image_url ??''}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                                <td>{{$user->name ??'N/A'}}</td>
                                <td>{{$user->email ??'N/A'}}</td>
                                <td>{{$user->contacts ??'N/A'}}</td>
                                <td>{{$user->role ??'N/A'}}</td>
                                <td>{{$user->status ??'N/A'}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{route('user.show',$user->id)}}"><i class="fa-solid fa-eye pe-2"></i> View</a>
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