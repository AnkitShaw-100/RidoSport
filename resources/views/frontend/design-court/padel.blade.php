@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Padel Court</title>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Padel Court &nbsp;&nbsp;Size: 66 X 33 Ft </h2>
        {{-- <p style="text-decoration-line:overline; "><u style="font-size:22px; font-weight:900">Play Area : 28 X 15 M </u></p> --}}
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\padel.png')}}" class="img-fluid" alt="Padel Court Layout">
@endsection