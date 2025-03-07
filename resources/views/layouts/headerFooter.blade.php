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
    {{-- HEADER FOOTER CUSTOM CSS FILE  --}}
    <link rel="stylesheet" href="{{asset('assets/frontend/css/headerFooter.css')}}">
    @stack('css')
  </head>
  <body>
    {{-- HEADER SECTION CODE END  --}}
    <div class="navber-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <ul>
                <li>
                  <a href="">E-paper</a>
                </li>
                <li>|</li>
                <li>
                  <a href="">Converter</a>
                </li>
                <li>|</li>
                <li>
                  <a href="">Archive</a>
                </li>
            </ul>
          </div>
          <div class="col-6">
            <div class="text-end">
              <ul>
                <li class="me-2">
                  <a href=""><i class="fa-brands fa-facebook fa-lg" style="color: #0866ff;"></i></a>
                </li>
                <li class="me-2">
                  <a href=""><i class="fa-brands fa-whatsapp fa-lg" style="color: #0cc042;"></i></a>
                </li>
                <li class="me-2">
                  <a href=""><i class="fa-brands fa-x-twitter fa-lg" style="color: #030303;"></i></a>
                </li>
                <li class="me-2">
                  <a href=""><i class="fa-brands fa-instagram fa-lg" style="color: #fdbd03;"></i></a>
                </li>
                <li>
                  <a href=""><i class="fa-brands fa-youtube fa-lg" style="color: #fb0000;"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="logo-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-logo text-center">
              <a href="">
                <img src="{{asset('assets/global/img/logo.svg')}}" alt="Logo">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sticky-top">
      <div class="menubar-section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-10">
              <div class="menu-item text-end mb-2">
                <ul>
                  <li>
                    <a href="{{route('home')}}" class="active"><i class="fa-solid fa-house fa-lg" style="color: #ff1438;"></i></a>
                  </li>
                  <li>
                    <a href="{{route('news.latest')}}">Latest</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Politics']) }}">Politics</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Business']) }}">Business</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Lifestyle']) }}">Lifestyle</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Crime']) }}">Crime</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Education']) }}">Education</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Sports']) }}">Sports</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Entertainment']) }}">Entertainment</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'Bangladesh']) }}">Bangladesh</a>
                  </li>
                  <li>
                    <a href="{{ route('news.category', ['cat' => 'International']) }}">International</a>
                  </li>
                  <li>
                    <div class="dropdown">
                      <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Others</a>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="{{ route('news.category', ['cat' => 'Opinion']) }}" class="dropdown-item">Opinion</a>
                        </li>
                        <li>
                          <a href="{{ route('news.category', ['cat' => 'Corporate']) }}" class="dropdown-item">Corporate</a>
                        </li>
                        <li>
                          <a href="{{ route('news.category', ['cat' => 'Science_technology']) }}" class="dropdown-item">Science & Technology</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-2">
              <div class="menu-sidebar">
                <ul>
                  <li>
                    <div class="dropdown">
                      <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="dropdown-item width-size">
                          <form action="{{route('news.search')}}" method="GET">
                            <div class="input-group">
                              <input type="text" name="search" class="form-control" placeholder="Search News...">
                              <button type="submit" class="btn btn-outline-danger">Search</button>
                            </div>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li>|</li>
                  <li>
                    <div class="language-changer">
                      <div id="translator"></div>
                    </div>
                  </li>
                  <li>|</li>
                  <li>
                    <a href="{{route('login')}}" target="_blank"><i class="fa-solid fa-user"></i> Login</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- HEADER SECTION CODE END --}}
    {{-- CONTENT SECTION CODE START --}}
    <div class="content-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    {{-- CONTENT SECTION CODE END --}}
    {{-- FOOTER SECTION CODE START  --}}
    <div class="footer-section">
      <div class="container-fluid">
        <div class="footer-widget">
          <div class="row">
            <div class="col-3">
                <div class="img">
                  <img src="{{asset('assets/global/img/logo.svg')}}" alt="">
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis minima eaque tempora incidunt aut eius itaque ab ad commodi consequatur.</p>
                <div class="follow-us mt-3">
                  <h5>Follow Us</h5>
                  <ul>
                    <li class="me-2">
                      <a href=""><i class="fa-brands fa-facebook fa-lg" style="color: #0866ff;"></i></a>
                    </li class="me-2">
                    <li class="me-2">
                      <a href=""><i class="fa-brands fa-whatsapp fa-lg" style="color: #0cc042;"></i></a>
                    </li>
                    <li class="me-2">
                      <a href=""><i class="fa-brands fa-x-twitter fa-lg" style="color: #030303;"></i></a>
                    </li>
                    <li class="me-2">
                      <a href=""><i class="fa-brands fa-instagram fa-lg" style="color: #fdbd03;"></i></a>
                    </li>
                    <li class="me-2">
                      <a href=""><i class="fa-brands fa-youtube fa-lg" style="color: #fb0000;"></i></a>
                    </li>
                  </ul>
                </div>
            </div>
            <div class="col-3">
              <div class="footer-contact">
                <h5 class="mb-4">Quick Contacts</h5>
                <table class="table table-borderless table-sm">
                  <tbody>
                    <tr>
                      <th><i class="fa-solid fa-location-dot fa-lg"></i></th>
                      <td>23 Street, Dhaka, Bangladesh</td>
                    </tr>
                    <tr>
                      <th><i class="fa-solid fa-mobile-screen fa-lg"></i></th>
                      <td>+880 1725 540 583</td>
                    </tr>
                    <tr>
                      <th><i class="fa-solid fa-envelope fa-lg"></i></th>
                      <td>info@bestnews.com</td>
                    </tr>
                    <tr>
                      <th><i class="fa-solid fa-globe fa-lg"></i></th>
                      <td>www.bestnews.com</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-3">
              <h5 class="mb-4">Quick Links</h5>
              <ul>
                <li class="mb-1"><a href="#">Features</a></li>
                <li class="mb-1"><a href="#">Special Events</a></li>
                <li class="mb-1"><a href="#">Add Price Lisat</a></li>
                <li class="mb-1"><a href="#">Facebook live</a></li>
              </ul>
            </div>
            <div class="col-3">
              <h5>Newsletter</h5>
              <p class="mb-4">Subscribe to recieve a monthly email </br> on the latest news!</p>
              <form action="{{route('email.store')}}" method="POST">
                @csrf
                <div class="input-group">
                  <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email" required>
                  <button type="submit" class="btn btn-outline-danger">Subscribe</button>
                  @error('email')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="footer-buttom">
          <div class="row">
            <div class="col-6">
              <div class="copyright">
                <p>Copyright &copy; BestNews 2024. All Rights Reserved</p>
              </div>
            </div>
            <div class="col-6 text-end">
              <div class="privacy">
                <ul>
                  <li><a href="#">Privacy Policy</a></li>
                  <li>|</li>
                  <li><a href="#">Terms and Conditions</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- FOOTER SECTION CODE END  --}}

    {{-- JQUERY CDN JS LINK  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- LANGUAGE JS CODE FILE --}}
    <script src="{{asset('assets/frontend/js/languageChanger.js')}}"></script>
    {{-- BOOTSTRAP JS FILE  --}}
    {{-- <script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script> --}}
    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
    {{-- FONTAWESOME JS FILE  --}}
    <script src="{{asset('assets/global/js/all.min.js')}}"></script>
    {{-- LANGUAGE TRANSLATOR cdn LINK  --}}
    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
    
    @stack('script')
  </body>
</html>