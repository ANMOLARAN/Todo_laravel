<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
/* .container{
    display:flex;
    flex-direction: column;
    align-items: center; */
  */

form{
    display:flex;
    flex-direction:column;
    align-items:center;
}

img{
    width:40%;
    height:20vh
}

.description{
    width:100%;
    height:400px;
}
.file{
    padding:10px;
}

.title{
width:400px;
}

</style>
<body>
@include('Blog.Client.header')
    <div class='container'>

    <form action="{{route('admin.update',['id'=>$data['id']])}}" method='post' enctype="multipart/form-data">
        @csrf
        @method('PUT')
<div>
    <label>Edit Title</label>
    <textarea type='text' name='title' class='title'>{{$data['title']}}</textarea>
</div>
<div>
    <img src="{{asset('user/'.$data->image)}}"/>
    <label>Choose Another Image</label>
     <input class='file' type="file" name='image'>
</div>
<div>
    <label>Edit Description</label>
    <textarea class='description' type='text' name='description'>{{$data['description']}}</textarea>
</div>
<div>
    <video width="640" height="360" controls>
    <source src="{{ asset('user/'.$data->video) }}" type="video/mp4">
    </video>
    <label>Choose New Video</label>
    <input type="file"  name="video">
</div>
    <button type='submit'>Submit</button>
</form>

</div>
</body>
</html>