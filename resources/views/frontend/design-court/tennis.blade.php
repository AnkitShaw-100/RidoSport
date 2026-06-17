@extends('frontend.design-court.court-layout.main')
@push('title')
<title>Rido Sports | Tennis Court</title>
@endpush
@push('style')
   <style>

      #colorbig{
         padding: 50px 83.7px
      }
      </style>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Tennis Court &nbsp;&nbsp;Size: 120 X 60 Ft</h2>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\tennis.png')}}" class="img-fluid" alt="Tennis Court Layout">
@endsection