<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   
   .form{
    width:100%;
    height:100vh;
    display:flex;
    flex-direction: column;
    align-items: center;
    background-color: orange;
   }

    form{
        width:400px;
        display:flex;
        flex-direction: column;
        gap:10px;
        background-color:pink;
        border-radius: 6px;
        padding:40px;
    }

    form box{
        display:flex;
        justify-content: space-between;
        align-items: center;
    }

    .box h4{
        color:red;
    }

    .box1{
        display:flex;
        justify-content: space-between;
        align-items: center;
        margin:0px;
        padding:0px;
    }
    
    .box2{
        margin:0px;
        padding:0px;
    }

    input{
        padding:6px;
        width:300px;
    }

    button{
        padding:10px 20px; 
        margin-left:40%;
        background-color: gray;
        border-radius: 4px;
        font-size: larger;
    }

    a{
        text-decoration: none;
    }

</style>
<body>
@include('Blog.Client.header')
<div class='form'>
    <h1>Alredy have an account</h1>
    <h2>Log In</h2>
    <form method='post'action='/auth/login' >
    @csrf
<div class='box'>
    <div class='box1'>
           <label>Email</label>
           <input type='email' name='email' value="{{old('email')}}"/>
</div>
    <div class='box2'>
           @error('email')
           <h4>{{$message}}</h4>
           @enderror
    </div>
</div>
<div class='box'>
    <div class='box1'>
          <label>Password</label>
           <input type='password' name='password'/>
</div>
    <div>
           @error('password')
           <h4>{{$message}}</h4>
           @enderror
    </div>
</div>
<div>
           <button type='submit'>Submit</button>
</div>
    </form>
    <h1><a href="{{route('client.forgetPassword')}}">Forget Password</a></h1>
    <h2>Don't have an account?</h2>
    <h1><a href='/signUp'>SignUp</a></h1>
    </div>
</body>
</html>