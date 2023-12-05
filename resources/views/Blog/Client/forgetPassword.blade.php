<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        width:100%;
        height:100vh;
        display:flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        margin-top:40vh;
        background-color:orange;
    }
    form{
        padding:100px;
        background-color: pink;
    }
</style>
<body>
    <h1>Please Enter the email you want to change password of</h1>
    <form action="{{route('client.enterEmail')}}" method="POST">
        @csrf
        <label>Email</label>
        <input type='email' name='email'/>
        <button  type='submit'>Submit</button>
    </form>
</body>
</html>