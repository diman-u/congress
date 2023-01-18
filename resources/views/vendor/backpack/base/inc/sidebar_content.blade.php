<!-- Users, Roles, Permissions -->
@role('admin')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Auth</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Юзеры</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Роли</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Права</span></a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Services</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('entry_likes') }}"><i class="nav-icon la la-question"></i> Entry Likes </a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('expert_reviews') }}"><i class="nav-icon la la-question"></i> Expert Reviews </a></li>
    </ul>
</li>
@endrole

@role('admin|manager')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-trophy"></i> Премия</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('nomination') }}"><i class="nav-icon la la-list-ol"></i> Номинации</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('entry') }}"><i class="nav-icon la la-certificate"></i> Заявки</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-star-o"></i> Конгресс</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('programs') }}"><i class="nav-icon la la-calendar-o"></i> Программа</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('reviews') }}"><i class="nav-icon la la-comment"></i> Отзывы</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('quotes') }}"><i class="nav-icon la la-quote-left"></i> Цитаты</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-star-o"></i> Заказы</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('orders') }}"><i class="nav-icon la la-question"></i> Список </a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('order_status') }}"><i class="nav-icon la la-question"></i> Статусы </a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('services') }}"><i class="nav-icon la la-question"></i> Услуги </a></li>
    </ul>
</li>

    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('event') }}"><i class="nav-icon la la-dropbox"></i> Мероприятия </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('speakers') }}"><i class="nav-icon la la-group"></i> Лица отрасли</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('news') }}"><i class="nav-icon la la-newspaper-o"></i> News</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('pages') }}"><i class="nav-icon la la-question"></i> Pages</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('shows') }}"><i class="nav-icon la la-question"></i> Shows </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('partners') }}"><i class="nav-icon la la-question"></i> Partners </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('faqs') }}"><i class="nav-icon la la-question"></i> Faqs </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('gallery') }}"><i class="nav-icon la la-question"></i> Галереи </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('account') }}"><i class="nav-icon la la-question"></i> Account</a></li>
@endrole

@role('admin')
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Настройки</span></a></li>
@endrole