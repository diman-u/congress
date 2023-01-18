@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/moderate') }}" class="btn btn-sm btn-link"><i class="la la-envelope"></i> Возвратить</a>
@endif