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
        height: 100vh;
        display:flex;
        justify-content: center;
        background-color: gainsboro;
    }

    .main{
       width:50%;
       display:flex;
       flex-direction: column;
       background-color: purple;
    }

    .up{
    border: 2px solid aquamarine;
    background-color: orange;
    }
   
    form{
        display:flex;
        flex-direction: column;
        gap:5px;
        align-items: center;
    }

    .down{
        background-color: white;
    }

    input{
        width:50%;
        height:30px;
        font-size: larger;
    }
     

    a{
        text-decoration: none;
    }

    .done{
        color:purple;
        border:2px solid black;
        border-radius: 40%;
        padding:10px;
    }

    .cross{
        border:2px solid red;
        border-radius: 10%;
        padding:6px;
        font-size:larger;
        color:red;
        margin:20px;
    }

    button{
        padding:10px; 
        font-size: 20px;
    }

    .down h1{
        color:green;
    }
</style>
<body>
    <div class='main'>
        <div class='up'>
    <form action='/storeSession' method='post'>
        @csrf
        <label><h1>To do:</h1></label>
        <input type='text' name='session' placeholder="TODO" required/>
        <button type='submit'>Submit</button>
    </form>
       
</div>
<div class="down">
    <h1>TO DO</h1>


    @foreach($todo as $item)
   <h2> <a class='done' href='/doneSession/{{$item}}'>Done</a>
    {{$item}}
    <span><a class='cross' href='/delete/{{$item}}'>X</a></span></h2>
    @endforeach

    <h1>DONE</h1>
    @foreach($done as $item)
    <h2>
    {{$item}}
    <span><a class='cross' href='/delete/{{$item}}'>X</a></span></h2>
    @endforeach
        </div>
</div>
</body>
</html>