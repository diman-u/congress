@extends('layouts.auth', ['main_class' => 'central-point'])

@section('content')
<section>
    <div class="container container--sm">
        <div class="card theme-dark text-center">
            <img class="img-mh60" src="/img/leader_logo.png" alt="">
        </div>

        <div class="card">
            <div class="card__content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">  
                            <input type="email" name="email" :value="old('email')" required autofocus />
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Пароль</label>
                        <div class="control">  
                            <input type="password" name="password" required autocomplete="current-password" />
                        </div>
                    </div>
                    
                    <div class="field">
                        <div class="checkbox">  
                            <input type="checkbox" name="remember" />
                            <label class="label">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--big btn--block">Войти</button>
                </form>
            </div>
            <div class="card__footer">
                <hr>
                <p class="help"><a href="{{ route('password.request') }}">Забыли пароль?</a></p>
                <p class="help">Если вы впервые на сайте, заполните, пожалуйста, <a href="{{ route('register') }}">регистрационную форму</a>.</p>
            </div>
        </div>
        
        <p class="text-center">&copy; {{ date('Y') }} | <a class="color-inherit" href="https://www.vshouz.ru" target="_blank">ООО ВШОУЗ-КМК</a></p>
    </div>
</section>
@endsection