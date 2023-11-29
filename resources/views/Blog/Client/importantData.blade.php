<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container{
        width:100%;
        display:grid;
       grid-template-columns: auto auto;
       border:2px solid blue;
    }

    img{
      width:150px;
      height:150px;
    }

    .container1,.container2,.container3,.container4{
        display:flex;
        flex-direction: column;
        align-items: center;
    }  

    a{
        text-decoration: none;
    }
</style>
<body>
   
    <div class='container'>
        <div class="container1">
<a href='/client/detailBlog/{{$temp[1]->id}}'>
        <h1>{{$temp[0]->title}}</h1>
        <img src="{{asset($temp[0]->image)}}"/>
        <p>{{substr($temp[0]->description,0,60)}}</p>
</a>
    </div>
    <div class="container2">
<a href='/client/detailBlog/{{$temp[1]->id}}'>
        <h1>{{$temp[1]->title}}</h1>
        <img src="{{asset($temp[1]->image)}}"/>
        <p>{{substr($temp[1]->description,0,60)}}</p>
</a>
    </div>
    <div class="container3">
<a href='/client/detailBlog/{{$temp[1]->id}}'>
        <h1>{{$temp[2]->title}}</h1>
        <img src="{{asset($temp[2]->image)}}"/>
        <p>{{substr($temp[2]->description,0,60)}}</p>
</a>
    </div>
    <div class="container4">
<a href='/client/detailBlog/{{$temp[1]->id}}'>    
        <h1>{{$temp[3]->title}}</h1>
        <img src="{{asset($temp[3]->image)}}"/>
        <p>{{substr($temp[3]->description,0,60)}}</p>
</a>
</div>
    </div>
</body>
</html>