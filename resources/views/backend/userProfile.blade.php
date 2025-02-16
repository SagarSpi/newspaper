@extends('backend.layouts.headerSidebar')

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
                        <div class="user-img img-thumbnail">
                            <img src="{{asset('assets/backend/img/user-avater.png')}}" alt="User Image">
                        </div>
                        <div class="user-details">
                            <h3>Sagar Mondal</h3>
                            <h4>sagarspi583@gmail.com</h4>
                            <h5>Admin</h5>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <a href="#" class="btn btn-light">Edit Profile</a>
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
                                <td><b>:</b> 1</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Join us</th>
                                <td><b>:</b> 12/12/2004</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Full Name</th>
                                <td><b>:</b> Sagar Mondal</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Email</th>
                                <td><b>:</b> sagarspi583@gmail.com</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Contact</th>
                                <td><b>:</b> 01725540583</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Role</th>
                                <td><b>:</b> Admin</td>
                            </tr>
                            <tr>
                                <th rowspan="1">Status</th>
                                <td><b>:</b> Active</td>
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
                    <h5>News Created By</h5>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">News Id</th>
                            <th scope="col">News Category</th>
                            <th scope="col">News Title</th>
                            <th scope="col">News Image</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td class="align-middle">
                                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                           <td>
                                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection

