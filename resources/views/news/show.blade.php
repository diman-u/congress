@extends('layouts.default', ['main_class' => 'theme-orange'])

@section('header-top')
    <a href="/">
        <img class="img-fluid img-mh60" src="/img/leader_logo.png" alt="">
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
        <li><a href="#">О премии</a></li>
        <li><a href="#">Кейсы</a></li>
        <li><a href="#">Номинации</a></li>
        <li><a href="#">Этапы отбора</a></li>
        <li><a href="#">Экспертный совет</a></li>
        <li><a href="#">Партнеры</a></li>
    </ul>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="heading heading--left">
                <h1>{{ $news->name }}</h1>

                <nav class="breadcrumb" aria-label="breadcrumb">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="/news">Новости</a></li>
                        <li><span aria-current="page">{{ $news->name }}</span></li>
                    </ul>
                </nav>
            </div>

            <div class="grid grid--sm-1 grid--lg-3 grid--lg-l66">
                <div class="grid__column">
                    <img class="img-fluid" src="/storage/{{ $news->image }}" alt="">
                </div>
                <div class="grid__column">
                    {!! $news->body !!}
                </div>
                <div class="grid__column">
                    @livewire('like-counter', ['entry' => $news])
                </div>
            </div>
        </div>
    </section>
@endsection
