<tbody id="monitoring_insert_{{$monitor->id}}">
@if(!empty(Session::get('monitoring')))
    @foreach(Session::get('monitoring') as $key=>$value)
        <tr>
            <td>
                {{$value->created_at}}
            </td>
            <td>
                {{$value->HTTP}}
            </td>
            <td>انجام شد</td>
        </tr>
    @endforeach
@endif
</tbody>