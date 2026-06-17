@extends('frontend.layout.main1')
@push('title')
<title>Desan International | Cache-Management</title>
@endpush
@section('main-section1')
<section class="page-title" >
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Cache-Management</h1>
            <ul class="page-breadcrumb">
				<li><a href="{{route('home')}}">Home</a></li>
            </ul>
        </div>
    </div>
</section>
<div class="container py-40">
    <h1>Cache Management</h1>
    
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <a href="{{ route('clear-config-cache') }}" class="btn"><button>Clear Configuration Cache</button></a>
    <a href="{{ route('clear-route-cache') }}" class="btn"><button>Clear Route Cache</button></a>
    <a href="{{ route('clear-all-caches') }}" class="btn"><button>Clear All Caches</button></a>

</div>

@endsection


