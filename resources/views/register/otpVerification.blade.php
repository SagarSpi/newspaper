<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/otpVerification.css')}}">
  </head>
  <body>
    <div class="otp-verifcation-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="card text-center p-4">
                        <div class="card-header">
                            <h5 class="mb-2">OTP VERIFICATION</h5>
                        </div>
                        <div class="mt-3">
                            <small>Enter OTP Code has been send to <br>sa******83@gmail.com</small>
                        </div>
                        <div class="card-body mx-5">
                            <form action="" method="POST">
                                <div class="input-container d-flex flex-row justify-content-center mt-2">
                                    <input type="text" class="m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" class="m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" class="m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" class="m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" class="m-1 text-center form-control rounded" maxlength="1">
                                  </div>
                            </form>
                        </div>
                        <small class="mt-4">
                            Didn't received OTP code ?
                        </small>
                        <div class="mt-1 mb-4">
                            <a href="#" class="">Resend Code</a>
                        </div>
                        <a href="#" class="btn btn-primary">Verify & Proceed</a>
                    </div>
                </div>
           </div>
        </div>
    </div>

    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
  </body>
</html>