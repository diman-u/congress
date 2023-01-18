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
                <h1>{{ $entry->title }}</h1>

                <nav class="breadcrumb" aria-label="breadcrumb">
                    <ul>
                        <li><a href="#">О премии</a></li>
                        <li><a href="#">Каталог кейсов и решений</a></li>
                        <li><span aria-current="page">{{ $entry->title }}</span></li>
                    </ul>
                </nav>
            </div>

            <div class="grid grid--sm-1 grid--md-2 grid--lg-3 grid--lg-f66">
                <div class="grid__column">

                    <h2 class="mb-3">{{ $entry->full_title }}</h2>

                    <div class="mt-4 mb-4 text-small">
                        <h4 class="color-red">Участники проекта</h4>
                        <p class="mb-1 text-700">{{ $entry->organization }}</p>
                        <p class="color-red text-300">{{ $entry->members()->pluck('name')->implode(', ') }}</p>
                    </div>


                    <p>{{ $entry->description }}</p>

                    <h3>Описание проекта</h3>
                    <p>Презентационный ролик проекта: https://youtu.be/uMVMujvZon8<br>
                    {{ $entry->body }}
                </div>
                <div class="grid__column">
                    <div class="toolbar">
                        <div class="toolbar__row">
                            <a href="/entry/pdf/{{ $entry->id }}" target="_blank" class="btn btn--block">
                                <i class="fa-regular fa-file-pdf"></i>
                                Скачать PDF
                            </a>
                            <a href="#" class="btn btn--block"><i class="fa-solid fa-print"></i> Печатать</a>
                        </div>
                        <div class="toolbar__row">
                            <button type="button" class="btn btn--block btn--blue">
                                <i class="fa-regular fa-thumbs-up"></i>
                                Голосовать
                                <span class="badge badge--white">19311</span>
                            </button>
                        </div>
                    </div>

                    @if(!empty($entry->nomination))
                        <div class="nomination">
                            <div class="nomination__icon">
                                <img src="https://leader.orgzdrav.com/storage/app/uploads/public/615/b02/e14/615b02e147be8837261567.png" alt="">
                            </div>
                            <div class="nomination__body">
                                <p class="text-small">Проект в номинации</p>
                                <div class="nomination__title">{{ $entry->nomination->title }}</div>
                                <p>{{ $entry->nomination->body }}</p>
                            </div>
                        </div>
                    @endif

                    <h3>Организация</h3>
                    <p>{{ $entry->organization }}</p>
                    <p><a href="{{ $entry->link }}" target="_blank">Перейти на сайт</a></p>

                    <h3>Участники проекта</h3>
                    @foreach($entry->members as $member)
                        <div class="nomination">
                            @if (count($member->getMedia('image')))
                            <div class="nomination__icon">
                                {{ $member->getMedia('image')[0]->img()->attributes(['class' => 'img-fluid']) }}
                            </div>
                            @endif
                            <div class="nomination__body">
                                @if ($loop->first)
                                <p class="text-small">Руководитель проекта</p>
                                @endif
                                <div class="nomination__title">{{ $member->name }}</div>
                                <p class="text-small">{{ $member->position }}</p>
                                <p>{{ $member->city }}</p>
                            </div>
                        </div>
                    @endforeach

                    <h3>Материалы</h3>

                    <div class="file-list">
                        @foreach ($entry->getMedia('files') as $file)
                            <a class="file-list__item" href="{{ $file->getFullUrl() }}">
                                <i class="fa-regular fa-file-lines"></i>
                                <span>
                                    <strong>{{ $file->name }}</strong>
                                    <br>
                                    <small>{{ $file->human_readable_size }}</small>
                                </span>
                            </a>
                        @endforeach
                    </div>

                    <h3>Поделиться</h3>

                </div>
            </div>

        </div>
    </section>
@endsection