<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table{
        width:1000px;
    }
    table,tr,th,td{
        border:1px solid black;
    }
    th{
        background-color:pink;
    }
    td{
        background-color:orange;
    }
    </style>
<body>
    @include('Blog.Admin.header')
    <h1><a href="{{route('admin.newBlog')}}">Insert New Blog</a></h1>
    <h1>All Blog Data</h1>
    <table>
    <tr>
        <th>Id</th>
        <th>User_Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Video</th>
        <th>Status</th>
        <th>User</th>
        <th>Delete</th>
        <th>Show</th>
        <th>Edit</th>
</tr>
@foreach($data as $item)
<tr>
<td>{{$item['id']}}</td>
<td>{{$item['user_id']}}</td>
<td>{{$item['title']}}</td>
<td>{{substr($item['description'],0,10)}}</td>
<td>{{$item['image']}}</td>
<td>{{$item['video']}}</td>
<td>{{$item['status']}}<a href="{{route('admin.change',['id'=>$item['id']])}}"><button>Change</button></a></td>
<td>{{$item['user']}}</td>
<td>
    <form action="{{route('admin.delete',['id'=>$item['id']])}}" method="POST">
    @method('DELETE')
    @csrf
     <button>Delete</button>
</form>
</td>
<td> <a href="{{route('admin.showBlog',['id'=>$item->id])}}">Show</a></td>
<td> <a href="{{route('admin.editBlog',['id'=>$item->id])}}">Edit</a></td>
</tr>
@endforeach
</table>
@include('Blog.Admin.importantData')
</body>
</html>