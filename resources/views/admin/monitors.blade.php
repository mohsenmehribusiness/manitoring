@extends('layouts.adminlayouts')

@section('content')
    <!-- this is content -->
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>نام</th>
                <th>URL</th>
                <th>دوره زمانی</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody id="zero">
            @foreach($monitors as $monitor)
                <tr>
                    <td>{{$monitor->name}}</td>
                    <td>{{$monitor->URL}}</td>
                    <td>{{$monitor->time}}</td>
                    <td>
                        <style>
                            .biggi button{
                                color:rgb(220,53,69) !important;
                            }
                            .biggi:hover button
                            {
                                color: white !important;
                            }
                        </style>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <form class="biggi btn border-right  btn-outline-danger" action="{{ route('monitoring_destroy'  , ['id' => $monitor->id]) }}" method="post">
                                {{ csrf_field() }}
                                <button style="background:none;border:none;margin:0;padding:0;cursor: pointer;" type="submit">حذف</button>
                            </form>
                            <button onclick="monitoring({{$monitor->id}})" data-target="#{{$monitor->id}}_modal" data-toggle="modal" type="button" class="btn border-left border-co  btn-outline-info">بررسی</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        @foreach( $monitors as $monitor)
            <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="{{$monitor->id}}_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$monitor->name}}</h5>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped" id="tblGrid">
                                    <thead id="tblHead">
                                    <tr>
                                        <th>زمان</th>
                                        <th>کد ثبت شده</th>
                                        <th>معنی</th>
                                    </tr>
                                    </thead>
                                    <tbody id="monitoring_insert_{{$monitor->id}}">
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end show -->
        @endforeach
    </div>
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
    {{ auth()->user()->name}}
@endsection

@section('head')

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
    <?php $url_monitoring=Url('/user/monitoring'); ?>
    <script>
        deleting=function(id){
            $("deleting_"+id).submit(function( event ) {
                event.preventDefault();
            });
        }
        monitoring=function (id)
        {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }});
            $.ajax({
                url : '<?= $url_monitoring ?>',
                type : "POST",
                data:'id='+id,
                success:function (data)
                {
                    var choose=$("tbody#monitoring_insert_"+id);
                    choose.empty();
                    for (i = 0; i < data.length; i++)
                    {
                        $( "<tr id='tr_delete'><td>"+ data[i].created_at +"</td><td>"+ data[i].HTTP +"</td><td></td></tr>" ).appendTo(choose);
                        //alert(data[i].created_at);
                        //var tr=choose.prepend( $("tr") );
                        //tr.append($('td').text(data[i].created_at));
                    }
                },
                error:function ()
                {
                }
            });
        };
        //https://azaronline.com/blog/%D9%84%DB%8C%D8%B3%D8%AA-%DA%A9%D8%AF%D9%87%D8%A7%DB%8C-%D9%88%D8%B6%D8%B9%DB%8C%D8%AA-http/
        //https://webgoo.ir/100/%D9%84%DB%8C%D8%B3%D8%AA-%DA%A9%D8%AF%D9%87%D8%A7%DB%8C-%D9%88%D8%B6%D8%B9%DB%8C%D8%AA-http-%D9%88-%D9%85%D8%B9%D9%86%DB%8C-%D8%AE%D8%B7%D8%A7%D9%87%D8%A7%DB%8C-%D8%B3%D8%B1%D9%88%D8%B1
        //https://radzad.com/blog/http-status-codes
        //https://mizfa.com/blog/http-status/
    </script>
@endsection