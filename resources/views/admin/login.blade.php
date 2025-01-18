<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login || BestNews</title>
    {{-- Bootstrap cdn css link  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font awesome cdn css link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/login.css')}}">
  </head>
  <body>
    
    <section class="login-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="login-inner">
                        <div class="heading">
                            <h1>Login Here</h1>
                            <p>Welcome to Best News !</p>
                        </div>
                        <div class="inner-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Type Email">
                                  </div>
                                  <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Type Password">
                                  </div>
                                  <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember</label>
                                    <a href="#" class="reset-pass">Reset Password</a>
                                  </div>
                                  <button type="submit"  class="btn btn-primary form-control">Log In</button>
                                  <p class="sign-text">Don't have an account ? <a href="/register">Sign Up</a></p>
                                  <p class="or-section">Or</p>
                                  <button type="button" href="#" class="btn btn-outline-primary form-control mb-3">
                                    <span><i class="fa-brands fa-google"></i></span>
                                    <span>Continue with Google</span>
                                  </button>
                                  <button type="button" href="#" class="btn btn-outline-primary form-control mb-3">
                                    <span><i class="fa-brands fa-facebook"></i></span>
                                    <span>Continue with Facebook</span>
                                  </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Jquery cdn js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap cdn js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Font awesome cdn Js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
  </body>
</html>