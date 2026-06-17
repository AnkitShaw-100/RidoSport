@extends('frontend.layout.main1')

@section('main-section1')
    <h1>{{ $pageTitle }}</h1>
    <p>Service details: {{ $service->description }}</p>

    @if($service->subservices->count() > 0)
        <h2>Sub-Services</h2>
        <ul>
            @foreach($service->subservices as $subservice)
                <li>
                    <a href="{{ route('subservice.show', [$service->slug, $subservice->slug]) }}">
                        {{ $subservice->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
