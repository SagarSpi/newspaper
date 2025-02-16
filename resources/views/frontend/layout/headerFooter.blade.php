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
    {{-- Header Footer Custom css file  --}}
    <link rel="stylesheet" href="{{asset('assets/frontend/css/home.css')}}">
    @stack('css')
  </head>
  <body>
    {{-- Header Section Code Start  --}}
    <div class="header-section">
      <div class="navber-section">
        <div class="container-fluid">
          <div class="row">
              <div class="col-4">
                <div class="nav-left">
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
              </div>
              <div class="col-4 offset-4">
                <div class="nav-right">
                  <ul>
                    <li>
                      <a href=""><i class="fa-brands fa-facebook fa-lg" style="color: #0866ff;"></i></a>
                    </li>
                    <li>
                      <a href=""><i class="fa-brands fa-whatsapp fa-lg" style="color: #0cc042;"></i></a>
                    </li>
                    <li>
                      <a href=""><i class="fa-brands fa-x-twitter fa-lg" style="color: #030303;"></i></a>
                    </li>
                    <li>
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
              <div class="header-logo">
                <img src="" alt="Logo">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="menubar-section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="menu-item">
                <ul>
                  <li>
                    <a href="" class="active"><i class="fa-solid fa-house fa-lg" style="color: #ff1438;"></i></a>
                  </li>
                  <li>
                    <a href="">Latest</a>
                  </li>
                  <li>
                    <a href="">Politics</a>
                  </li>
                  <li>
                    <a href="">Business</a>
                  </li>
                  <li>
                    <a href="">Lifestyle</a>
                  </li>
                  <li>
                    <a href="">Crime</a>
                  </li>
                  <li>
                    <a href="">Education</a>
                  </li>
                  <li>
                    <a href="">Sports</a>
                  </li>
                  <li>
                    <a href="">Entertainment</a>
                  </li>
                  <li>
                    <a href="">Bangladesh</a>
                  </li>
                  <li>
                    <a href="">International</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Header Section Code End --}}
    {{-- Content Section Code Etart --}}
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @yield('content')
        </div>
      </div>
    </div>
    {{-- Content Section Code End --}}

    {{-- Footer Section Code Start  --}}
    <div class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    
                </div>
            </div>
        </div>
    </div>
    {{-- Footer Section Code End  --}}

    {{-- Jquery CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap CDN js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Fontawesome CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    @stack('script')
  </body>
</html>