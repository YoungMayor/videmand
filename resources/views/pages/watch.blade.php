{{-- {{ dd($vd) }} --}}
@extends("layouts.main_layout")

@section("page-title", "VideOnDemand")

@section("page-nav")
@include("navbar.withsearch")
@endsection

@section("main-page")
<div class="container" id="page-body">
    <div class="row">
        @if ($purchased)
            <div class="col-10 col-md-8 m-auto mb-md-auto" id="watch-video-col">
                @if (strpos($vd->video_url, "youtube.com"))
                    <iframe width="420" height="315" class="d-block m-auto w-100" src="{{ $vd->video_url }}?autoplay=1"></iframe>                    
                @else
                    <video width="560" height="315" controls="" autoplay="" loop="" class="d-block m-auto w-100">
                        <source src="{{ $vd->video_url }}">
                    </video>                    
                @endif

            </div>
        @endif

        <div class="col-10 col-md-4 m-auto" id="video-meta-col">
            <h4 class="text-center">{{ $vd->title }}</h4>

            <p class="text-center">{{ $vd->description }}</p>

            <p class="m-0">
                <small>Uploaded By:</small>
                &nbsp;<strong>{{ $vd->name }}</strong>
            </p>
            <p>
                <small>Uploaded on:</small>
                &nbsp;<strong>{{ date("M jS, Y", strtotime($vd->uploaded_on)) }}</strong>
            </p>
        </div>
    </div>

    @if (!$purchased)
        <div class="row">
            <div class="col-md-6 m-md-auto">
                <span class="text-info">
                    <strong>
                        <em>You have not purchased this video. You need to purchase it before you can watch it!</em>
                    </strong>
                    <br>
                    <br>
                    <strong>
                        <em>Click the button below to purchase</em>
                    </strong>
                    <br>
                </span>
                <a class="btn btn-outline-info btn-block mt-2 mb-4" role="button" href="{{ route("payment_form", ['token' => $vd->token]) }} ">Purchase Video</a>
            </div>
        </div>        
    @endif
</div> 
@endsection

@section('page-js')
{{-- <script src="{{ $___pJS->url("load-videos.js?v=2") }}"></script> --}}
@endsection

