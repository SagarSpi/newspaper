<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up || BestNews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/backend/css/register.css')}}">
  </head>
  <body>
    <section class="register-section">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <div class="register-about">
              <img src="{{asset('assets/global/img/logo.svg')}}" alt="" width="45%" height="100%">
              <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur dicta quam ullam at nihil aspernatur facere deleniti molestias nemo illum. Ipsa labore quas corporis error, amet neque odit eos? Aliquam eligendi sit, repellat molestiae tempore accusantium soluta tenetur in animi.</p>
            </div>
          </div>
          <div class="col-6">
            <div class="register-content">
              <div class="heading">
                <h3>Admin Registration</h3>
              </div>
              <div class="register-form-body">
                <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <div class="mb-2">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name')}}" {{$errors->has('name')?'autofocus': ''}} required>
                    @error('name')<span class="text-danger">{{$message}}</span>@enderror
                  </div>
                  <div class="mb-2">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}" {{$errors->has('email')?'autofocus': ''}} required>
                    @error('email')<span class="text-danger">{{$message}}</span>@enderror
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Upload Image</label>
                    <input  type="file" name="image" class="form-control" accept="image/*">
                    @error('image')<span class="text-danger">{{$message}}</span>@enderror
                  </div>
                  <div class="mb-2">
                    <label for="number" class="form-label">Phone Number</label>
                    <input type="text" name="number" class="form-control" id="number" placeholder="Enter Phone Number" value="{{old('number')}}">
                    @error('number')<span class="text-danger">{{$message}}</span>@enderror
                  </div>
                  <div class="mb-2">
                    <label class="form-label">User Role</label>
                    <select name="role" class="form-select" {{$errors->has('role')?'autofocus':''}} required>
                        <option value="" >Select Role</option>
                        <option value="admin" {{old('role')=='Admin'?'selected':''}}>Admin</option>
                        <option value="manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                        <option value="reporter" {{ old('role') == 'Reporter' ? 'selected' : '' }}>Reporter</option>
                        <option value="visitor" {{ old('role') == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                        <option value="guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>Guest</option>
                        <option value="client" {{ old('role') == 'Client' ? 'selected' : '' }}>Client</option>
                    </select>
                    @error('role') <span class="text-danger">{{$message}}</span> @enderror
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
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">I agree to the <a href="#"> <b> Terms & Conditions</b></a></label>
                  </div>
                  <button type="submit" class="btn btn-primary form-control mb-2">Submit</button>
                  <a href="{{route('send-otp')}}" class="btn btn-outline-primary">Send OTP</a>
                  <p class="sign-text">Have any Question ? <a href="#">Get help</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Jquery CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap CDN js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Fontawesome CDN js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
  </body>
</html>