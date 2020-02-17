@extends("layouts.main_layout")

@section("page-title", "VideOnDemand")

@section("main-page")

<!-- Start: Highlight Clean -->
<div class="highlight-clean">
  <div class="container">
    <!-- Start: Intro -->
    <div class="intro">
      <h2 class="text-center">
        Welcome To Video-on-Demand
      </h2>

      <p class="text-center">
        Home of all your exclusive premium videos.&nbsp;
        <br>
        <br>
        <em>
          Entertainment is just one click away...
        </em>
      </p>
    </div>
    <!-- End: Intro -->

    <!-- Start: Buttons -->
    <div class="buttons">
      <a class="btn btn-primary border rounded shadow-sm" role="button" href="{{ route("video.list.all") }}">
        Browse Premium Videos
      </a>

      <a class="btn btn-info bg-info border rounded shadow-sm" role="button" href="{{ route("video.upload") }}">
        Upload Video
      </a>
    </div>
    <!-- End: Buttons -->
  </div>
</div>
<!-- End: Highlight Clean -->

@endsection
