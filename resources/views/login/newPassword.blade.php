<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New PassWord</title>
    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/newPassword.css')}}">
</head>
<body>
    <section class="new-pass-section">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card new-pass-form">
                        <div class="text-center my-4">
                            <h4>Reset Your Password</h4>
                            <p>Enter your Email and New Password</p>
                        </div>
                        <form action="{{route('password.reset-post')}}" method="POST">
                            @csrf
                            <input type="text" name="token" hidden value="{{$token}}">
                            <div class="mb-2">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}" {{$errors->has('email')?'autofocus': ''}} required>
                                @error('email')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                                @error('password')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <label for="c_password" class="form-label">Conform Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="c_password" placeholder="Conform Password" required>
                            </div>
                            <div class="my-4">
                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/global/js/all.min.js')}}"></script>
</body>
</html>