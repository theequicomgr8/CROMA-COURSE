@php 
$data=explode(",",$data->footer_pic);

@endphp
@foreach($data as $value)

<img src="{{basepath('footer/'.$value)}}" style="width:700px;"> 
<a href="/footerimg_delete/{{Request::segment(2)}}/{{$value}}">{{$value}}</a>
<br>

@endforeach