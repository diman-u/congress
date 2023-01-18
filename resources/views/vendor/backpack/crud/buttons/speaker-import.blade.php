@if ($crud->hasAccess('update'))
  <a href="{{ url($crud->route.'/'.$entry->getKey().'/speaker-import') }}" class="btn btn-sm btn-link text-capitalize"><i class="la la-question"></i> Импортировать</a>
@endif