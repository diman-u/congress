@extends('layouts.default')

@section('content')
    @include('section.front.path')
    @include('section.front.news')
    @include('section.front.audience')
    @include('section.front.about')

    {{-- @include('section.front.gallery')
    @include('section.front.partners')
    @include('section.front.nominations')
    @include('section.front.entry')
    @include('section.front.program')
    @include('section.front.speakers') --}}
@endsection