<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
body{
        width:100%;
        height:100vh;
        display:flex;
        align-items: center;
        flex-direction: column;
        margin-top:40vh;
        background-color:orange;
    }
<body>
    <h1>Please Enter the New Password</h1>
    <form action="{{route('client.updatePassword',['email'=>encrypt($email)])}}" method="POST">
        @csrf
        <label>New Password</label>
        <input type='password' name='password'/>
        <button  type='submit'>Submit</button>
    </form>
</body>
</html>