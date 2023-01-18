<h1>{{ $entry->full_title }}</h1>

@if(!empty($entry->nomination))
<h4>Проект в номинациях</h4>
<ul>
    <li>{{ $entry->nomination->title }}</li>
</ul>
@endif

<h4>Организация</h4>
<p>{{ $entry->organization }}</p>

@if(!empty($entry->members))
<h4>Участники проекта</h4>
    @foreach($entry->members as $member)
        <p>{{ $member->name }}</p>
        <p>{{ $member->position }}</p>
        <p>{{ $member->city }}</p>
    @endforeach
@endif

<p>{{ $entry->description }}</p>

<h4>Описание проекта</h4>
<p>{{ $entry->body }}</p>
