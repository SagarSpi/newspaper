<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register || BestNews</title>
    {{-- Bootstrap cdn css link  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font awesome cdn css link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/register.css')}}">
  </head>
  <body>
    <div class="register-section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-6 offset-3">
              <div class="register-inner">
                <div class="heading">
                  <h3>User Registration</h3>
                  <p>Welcome to Best News !</p>
                </div>
                <div class="inner-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                          <label for="name" class="form-label">Full Name</label>
                          <input type="name" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                        <div class="mb-2">
                          <label for="email" class="form-label">Email address</label>
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="mb-2">
                          <label for="number" class="form-label">Phone Number</label>
                          <input type="text" name="number" class="form-control" id="number" placeholder="Phone">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Image</label>
                            <input  type="file" class="form-control" name="image" placeholder="Image Url" accept="image/*">
                        </div>
                        <div class="mb-2">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="mb-2">
                          <label for="c_password" class="form-label">Conform Password</label>
                          <input type="password" name="c_password" class="form-control" id="c-password" placeholder="Conform Password" required>
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Remember Password</label>
                        </div>
                        <button type="submit" name="registerBtn" class="btn btn-primary form-control mb-2">Submit</button>
                        <p class="sign-text">Have any Question ? <a href="#">Get help</a></p>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    {{-- Jquery cdn js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Bootstrap cdn js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Font awesome cdn Js link  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
  </body>
</html>