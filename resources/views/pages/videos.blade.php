@extends("layouts.main_layout")

@section("page-title", "VideOnDemand")

@section("page-nav")
@include("navbar.withsearch")
@endsection

@section("main-page")

<div class="container" id="page-body">
    <div class="row">
        <div class="col">
            @isset($my_vid)
                <div class="my-videos-note">
                    Videos you have purchased will appear here
                </div>
            @endisset
            <div class="d-flex flex-wrap" id="video-list">
                
            </div>

            @php
                if (isset($my_vids)){
                    $route = route("video.list.mine.get");
                }elseif (isset($search)) {
                    $route = route("video.search.get");
                }else{
                    $route = route('video.list.all.get');
                }
            @endphp
            <div id="page-param" class="d-none">
                {{ $search ?? rand(1, 10) }}
            </div>
            <button class="btn btn-outline-info btn-block btn-lg border-secondary w-75 mt-3 mb-3 ml-auto mr-auto" id="load-videos" type="button" data-page="0" data-target="{{ $route }}">
                More Videos
            </button>
        </div>
    </div>
</div>

<div class="aj-template d-none">
    @include('templates.videocard')
</div>
@endsection

@section('page-js')
<script src="{{ $___pJS->url("load-videos.js?v=3") }}"></script>
@endsection
