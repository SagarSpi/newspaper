<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')|| BestNews</title>
    {{-- BOOTSTRAP CSS FILE  --}}
    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    {{-- FONTAWESOME CSS FILE  --}}
    <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/fontawesome.min.css')}}">
    {{-- HEADER SIDEBAR CUSTOM CSS FILE  --}}
    <link rel="stylesheet" href="{{asset('assets/backend/css/headerSidebar.css')}}">
    @stack('css')
  </head>
  <body>
    {{-- HEADER SECTION START --}}
    <div class="sticky-top">
        <div class="header-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <div class="header-logo">
                            <a href="{{route('dashboard')}}">
                              <img src="{{asset('assets/global/img/logo.svg')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-10">
                      <div class="header-content">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Tools (/)" aria-label="search" aria-describedby="button-addon2">
                            <button class="btn btn-outline-danger" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass fa-sm"></i></button>
                        </div>
                        <div class="dropdown mx-2">
                            <button class="btn py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-bell"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">No Notification </a></li>
                            </ul>
                        </div>
                        <div class="dropdown profile-dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{Auth::user()->image_url ??''}}" alt="User Image" class="navbar-profile-img"> Hi, {{Auth::user()->name ??'N/A'}}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item profile-dropdown-info" href="#">
                                        <img src="{{Auth::user()->image_url ??''}}" alt="" class="dropdown-profile-img">
                                        <div class="profile-name">
                                            <p>{{Auth::user()->name ??'N/A'}}</p>
                                            <p>{{Auth::user()->email ??'N/A'}}</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="#"><i class="fa-solid fa-download item-icon"></i> Downloads</a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="{{route('user.show',Auth::id())}}"><i class="fa-regular fa-circle-user item-icon"></i>View Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="#"><i class="fa-regular fa-address-card item-icon"></i> Profile Setting</a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="#"><i class="fa-solid fa-ticket item-icon"></i> Support Tickets</a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="#"><i class="fas fa-th item-icon"></i> Customization</a>
                                </li>
                                <li>
                                    <a class="dropdown-item profile-dropdown-list-item" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket item-icon"></i> Log Out</a>
                                </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- HEADER SECTION END --}}
    {{--  CONTENT SECTION START --}}
    <section class="content-section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-2 px-0">
              <div class="content-sidebar">
                <div class="sideber-title">
                    <h5>NAVIGATION PANEL</h5>
                </div>
                <nav class="sidebar-nav">
                  <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                      <li>
                        <a href="{{route('dashboard')}}">
                          <i class="fa-solid fa-home icon"></i>
                          <span class="text">Dashboard</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa-solid fa-newspaper icon"></i>
                          <span class="text">Article</span>
                          <i class="fa-solid fa-chevron-down arrow"></i>
                        </a>
                        <ul class="sub-menu">
                          <li>
                            <a href="{{route('article.list')}}">
                              <span class="text">Article List</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{route('article.request')}}">
                              <span class="text">Article Request</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{route('article.create')}}">
                              <span class="text">Create Article</span>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="{{route('comment.list')}}">
                          <i class="fa-regular fa-comments icon"></i>
                          <span class="text">Comments </span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('email.list')}}">
                          <i class="fa-regular fa-envelope-open icon"></i>
                          <span class="text">Newsletter Mail</span>
                        </a>
                      </li>
                      <p class="title">Users</p>
                      <li>
                        <a href="#">
                          <i class="fa-regular fa-user icon"></i>
                          <span class="text">User Management</span>
                          <i class="fa-solid fa-chevron-down arrow"></i>
                        </a>
                        <ul class="sub-menu">
                          <li>
                            <a href="{{route('user.list')}}">
                              <span class="text">Users list</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{route('user.rejected')}}">
                              <span class="text">Rejected Users</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{route('user.create')}}" target="_blank">
                              <span class="text">Add New Users</span>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <p class="title">Settings</p>
                      <li>
                        <a href="#">
                          <i class="fa-solid fa-gear icon"></i> 
                          <span class="text">Settings</span>
                          <i class="fa-solid fa-chevron-down arrow"></i>
                        </a>
                        <ul class="sub-menu">
                          <li>
                            <a href="#">
                              <span class="text">Social Links</span>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
            <div class="col-10">
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
          </div>
        </div>
    </section>
    {{-- CONTENT SECTION END  --}}


    {{-- JQUERY CDN JS LINK  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- BOOTSTRAP JS FILE  --}}
    <script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
    {{-- FONTAWESOME JS FILE  --}}
    <script src="{{asset('assets/global/js/all.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/headerSidebar.js')}}"></script>
    {{-- <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true
      };
      
      @if (Session::has('success'))
        toastr.success("{{session('success')}}",'Success !',{timeOut:6000});
      @elseif (Session::has('error'))
        toastr.error("{{session('error')}}",'Error !',{timeOut:6000});
      @elseif (Session::has('warning'))
        toastr.warning("{{session('warning')}}",'Warning !',{timeOut:6000});
      @endif
    </script> --}}

    @stack('script')
  </body>
</html>