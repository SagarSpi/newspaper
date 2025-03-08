<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In || BestNews</title>
    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/login.css')}}">
  </head>
  <body>
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="login-about">
                        <img src="{{asset('assets/global/img/logo.svg')}}" alt="" width="45%" height="100%">
                        <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur dicta quam ullam at nihil aspernatur facere deleniti molestias nemo illum. Ipsa labore quas corporis error, amet neque odit eos? Aliquam eligendi sit, repellat molestiae tempore accusantium soluta tenetur in animi.</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="login-content">
                        <div class="heading">
                            <h3>Login Here</h3>
                            <p>Welcome Back !</p>
                        </div>
                        <div class="login-form-body">
                            <form action="{{route('login.post')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" 
                                    @if (Cookie::has('adminuser')) value="{{Cookie::get('adminuser')}}" @endif 
                                    id="email" aria-describedby="emailHelp" placeholder="Type Email" {{$errors->has('email')?'autofocus': ''}} required >
                                    @error('email')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" @if (Cookie::has('adminpassword')) value="{{Cookie::get('adminpassword')}}" @endif  class="form-control" id="password" placeholder="Type Password" required>
                                    @error('password')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="rememberMe" 
                                    @if (Cookie::has('adminuser')) checked @endif
                                    class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember</label>
                                    <a href="{{route('password.forget')}}" class="reset-pass">Forget Password</a>
                                </div>
                                <button type="submit"  class="btn btn-primary form-control">Log In</button>
                                <p class="sign-text">Don't have an account ? <a href="/register">Sign Up</a></p>
                                <p class="or-section">Or</p>
                                <a href="{{route('auth.redirection','google')}}" class="btn btn-outline-primary form-control mb-3">
                                    <span><i class="fa-brands fa-google"></i></span>
                                    <span>Continue with Google</span>
                                </a>
                                <a href="{{route('auth.redirection','facebook')}}" class="btn btn-outline-primary form-control mb-3">
                                    <span><i class="fa-brands fa-facebook"></i></span>
                                    <span>Continue with Facebook</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Jquery CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap js link  --}}
    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
    {{-- Fontawesome js link  --}}
    <script src="{{asset('assets/global/js/all.min.js')}}"></script>
  </body>
</html>