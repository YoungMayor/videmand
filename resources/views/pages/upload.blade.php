{{-- {{ dd($vd) }} --}}
@extends("layouts.main_layout")

@section("page-title", "VideOnDemand - upload")

@section("page-nav")
@include("navbar.withsearch")
@endsection

@section("main-page")

<div class="container" id="page-body">
    @isset($success)
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Congratulations!</strong> {{ $success }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <form action="{{ route("video.upload.save") }} " method="post" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label>Video Title:</label>
                    <input class="border rounded form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="The Title of the video" autofocus="" required="" value="{{ old('title') }}" >
                    
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="bg-light border rounded d-flex flex-wrap mb-2 pt-2 pb-2">
                    <div class="col-11 col-md-7 m-auto mb-2">
                        <div class="form-group">
                            <label>Description of Video:</label>
                            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" placeholder="Write a descriptive info about this video" rows="4" spellcheck="true" required="">{{ old('description') }}</textarea>
                            
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-11 col-md-5 m-auto">
                        <div class="form-group">
                            <label>Attach Video</label>
                            <div role="tablist" id="accordion-1">
                                <div class="card">
                                    <div class="card-header" role="tab">
                                        <h5 class="mb-0">
                                            <a class="text-info" data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-1">Upload File</a>
                                        </h5>
                                    </div>
                                    <div class="collapse show item-1" role="tabpanel" data-parent="#accordion-1">
                                        <div class="card-body">
                                            <input type="file" name="upload_video" class="w-100" accept="video/*">
                                            
                                @error('upload_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab">
                                        <h5 class="mb-0">
                                            <a class="text-info" data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2">Paste Youtube Link</a>
                                        </h5>
                                    </div>
                                    <div class="collapse item-2" role="tabpanel" data-parent="#accordion-1">
                                        <div class="card-body">
                                            <label>Link to Youtube video:</label>
                                            <input class="border rounded form-control  @error('link_video') is-invalid @enderror" type="text" name="link_video" placeholder="Example: https://youtube.com/xxxxxx" value="{{ old('link_video') }}" >

                                            
                                @error('link_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{ csrf_field() }} 

                <div class="form-group">
                    <button class="btn btn-outline-info btn-block btn-lg border rounded" type="submit">
                        Save &nbsp;<i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="{{ $___pJS->url("load-videos.js?v=2") }}"></script>
@endsection

