@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Handball Court</title>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Handball Court &nbsp;&nbsp;Size: 44 X 24 M</h2>
        <p style="text-decoration-line:overline; "><u style="font-size:22px; font-weight:900">Play Area : 40 X 20 M</u></p>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\handball.png')}}" class="img-fluid" alt="Handball Court Layout">    
@endsection
