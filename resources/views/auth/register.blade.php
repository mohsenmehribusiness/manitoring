<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ثبت نام</title>
    <link href="<?= Url('index/css/bootstrap_sign_in.min.css'); ?>" rel="stylesheet">
    <link href="<?= Url('index/css/floating-labels.rtl.css'); ?>" rel="stylesheet">
</head>
<body>
<form class="form-signin" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">سایت مانیتورینگ</h1>
        <p>عضویت در سایت</p>
    </div>
    <div class="form-label-group">
        <input type="text" id="name" name="name" class="form-control" placeholder="نام خود را وارد کنید" required autofocus>
        <label for="name">نام</label>
        @if ($errors->has('name'))
            <h6 style="margin: 5px;padding: 5px;color: red;">
                {{ $errors->first('name') }}
            </h6>
        @endif
    </div>
    <div class="form-label-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="ایمیل" required autofocus>
        <label for="email">ایمیل</label>
        @if ($errors->has('email'))
            <h6 style="margin: 5px;padding: 5px;color: red;">
                {{ $errors->first('email') }}
            </h6>
        @endif
    </div>
    <div class="form-label-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="رمز ورود" required>
        <label for="password">رمز ورود</label>
        @if ($errors->has('password'))
            <h6 style="margin: 5px;padding: 5px;color: red;">
                {{ $errors->first('password') }}
            </h6>
        @endif
    </div>
    <div class="form-label-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        <label for="password_confirmation">تکرار رمز ورود</label>
    </div>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me">مرا به خاطر بسپار
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ثبت</button>
</form>
</body>
</html>