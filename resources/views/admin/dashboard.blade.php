
@extends('admin.layouts.headerSidebar')

@section('title')
    Dashboard
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/dashboard.css')}}">
@endpush

@section('content')
    <div class="dashboard-section">
        <div class="row">
            <div class="col-12">
                <div class="dashboard-content">
                    <h2>Dashboard</h2>
                    <div class="row">
                        <div class="col-3">
                          <div class="card radius-15 bg-voilet">
                            <div class="card-body">
                              <div class="d-flex align-items-center">
                                <div>
                                  <h2 class="mb-0 text-white">1<i class="fa-solid fa-arrow-up"></i></h2>
                                </div>
                                <div class="ms-auto font-35 text-white"><i class="bx bx-cart-alt"></i>
                                </div>
                              </div>
                              <div class="d-flex align-items-center">
                                <div>
                                  <p class="mb-0 text-white">News Show</p>
                                </div>
                                <div class="ms-auto font-14 text-white">+23.4%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="card radius-15 bg-primary-blue">
                            <div class="card-body">
                              <div class="d-flex align-items-center">
                                <div>
                                  <h2 class="mb-0 text-white">265 <i class='bx bxs-down-arrow-alt font-14 text-white'></i> </h2>
                                </div>
                                <div class="ms-auto font-35 text-white">
                                  <i class="fa-solid fa-newspaper"></i>
                                </div>
                              </div>
                              <div class="d-flex align-items-center">
                                <div>
                                  <p class="mb-0 text-white">News Request</p>
                                </div>
                                <div class="ms-auto font-14 text-white">+14.7%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="card radius-15 bg-rose">
                            <div class="card-body">
                              <div class="d-flex align-items-center">
                                <div>
                                  <h2 class="mb-0 text-white">11<i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
                                </div>
                                <div class="ms-auto font-35 text-white">
                                  <i class="fa-solid fa-ban"></i>
                                </div>
                              </div>
                              <div class="d-flex align-items-center">
                                <div>
                                  <p class="mb-0 text-white">Cancelled News</p>
                                </div>
                                <div class="ms-auto font-14 text-white">-12.9%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="card radius-15 bg-sunset">
                            <div class="card-body">
                              <div class="d-flex align-items-center">
                                <div>
                                  <h2 class="mb-0 text-white"><i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
                                </div>
                                <div class="ms-auto font-35 text-white"><i class="bx bx-user"></i>
                                </div>
                              </div>
                              <div class="d-flex align-items-center">
                                <div>
                                  <p class="mb-0 text-white">New Users</p>
                                </div>
                                <div class="ms-auto font-14 text-white">+13.6%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection