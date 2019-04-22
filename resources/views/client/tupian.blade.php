<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tupian</title>
</head>
<body>
@foreach($posts as $post)
    <div class="container">
        <img style="width:300px;" src="{{asset($post->lunboLink) }}" alt="">
    </div>
@endforeach
</body>
</html>