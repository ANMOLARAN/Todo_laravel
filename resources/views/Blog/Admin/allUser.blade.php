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
    <h1>All Users</h1>
    <table>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Delete</th>
</tr>
@foreach($data as $item)
<tr>
<td>{{$item['id']}}</td>
<td>{{$item['email']}}</td>
<td><a href="/admin/delete/{{$item['id']}}">Delete</a> </td>
</tr>
@endforeach
</table>
</body>
</html>