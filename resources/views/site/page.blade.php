@extends('site.layout')

@section('title', $page['title'])

@section('content')
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{$page['title']}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    {!! $page['body'] !!}
</div>

@endsection