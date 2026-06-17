@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Pickle-Ball Court</title>
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
        <h2 class="text-center col-md-12"> Pickle-Ball Court &nbsp;&nbsp;Size: 60 X 30 Ft</h2>
        <p style="text-decoration-line:overline; "><u style="font-size:22px; font-weight:900">Play Area : 44 X 20 Ft</u></p>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\pickle-ball.png')}}" class="img-fluid" alt="Volleyball Court Layout">
@endsection


    