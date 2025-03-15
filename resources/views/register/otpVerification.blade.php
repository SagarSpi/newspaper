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
                            <small>Enter OTP Code has been send to <br>
                                @php
                                    $emailParts = explode('@', $email);
                                    $localPart = $emailParts[0]; // Local part of the email (before @)
                                    $domainPart = $emailParts[1]; // Domain part of the email (after @)
                                    
                                    // If local part is less than 5 characters, show it fully
                                    if (strlen($localPart) <= 5) {
                                        echo $localPart . '@' . $domainPart;
                                    } else {
                                        // Otherwise, show the first 2 characters, mask middle, and show last 2 characters before @
                                        echo substr($localPart, 0, 2) . str_repeat('*', strlen($localPart) - 4) . substr($localPart, -2) . '@' . $domainPart;
                                    }
                                @endphp
                            </small>
                        </div>
                        <div class="card-body mx-5">
                            <form action="{{route('verify.otp-store')}}" method="POST"  id="otpForm">
                                @csrf
                                <div class="input-container d-flex flex-row justify-content-center my-3">
                                    <input type="text" name="otp[0]" class="otp-input m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" name="otp[1]" class="otp-input m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" name="otp[2]" class="otp-input m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" name="otp[3]" class="otp-input m-1 text-center form-control rounded" maxlength="1">
                                    <input type="text" name="otp[4]" class="otp-input m-1 text-center form-control rounded" maxlength="1">
                                </div>
                                <div>
                                    @error('otp')<span class="text-danger">{{$message}}</span>@enderror
                                    @foreach(range(0, 4) as $index)
                                        @error("otp.{$index}")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    @endforeach
                                </div>
                                <small>
                                    Didn't received OTP code ?
                                </small>
                                <div class="mt-1 mb-4">
                                    <a href="{{route('verify.otp-resend')}}" class="">Resend Code</a>
                                </div>
                                <button type="submit" class="btn btn-primary otp-button w-100">Verify OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>


    {{-- JQUERY CDN JS LINK  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll(".otp-input");
    
            inputs.forEach((input, index) => {
                input.addEventListener("input", (e) => {
                    if (e.target.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
    
                input.addEventListener("keydown", (e) => {
                    if (e.key === "Backspace" && index > 0 && !e.target.value) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
    <script src="{{asset('assets/global/js/bootstrap.bundle.js')}}"></script>
  </body>
</html>