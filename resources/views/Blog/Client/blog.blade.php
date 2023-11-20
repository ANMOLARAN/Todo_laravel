<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .box{
        display:flex;
        flex-direction: column;
        gap:20px;
    }
    .box_1{
        height:25%;
        display:flex;
        gap:50px;
    }
    img{
        width:150px;
    }
</style>
<body>
    @include('Blog.Client.header')
    @include('Blog.Client.importantData')
<div class="box">
@foreach($data as $item)
<a href="detailBlog/{{$item->id}}">
<div class='box_1'>
<img src="{{ asset($item->image) }}" alt="Image"/>
<div class='box_2'>
<h1>{{$item->title}}<h1>
<h4>{{$item->description}}</h4>
</div>
</div>
</a>
@endforeach
</div>
</body>
</html>