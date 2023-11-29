<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1,   shrink-to-fit=no">
<title>Blog Upload</title>
</head>
<body>
    @include('Blog.Client.header')
<div>
<h3>Insert Blog Data</h3>
<hr>
<form method="POST" action="{{route('client.uploadVideo')}}" enctype="multipart/form-data" >
@csrf
<div>
<label>Title</label>
<input type="text" name="title" placeholder="Enter Title" value="{{old('title')}}">
@error('title')
{{$message}}
@enderror
</div>
<div >
<label>Description</label>
<input type="text" name="description" placeholder="Enter Description" value="{{old('description')}}">
@error('description')
{{$message}}
@enderror
</div>
<div >
<label>Image</label>
<input type="file" name='image' value="{{old('image')}}">
@error('image')
{{$message}}
@enderror
</div>
<div>
<label>Choose Video</label>
<input type="file"  name="video" value="{{old('video')}}">
@error('video')
{{$message}}
@enderror
</div>
<hr>
<button type="submit" >Submit</button>
</form>
</div>
</body>
</html>