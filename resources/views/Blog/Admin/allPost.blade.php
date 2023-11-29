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
    <h1>All Blog Data</h1>
    <table>
    <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Video</th>
        <th>Approve</th>
        <th>Delete</th>
        <th>Show</th>
</tr>
@foreach($data as $item)
<tr>
<td>{{$item['id']}}</td>
<td>{{$item['user_id']}}</td>
<td>{{$item['title']}}</td>
<td>{{substr($item['description'],0,10)}}</td>
<td>{{$item['image']}}</td>
<td>{{$item['video']}}</td>
<td><a href="/admin/approve/{{$item['id']}}">Approve</a> </td>
<td><a href="/admin/delete/{{$item['id']}}">Delete</a> </td>
<td><a href="/client/detailPost/{{$item['id']}}">Show</a></td>
</tr>
@endforeach
</table>
</body>
</html>