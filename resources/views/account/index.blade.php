@extends('layouts.account')

@section('content')
<section>
    <div class="container">
        @if (session()->has('message'))
            <p class="message message--success">
                {{ session('message') }}
            </p>
        @endif
        
        @if (session()->has('error'))
            <p class="message message--danger">
                {{ session('error') }}
            </p>
        @endif

        <div class="grid grid--sm-1 grid--lg-3 grid--lg-f66">
            <div class="grid__column">
                <x-account.user-entries />
                
                <x-account.user-orders />
            </div>
            <div class="grid__column">
                
            </div>
        </div>
    </div>
</section>
@endsection