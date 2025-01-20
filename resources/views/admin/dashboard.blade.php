
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
                    <div class="row">
                      <div class="col-3">
                        <div class="card radius-15 bg-voilet">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <div>
                                <h2 class="mb-0 text-white">1 <i class="fa-solid fa-arrow-up font-14 text-white"></i></h2>
                              </div>
                              <div class="ms-auto font-35 text-white">
                                <i class="fa-solid fa-cart-shopping"></i>
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
                                <h2 class="mb-0 text-white">265 <i class="fa-solid fa-arrow-down font-14 text-white"></i></h2>
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
                                <h2 class="mb-0 text-white">11 <i class="fa-solid fa-arrow-up font-14 text-white"></i></h2>
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
                                <h2 class="mb-0 text-white">22 <i class="fa-solid fa-arrow-up font-14 text-white"></i></h2>
                              </div>
                              <div class="ms-auto font-35 text-white"><i class="fa-regular fa-user"></i>
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
                    <div class="row mt-4">
                      <div class="col-12 d-flex">
                        <div class="card radius-15 w-100">
                          <div class="card-body">
                            <div class="d-lg-flex align-items-center">
                              <div>
                                <h5 class="mb-4">Top News Categories</h5>
                              </div>
                              <div class="dropdown ms-auto">
                                <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                </div>
                                <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="javascript:;">Action</a>
                                  <a class="dropdown-item" href="javascript:;">Another action</a>
                                  <div class="dropdown-divider"></div>  <a class="dropdown-item" href="javascript:;">Something else here</a>
                                </div>
                              </div>
                            </div>
                            <div class="progress-wrapper mb-4">
                              <p class="mb-1">Politics <span class="float-end">70%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar" role="progressbar" style="width: 70%"></div>
                              </div>
                            </div>
                            <div class="progress-wrapper mb-4">
                              <p class="mb-1">Business <span class="float-end">55%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar bg-voilet" role="progressbar" style="width: 55%"></div>
                              </div>
                            </div>
                            <div class="progress-wrapper mb-4">
                              <p class="mb-1">Sports <span class="float-end">64%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar bg-red-light" role="progressbar" style="width: 64%"></div>
                              </div>
                            </div>
                            <div class="progress-wrapper mb-4">
                              <p class="mb-1">Education <span class="float-end">58%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar bg-sunset" role="progressbar" style="width: 58%"></div>
                              </div>
                            </div>
                            <div class="progress-wrapper mb-4">
                              <p class="mb-1">Bangladesh <span class="float-end">82%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar bg-wall" role="progressbar" style="width: 82%"></div>
                              </div>
                            </div>
                            <div class="progress-wrapper">
                              <p class="mb-1">International <span class="float-end">40%</span>
                              </p>
                              <div class="progress radius-15" style="height:5px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 40%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-6 d-flex">
                        <div class="card radius-15 w-100 overflow-hidden">
                          <div class="card-header border-bottom-0">
                            <div class="d-flex align-items-center">
                              <div>
                                <h5 class="mb-0">News Engagement By Locations</h5>
                              </div>
                              <div class="dropdown ms-auto">
                                <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                </div>
                                <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="javascript:;">Select Countries</a>
                                  <a class="dropdown-item" href="javascript:;">Action Country</a>
                                  <div class="dropdown-divider"></div>  <a class="dropdown-item" href="javascript:;">Help</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="table-responsive ms-4">
                            <table class="table mb-0">
                              <thead>
                                <tr>
                                  <th scope="col" class="text-blue-ribbon">Countries</th>
                                  <th scope="col" class="text-brink-pink">Currents</th>
                                  <th scope="col" class="text-mountain-meadow">Total Engaged</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-bd me-2"></i>
                                    <div>Bangladesh</div>
                                  </td>
                                  <td>93,495</td>
                                  <td class="text-semibold">7,89,58,430</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-in me-2"></i>
                                    <div>India</div>
                                  </td>
                                  <td>63,495</td>
                                  <td class="text-semibold">1,89,58,430</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-um me-2"></i>
                                    <div>United States</div>
                                  </td>
                                  <td>13,495</td>
                                  <td class="text-semibold">58,43,075</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-nl me-2"></i>
                                    <div>Netherlands</div>
                                  </td>
                                  <td>11,495</td>
                                  <td class="text-semibold">68,25,390</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-us me-2"></i>
                                    <div>United Kingdom</div>
                                  </td>
                                  <td>09,348</td>
                                  <td class="text-semibold">87,29,570</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-ca me-2"></i>
                                    <div>Canada</div>
                                  </td>
                                  <td>07,845</td>
                                  <td class="text-semibold">64,91,420</td>
                                </tr>
                                <tr>
                                  <td class="d-flex align-items-center"><i class="flag-icon flag-icon-au me-2"></i>
                                    <div>Australia</div>
                                  </td>
                                  <td>05,945</td>
                                  <td class="text-semibold">94,33,560</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 d-flex">
                        <div class="card radius-15 w-100">
                          <div class="card-body">
                            <div class="card radius-15 border shadow-none">
                              <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                  <h5 class="mb-0">Request New Users</h5>
                                  <p class="mb-0 ms-auto">
                                    <div class="dropdown ms-auto">
                                      <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="javascript:;">Users</a>
                                        <a class="dropdown-item" href="javascript:;">Select Users</a>
                                        <div class="dropdown-divider"></div>  <a class="dropdown-item" href="javascript:;">Help</a>
                                      </div>
                                    </div>
                                  </p>
                                </div>
                                <table class="table table-striped">
                                  <thead class="table-dark">
                                    <tr>
                                      <th scope="col">Image</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col"style="white-space: nowrap;">Action</th>
                                    </tr>
                                  </thead>
                                    <tbody>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                      <tr>
                                        <td>image</td>
                                        <td>Sagar Mondal</td>
                                        <td>sagar@gmailcom</td>
                                        <td>Delete / Post</td>
                                      </tr>
                                    </tbody>
                                </table>
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