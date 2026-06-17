@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Basketball Court</title>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Basketball Court &nbsp;&nbsp;Size: 32 X 19 M</h2>
        <p style="text-decoration-line:overline; "><u style="font-size:22px; font-weight:900">Play Area : 28 X 15 M </u></p>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\basketball.png')}}" class="img-fluid" alt="Basketball Court Layout">
@endsection


    
 