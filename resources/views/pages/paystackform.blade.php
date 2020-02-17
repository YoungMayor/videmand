{{-- {{ dd($vd) }} --}}
@extends("layouts.main_layout")

@section("page-title", "VideOnDemand")

@section("page-nav")
@include("navbar.withsearch")
@endsection

@section("main-page")
<div class="container" id="page-body">
    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
          <div class="col-md-8 m-auto">
            <div>
                <h4 class="text-center">
                    You are about to pay NGN{{ number_format(env("VIDEO_COST", 1200)/100) }} for {{ $vd->title }}
                </h4>

                <p>
                    Enter your details below to make payments
                </p>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>
                </div>
            </div>

            {{-- <input type="hidden" name="email" value="otemuyiwa@gmail.com"> required --}}
            {{-- <input type="hidden" name="orderID" value="345"> --}}
            
            <input type="hidden" name="amount" value="{{ env("VIDEO_COST", 1200) }} "> 
            {{-- required in kobo --}}

            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['vid_token' => $vd->token,]) }}" > 
            {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
            {{-- required --}}
            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> 
            {{-- required --}}
            {{ csrf_field() }} 
            {{-- works only when using laravel 5.1, 5.2 --}}

            <p>
              <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>
            </p>
          </div>
        </div>
</form>
</div> 
@endsection

@section('page-js')
{{-- <script src="{{ $___pJS->url("load-videos.js") }}"></script> --}}
@endsection

