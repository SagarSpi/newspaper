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
                        @can('update',$user)
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-light">Edit Profile</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="row">
                <div class="col-4">
                    <table class="table table-hover">
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
                                    <h2>{{$userWitharticleCount->articles_count}} <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Articles Show</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-newspaper font-35"></i>
                                    <p class="font-14 mt-3">+{{$percentageArticleShow}}%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>{{$pendingNewsCount}} <i class="fa-solid fa-arrow-down font-14"></i></h2>
                                    <p>Request Articles</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-download font-35"></i>
                                    <p class="font-14 mt-3">+{{$percentageArticleRequest}}%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>{{$rejectedNewsCount}} <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Cancelled Articles</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-ban font-35"></i>
                                    <p class="font-14 mt-3">-{{$percentageRejectedArticle}}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>{{$rating}} <i class="fa-solid fa-arrow-down font-14"></i></h2>
                                    <p>Rating</p>
                                </div>
                                <div>
                                    <i class="fa-regular fa-star font-35"></i>
                                    <p class="font-14 mt-3">+{{$percentageRating}}%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>{{$totalUserComments}} <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Total Commnets</p>
                                </div>
                                <div>
                                    <i class="fa-regular fa-comments font-35"></i>
                                    <p class="font-14 mt-3">+{{$percentageComments}}%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-box">
                                <div>
                                    <h2>{{$totalUserVisits}} <i class="fa-solid fa-arrow-up font-14"></i></h2>
                                    <p>Total Visits Articles</p>
                                </div>
                                <div>
                                    <i class="fa-regular fa-eye font-35"></i>
                                    <p class="font-14 mt-3">+{{$percentageVisits}}%</p>
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
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col" class="text-center">Visits</th>
                            <th scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <th scope="row" class="text-center">{{$article->id}}</th>
                                    <td>{{$article->category}}</td>
                                    <td>{{$article->title}}</td>
                                    <td class="text-center"><img src="{{$article->image_url}}" alt="News Image" height="40" width="40"></td>
                                    <td class="text-center">{{$article->visits}}</td>
                                    <td class="text-center text-nowrap">
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

