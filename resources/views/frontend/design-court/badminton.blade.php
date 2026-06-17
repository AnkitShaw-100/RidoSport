@extends('frontend.design-court.court-layout.main')
@push('title')
   <title>Rido Sports | Badminton Court</title>
@endpush

@section('court-name_area')
    <div class="text-center">
        <h2 class="text-center col-md-12"> Badminton Court &nbsp;&nbsp;Size: 44 X 20 Ft</h2>
    </div>
@endsection

@section('court-image')
<img src="{{url('court-design\layouts\layout_white\badminton_white.png')}}" class="img-fluid" alt="Badminton Court Layout"> 
@endsection

    