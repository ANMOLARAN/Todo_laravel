<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Choose 4 important</h1>
    <form action='/importantData' method='POST'>
        @csrf
        <input type='text' name='value1' required/>
        <input type='text' name='value2' required/>
        <input type='text' name='value3' required/>
        <input type='text' name='value4' required/>
        <button type='submit'>Submit</button> 
    </form>
</body>
</html>