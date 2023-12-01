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
    a{
        text-decoration: none;
    }
</style>
<body>
<div class='header'>
<h1><a href="{{route('blog')}}">Blog Website</a></h1>
    <h2><a href="{{route('admin.allUser')}}">All User</a></h2>
    <h2><a href="{{route('admin.allAdmin')}}">All Admins</a></h2>
    <h2><a href="{{route('admin')}}">Admin</a></h2>
</div>
</body>
</html>