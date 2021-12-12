@extends('layouts.main')

@section('content')
    <section class="section">


    @if($currentWorkspace)
     
    @else
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        {{ __('Page Not Found') }}
                    </div>
                    <div class="page-search">
                        <p class="text-muted mt-3">{{ __('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')}}</p>
                        <div class="mt-3">
                            <a class="btn btn-info mt-3" href="{{route('home')}}"><i class="mdi mdi-reply"></i> {{ __('Return Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </section>
<!-- container -->
@endsection