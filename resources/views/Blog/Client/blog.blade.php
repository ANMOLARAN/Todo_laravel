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
        display:flex;
        gap:50px;
        align-items: center;
    }
    img{
        width:150px;
    }
</style>
<body>
    @include('Blog.Client.header')
    <br>
    <div>
    @include('Blog.Client.importantData')
</div>

<div class="box">
@foreach($data as $item)
<a href="detailBlog/{{$item->id}}">
<div class='box_1'>
<img src="{{ asset($item->image) }}" alt="Image"/>
<div class='box_2'>
<h1>{{$item->title}}<h1>
<h4>{{substr($item->description,0,50)}}</h4>
</div>
</div>
</a>
@endforeach
</div>
</body>
</html>