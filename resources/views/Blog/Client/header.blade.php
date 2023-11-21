<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     .header{
        display:flex;
        justify-content: space-between;
    }
</style>
<body>
<div class='header'>
    <h1><a href='/blog'>Blog Website</a></h1>
    @if(session('admin'))
    <h2><a href='/admin'>Admin</a></h2>
    @endif
    @if(session('email'))
    <h2><a href='/logout'>LogOut</a></h2>
    @else
    <h2><a href='/login'>LogIn</a></h2>
    @endif
</div>
</body>
</html>