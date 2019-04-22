
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- <link rel="stylesheet" type="text/css" href="/css/wangEditor.min.css"> -->
</head>
<body>

<label class="col-md-2 col-form-label" for="postcontent">文章内容</label>

<div id="postcontent"><p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p></div>

<button class="btn btn-outline-success justify-content-end" type="submit" id="submit">提交</button>




<!-- <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script> -->

<script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('/js/wangEditor.min.js') }}"></script>
<script src="{{ asset('/js/posteditor.js') }}"></script>

</body>
</html>











                       
                           
                             
                        
      









