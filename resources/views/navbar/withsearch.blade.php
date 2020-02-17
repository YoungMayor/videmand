@extends("navbar.layout")

@section('nav-content')
<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
    <span class="sr-only">Toggle navigation</span>
    
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navcol-1">
    <ul class="nav navbar-nav">
        <li class="nav-item" role="presentation">
            <form action="{{ route("video.search") }}" method="get">
                <div class="input-group text-white">
                    <input class="form-control text-info" type="text" id="search-video" name="term" placeholder="Search For Video" required="" value="{{ $search ?? "" }}">

                    <div class="input-group-append">
                        <button class="btn btn-secondary"  type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" href="{{ route("video.list.mine") }}">
                <i class="fas fa-film"></i>&nbsp;My Videos
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" href="{{ route("video.upload") }} ">
                <i class="fas fa-upload"></i>&nbsp;Upload Video
            </a>
        </li>
    </ul>
</div>    
@endsection