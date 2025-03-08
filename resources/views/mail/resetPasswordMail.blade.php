<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    
    <h3>Reset Your Password</h3>
    <p>Click the link below to reset the password for your account</p>
    <a href="{{ route('password.reset', $token) }}">Reset Password</a>

</body>
</html>