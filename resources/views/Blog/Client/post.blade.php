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
        width:100%;
        justify-content: space-between;
    }
    .box_1{
        display:flex;
        align-items: center;
        gap:20px;
    }

    .box_3{
        display: flex;
        align-items: center;
        gap:40px;
    }
    img{
        width:150px;
    }
    a{
        text-decoration: none;
    }
</style>
<body>
    @include('Blog.Client.header')
    <h1><a href="{{route('client.newBlog')}}"><button>Insert New post</a></h1>
    <h1>Your Posts</h1>
    <div>
@foreach($data as $item)
<a href="{{route('client.showBlog',['id'=>$item->id])}}">
<div class='box'>
<div class='box_1'>
    <img src="{{ asset('user/'.$item->image) }}" alt="Image"/>
<div class='box_2'>
    <h1>{{$item->title}}<h1>
    <h4>{{substr($item->description,0,50)}}</h4>
</div>
</div>
<div class='box_3'>
    <h3>{{$item->status}}</h3>
    <h3><a href="{{route('client.editBlog',['id'=>$item->id])}}"><button>EDIT</button></a></h3>
    <h3><form action="{{route('client.delete',['id'=>$item->id])}}" method="POST">
      @csrf
       @method('DELETE')
       <button>DELETE</button>
    </form>
      </h3>
</div>
</div>
</a>
@endforeach
</div>
</body>
</html>