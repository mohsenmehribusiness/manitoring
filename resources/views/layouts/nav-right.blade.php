<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a style="visibility: hidden;" class="nav-link active" href="<?php url('admin/'); ?>">
          <span data-feather="home"></span>
          ******* <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{route('home')}}" >
          <span data-feather="home"></span>
          خلاصه وضعیت<span class="sr-only"></span>
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('showmonitor' , ['id' => auth()->user()->id]) }}" >
          <span data-feather="camera"></span>
          بررسی مانیتور های ثبت شده
        </a>
      </li>
    </ul>
  </div>
</nav>