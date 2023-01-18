@extends('layouts.default')

@section('header-top')
    <a href="/">
        <img class="img-fluid img-mh60" src="https://leader.orgzdrav.com/images/orgzdrav2022b.png" alt="">
    </a>
    
    <ul class="inline-menu hide--md">
        <li><a href="#">Новости</a></li>
        <li><a href="#">Архив</a></li>
        <li><a href="#">Фото</a></li>
        <li><a href="#">Контакты</a></li>
    </ul>
@endsection

@section('header-nav')
    <ul>
        <li><a href="#">Условия участия</a></li>
        <li><a href="#">Программа</a></li>
        <li><a href="#">Докладчики</a></li>
        <li><a href="#">Премия «Оргздрав»</a></li>
        <li><a href="#">Подать тезис</a></li>
        <li><a href="#">Выставка</a></li>
        <li><a href="#">Спонсоры</a></li>
        <li><a href="#">Для СМИ</a></li>
    </ul>
@endsection

@section('content')
    @include('section.orgzdrav.hero')
    @include('section.orgzdrav.about')
    @include('section.orgzdrav.theme')
    @include('section.orgzdrav.tracks')
    @include('section.orgzdrav.program')
    @include('section.orgzdrav.congress')
    @include('section.orgzdrav.speakers')
    @include('section.orgzdrav.partners')
    @include('section.orgzdrav.request')
@endsection