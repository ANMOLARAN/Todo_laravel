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
        height:50vh;
        display:grid;
       grid-template-columns: auto auto;
       border:2px solid blue;
    }

    img{
      width:200px;
    }

    .container1,.container2,.container3,.container4{
        display:flex;
        flex-direction: column;
        align-items: center;
    }

  ..  
</style>
<body>
   
    <div class='container'>
        <div class="container1">
        <h1>{{$data1->title}}</h1>
        <img src="{{asset($data1->image)}}"/>
        <p>{{substr($data1->description,0,60)}}</p>
    </div>
    <div class="container2">
        <h1>{{$data2->title}}</h1>
        <img src="{{asset($data2->image)}}"/>
        <p>{{substr($data2->description,0,60)}}</p>
    </div>
    <div class="container3">
        <h1>{{$data3->title}}</h1>
        <img src="{{asset($data3->image)}}"/>
        <p>{{substr($data3->description,0,60)}}</p>
    </div>
    <div class="container4">
        <h1>{{$data4->title}}</h1>
        <img src="{{asset($data4->image)}}"/>
        <p>{{substr($data4->description,0,60)}}</p>
    </div>
</body>
</html>