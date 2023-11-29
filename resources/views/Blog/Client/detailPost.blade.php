<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.container{
    display:flex;
    flex-direction: column;
    align-items: center;
}

img{
    width:40%;
    height:20vh
}
</style>
<body>
@include('Blog.Client.header')
    <div class='container'>
    <h1>{{$data['title']}}</h1>
    <img src="{{asset('user/'.$data->image)}}"/>
    <p>{{$data['description']}}</p>
    
    <video width="640" height="360" controls>
    <source src="{{ asset('user/'.$data->video) }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
</div>
</body>
</html>