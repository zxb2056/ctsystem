<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test-upload</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="card rounded-0 my-3">
        <div class="card-header d-flex">
            <div class="mr-auto"><strong>文章管理</strong></div>
        </div>
        <div class="card-body ">
            <form action="{{ asset('/test') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">文章标题</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="postType" class="col-md-2 col-form-label">选择分类</label>
                    <div class="col-md-10" id="postType">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="posttype" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">新闻动态</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="posttype" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">专业技术</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="posttype" id="inlineRadio3" value="option3">
                            <label class="form-check-label" for="inlineRadio3">党建扶贫</label>
                        </div>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="lunboPicture">上传轮播图片</label>
                        <input type="file" class="form-control-file col-md-10" id="lunboPicture" name="lunbophoto">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="lunbotitle">轮播图标题</label>
                        <input type="text" class="form-control-file col-md-10" id="lunbotitle" name="lunboTitle"
                            maxlength="20">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="lunboCaption">轮播图文字</label>
                        <input type="text" class="form-control-file col-md-10" id="lunboCaption" name="lunboCaption"
                            maxlength="200">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="content">文章内容</label>
                        <textarea class="form-control col-md-10" id="content" rows="10" name="content" placeholder="输入文章内容"></textarea>

                    </div>
                    <div class="form-group row justify-content-center">
                        <input class="btn btn-outline-success justify-content-end" type="submit" value="提交">

                    </div>


            </form>



        </div>
        <div class="card-footer">
            注：轮播图标题最大长度20个字符；轮播图文字最多200个字。首页轮播图大小最好先调整为宽800*高400
        </div>
    </div>



    </div>

    </div>




</body>

</html>
