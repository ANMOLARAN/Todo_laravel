<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    To change the password, please click the given link.
    <a href='http://localhost:8000/client/resetPassword/{{urlencode(encrypt($email))}}/{{encrypt($token)}}'>Reset Password</a>
</body>

</html>