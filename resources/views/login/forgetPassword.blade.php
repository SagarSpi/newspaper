<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/forgetPassword.css')}}">
</head>
<body>
    <section class="forget-password-section">
        <div class="container">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="card">
                        <div class="text-center pt-4 px-3">
                            <h5>Reset Password</h5>
                            <p>We will send a link to your email, use that link to reset password.</p>
                        </div>
                        <div class="forger-form">
                            <form action="{{route('password.forget-post')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}" id="email" aria-describedby="emailHelp" placeholder="Type Email" {{$errors->has('email')?'autofocus': ''}} required >
                                    @error('email')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <div class="text-center">
                                    <small>
                                        Didn't received Email Link ?
                                    </small>
                                    <div class="mt-1 mb-4">
                                        <a href="{{route('password.resendEmail')}}" class="text-decoration-none">Resend Email</a>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary form-control">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
</body>
</html>