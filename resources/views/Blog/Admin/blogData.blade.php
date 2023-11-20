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
    <h1>All Blog Data</h1>22    
    <table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Video</th>
        <th>Delete</th>
</tr>
@foreach($data as $item)
<tr>
<td>{{$item['id']}}</td>
<td>{{$item['title']}}</td>
<td>{{substr($item['description'],0,10)}}</td>
<td>{{$item['image']}}</td>
<td>{{$item['video']}}</td>
<td><a href="">Delete</a> </td>
</tr>
@endforeach
</table>
@include('Blog.Admin.importantData')
</body>
</html>