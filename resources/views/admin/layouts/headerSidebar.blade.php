<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')|| BestNews</title>
    {{-- Bootstrap CDN css link  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fontawesome CDN css link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    {{-- Header Sidebar Custom css file  --}}
    <link rel="stylesheet" href="{{asset('assets/admin/css/headerSidebar.css')}}">
    @stack('css')
  </head>
  <body>
    {{-- Header section start --}}
    <div class="sticky-top">
        <div class="header-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <div class="header-logo">
                            <a href="{{route('dashboard')}}">
                                <img src="{{asset('assets/admin/img/logo.svg')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="header-content">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" placeholder="Search Tools (/)" aria-label="search" aria-describedby="button-addon2">
                                <button class="btn btn-outline-danger" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass fa-sm"></i></button>
                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-bell"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">No Notification </a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-circle-user"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View Account</a></li>
                                    <li><a class="dropdown-item" href="#">Give Feedback</a></li>
                                    <li><a class="dropdown-item" href="#">Help Center</a></li>
                                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header section end --}}
    {{-- Content section start --}}
    <section class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 px-0">
                    <div class="content-sidebar">
                        <div class="sideber-title">
                            <h5>NAVIGATION PANEL</h5>
                        </div>
                        <nav class="sidebar-nav">
                            <ul>
                                <li>
                                    <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">News List</a>
                                </li>
                                <li>
                                    <a href="{{route('news.create')}}" class="nav-link">Create News</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Users Manager</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Settings</a>
                                </li>
                            </ul>
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
    {{-- Content section end  --}}


    {{-- Jquery CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap CDN js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Fontawesome CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    @stack('script')
  </body>
</html>