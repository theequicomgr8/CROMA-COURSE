@php 
$data=explode(",",$data->header_pic);

@endphp
@foreach($data as $value)

<img src="{{basepath('header/'.$value)}}" style="width:700px;"> 
<a href="/headerimg_delete/{{Request::segment(2)}}/{{$value}}">{{$value}}</a>
<br>

@endforeach