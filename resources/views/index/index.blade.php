<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>صفحه اصلی سایت</title>
    <link href="<?= Url('index/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= Url('index/css/signin.rtl.css'); ?>" rel="stylesheet">
    <script src="<?= Url('panel/js/sweetalert.min.js'); ?>"></script>
    <link href="<?= Url('panel/css/sweetalert.css'); ?>" rel="stylesheet">
</head>

<body class="text-center">
@include('sweet::alert')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">خوش آمدید</h1>
    <p class="mt-5 mb-3 text-muted">لطفا ابتدا وارد پنل خود شوید</p>
    <label for="email" class="sr-only">آدرس ایمیل</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="ایمیل" required autofocus>
    @if ($errors->has('email'))
        <h6 style="margin:5px;padding: 5px;">
            <strong>{{ $errors->first('email') }}</strong>
        </h6>
    @endif
    <label for="password" class="sr-only">رمز</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="رمز ورود" required>
    @if ($errors->has('password'))
        <h6>
            <strong>{{ $errors->first('password') }}</strong>
        </h6>
    @endif
    <div class="checkbox mb-3">
        <label>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            مرا به خاطر بسپار
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ورود</button>
    <p class="mt-5 mb-3 text-muted">برای بهره مندی از امکانات سایت<a href="<?= url('/signin') ?>"> عضو</a> شوید</p>
</form>
</body>
</html>