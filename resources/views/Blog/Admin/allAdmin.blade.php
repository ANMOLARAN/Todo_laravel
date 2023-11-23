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
    a{
        text-decoration: none;
    }
    </style>
<body>
    @include('Blog.Admin.header')
    <h1>All Admins</h1>
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
<td><a href='deleteAdmin/{{$item['id']}}'>Delete</a></td>
</tr>
@endforeach
</table>

<h1><a href='/newAdmin'>Insert New Admin</a></h1>
</body>
</html>