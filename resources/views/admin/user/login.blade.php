<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台登录入口</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container  pt-5">
              <div class="card w-50 mt-5 mx-auto">
                <div class="card-header">
                   <h5 class="h5 text-bold text-center">管理系统登陆</h5> 
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/login/denglu')}}" method="POST">
                    {{csrf_field()}}
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label">用户名 </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-3 col-form-label">密码</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword" name="password">
                            </div>
                        </div>
                        <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="is_remember" value="1">
                        <label class="form-check-label" for="is_remember">记住我</label>
                        </div>

                @if(count($errors) >0)
                <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </div>
                @endif

                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary">登陆</button>
                </div>
               
                </div>
                </form>
            </div>
        </div>
   
 
</body>
</html>