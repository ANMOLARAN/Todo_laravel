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
<div >
<label>Title</label>
<input type="text" name="title" placeholder="Enter Title">
</div>
<div >
<label>Description</label>
<input type="text" name="description" placeholder="Enter Description">
</div>
<div >
<label>Image</label>
<input type="file" name='image'>
</div>
<div >
<label>Choose Video</label>
<input type="file"  name="video">
</div>
<hr>
<button type="submit" >Submit</button>
</form>
</div>
</body>
</html>