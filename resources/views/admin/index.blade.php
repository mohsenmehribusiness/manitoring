@extends('layouts.adminlayouts')

@section('content')
    <!-- this is content -->
@endsection

@section('head-content')
    <button data-toggle="modal" data-target=".bd-example-modal-lg"  type="button" class="btn btn-outline-warning">
        ایجاد مانیتور
    </button>
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="123" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ثبت مانیتور جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/user/monitor" method="post" id="form_montitor">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">اسم</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">آدرس سایت</label>
                            <textarea name="URL" style="direction: ltr;" class="form-control" id="message-text" placeholder="https://www.google.com/"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">دوره زمانی(دقیقه)</label>
                            <textarea name="time" class="form-control" id="message-text"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">تعداد روز</label>
                            <select name="day" id="inputState" class="form-control custom-select-sm" style="font-size:50% !important;">
                                <option value="1" selected title="رایگان" style="color:dodgerblue!important;">
                                    1 روز
                                </option>
                                <option value="5" title="رایگان" style="color:dodgerblue!important;">5 روز</option>
                                <option value="10" title="پولی" style="color:darkred !important;">10 روز</option>
                                <option value="20" title="پولی" style="color:darkred !important;">20 روز</option>
                                <option value="30" title="پولی" style="color:darkred !important;">30 روز</option>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
                        <div class="row px-3" dir="ltr" style="margin-top:50px !important;"><button type="submit" class="btn btn-primary">مانیتور</button></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <!-- this is head -->
    <!-- ajax -->
       <meta name="csrf-token" content="{{csrf_token()}}" >
    <!-- ajax -->
    <style>
        .numbertable
        {
            width:3%;
        }
        .modal-body{
            height: 250px;
            overflow-y: auto;
        }
        @media (min-height: 500px) {
            .modal-body { height: 400px; }
        }

        @media (min-height: 800px) {
            .modal-body { height: 600px; }
        }
    </style>
@endsection

@section('end_body')
    <!-- this is end_body -->
    <script src="<?= Url('panel/js/jquery-3.3.1.js'); ?>"></script>
    <script>
        check=function () {
            $('form_montitor').submit();
        }
    </script>
    <?php /*$url_settingg=Url('/user/check'); */?><!--
    <script type="text/javascript">
        check=function()
        {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }});
            $.ajax({
                url : '<?/*= $url_settingg */?>',
                type : "POST",
                success:function (data)
                {
                    alert("hi");
                },
                /*
                error:function () {
                    alert(error);
                }*/
            });
        };
    </script>-->
@endsection