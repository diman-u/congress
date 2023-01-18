
@extends('layouts.dashboard')

@section('content')
<section>
    <div class="container">
        <div class="heading heading--left">
            <h3>Заявка на участие в Премии</h3>
        </div>

        <form method="POST" action="{{ route('account.entry.store') }}">
            @csrf

            <div class="grid grid--sm-1 grid--md-2 grid--lg-3 grid--lg-f66">
                <div class="grid__column">
                    @include('account.entry.form')
                </div>
                <div class="grid__column">
                    @include('account.entry.form-authors')
                </div>
            </div>
            

            <div class="card">
                <button type="button" class="btn btn--sm-block">Сохранить</button>
                <a class="btn btn--sm-block btn--blue" href="{{ route('account') }}">Отмена</a>
                <button type="button" class="btn btn--sm-block btn--red" disabled>Отправить</button>
            </div>

            <div class="message">Вы можете в любой момент вернуться к заполнению формы перед её отправкой на модерацию</div>
        </form>
    </div>
</section>
@endsection