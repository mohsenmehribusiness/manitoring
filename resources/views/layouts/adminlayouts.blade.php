<!doctype html>
<html lang="en" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
      @yield('title')
    </title>
    <link href="<?= Url('panel/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= Url('panel/css/dash.css'); ?>" rel="stylesheet">
    <link href="<?= Url('fonts/font.css'); ?>" rel="stylesheet">
    <!-- sweet alert -->
    <script src="<?= Url('panel/js/sweetalert.min.js'); ?>"></script>
    <link href="<?= Url('panel/css/sweetalert.css'); ?>" rel="stylesheet">
    <!-- sweet alert -->
      <!-- ajax xxx -->
      <meta name="csrf-token" content="{{csrf_token()}}" >
      <!-- ajax xxx -->
    @yield('head')
  </head>
  <body>
  @include('sweet::alert')
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <div class="row">
        <div class="col" style="color:whitesmoke;">
          ایمیل : {{auth()->user()->email}}
        </div>
      </div>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <div class="row">
            <div class="col" style="color:whitesmoke;padding-top:8px;">
              {{auth()->user()->name}}
            </div>
            <div class="col">
              <form  action="{{route('logout')}}" method="post">
                {!!  csrf_field() !!}
                <button id="logoutt" class="btn btn-outline-light" type="submit">خروج</button>
              </form></div>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        @include('layouts.nav-right')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h3">
              @yield('head-content')
            </h1>
          </div>
          @yield('content')
        </main>
      </div>
    </div>
    <script src="<?= Url('panel/js/jquery-3.2.1.slim.min.js'); ?>"></script>
    <script src="<?= Url('panel/js/popper.min.js'); ?>"></script>
    <script src="<?= Url('panel/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= Url('panel/js/feather.min.js'); ?>"></script>
    <script>
      feather.replace()
    </script>
    @yield('end_body')
  </body>
</html>