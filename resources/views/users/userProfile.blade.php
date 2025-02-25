@extends('layouts.headerSidebar')

@section('title')
    Users Profile
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/userProfile.css')}}">
@endpush

@section('content')
    <div class="profile-section">
        <div class="profile-heading">
            <div class="row">
                <div class="col-8">
                    <div class="profile-user-box">
                        <div class="user-img">
                            <img src="{{$user->image_url ?? ''}}" class="img-thumbnail" alt="User Image">
                        </div>
                        <div class="user-details">
                            <h3>{{$user->name ??'N/A'}}</h3>
                            <h4>{{$user->email ??'N/A'}}</h4>
                            <h5>{{$user->role ??'N/A'}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <a href="{{route('user.edit',$user->id)}}" class="btn btn-light">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="row">
                <div class="col-4">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th rowspan="1">Id</th>
                                <td><b>: </b>{{$user->id ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Join us</th>
                                <td><b>: </b>{{$user->created_at ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Full Name</th>
                                <td><b>: </b>{{$user->name ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Email</th>
                                <td><b>: </b>{{$user->email ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Contact</th>
                                <td><b>: </b>{{$user->contacts ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Role</th>
                                <td><b>: </b>{{$user->role ??'N/A'}}</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Status</th>
                                <td><b>: </b> {{$user->status ??'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>7857 <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>News Show</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-cart-shopping font-35"></i>
                                    <p class="font-14 mt-3">+45.4%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>457 <i class="fa-solid fa-arrow-down font-14"></i></h2>
                                    <p>News Request</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-newspaper font-35"></i>
                                    <p class="font-14 mt-3">+21.8%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>8 <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Cancelled News</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-ban font-35"></i>
                                    <p class="font-14 mt-3">-2.1%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>7857 <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>News Show</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-cart-shopping font-35"></i>
                                    <p class="font-14 mt-3">+45.4%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>457 <i class="fa-solid fa-arrow-down font-14"></i></h2>
                                    <p>News Request</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-newspaper font-35"></i>
                                    <p class="font-14 mt-3">+21.8%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>8 <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Cancelled News</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-ban font-35"></i>
                                    <p class="font-14 mt-3">-2.1%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5 class="mt-4">{{$user->name}}'s News </h5>
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Visits</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <th scope="row">{{$article->id}}</th>
                                    <td>{{$article->category}}</td>
                                    <td>{{$article->title}}</td>
                                    <td><img src="{{$article->image_url}}" alt="News Image" height="40" width="40"></td>
                                    <td>{{$article->visits}}</td>
                                    <td>
                                        <a href="{{route('article.show',$article->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{route('article.edit',$article->id)}}" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

