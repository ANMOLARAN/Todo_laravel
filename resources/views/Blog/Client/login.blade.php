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

    form div{
        display:flex;
        justify-content: space-between;
        align-items: center;
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
<div>
           <label>Email</label>
           <input type='text' name='email'/>
</div>
<div>
          <label>Password</label>
           <input type='password' name='password'/>
</div>
<div>
           <button type='submit'>Submit</button>
</div>
        </form>
    <h2>Don't have an account?</h2>
    <h1><a href='/signUp'>SignUp</a></h1>
    </div>
</body>
</html>