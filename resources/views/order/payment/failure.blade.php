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
            При оплате заказа № {{ $orderID }} произошла ошибка.
        </div>
    </section>
@endsection
