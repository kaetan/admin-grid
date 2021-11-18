<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="{!!  \App\Helpers\Admin\Assets::getAssetCssPublicUrl() !!}" type="text/css" />
</head>

<body class="gray-bg">

<div class="jumbotron">
    <div class="container middle-box text-center loginscreen animated fadeInDown" style="max-width: 400px">
        <div >
            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                        {{ $message }}. <br/>
                    @endforeach
                </div>
            @endif
            <form class=" m-t" role="form" action="" method="POST" >
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control js-phone-mask" placeholder="Телефон" name="phone" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Пароль" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>
            </form>
        </div>
    </div>
</div>


</body>
</html>
