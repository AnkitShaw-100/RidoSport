@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Volleyball Court</title>
@endpush
@push('style')
   <style>
      #colorbig{
        padding: 50px 70px
      }
   </style>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Volleyball Court &nbsp;&nbsp;Size: 24 X 15 M</h2>
        <p style="text-decoration-line:overline; "><u style="font-size:22px; font-weight:900">Play Area : 18 X 9 M</u></p>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\volleyball_white.png')}}" class="img-fluid" alt="Volleyball Court Layout">
@endsection


    