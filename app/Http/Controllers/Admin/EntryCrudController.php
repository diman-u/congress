<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EntryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EntryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\ReviseOperation\ReviseOperation;
    use \App\Http\Controllers\Admin\CustomOperations\ModerateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Entry::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/entry');
        CRUD::setEntityNameStrings('заявка', 'заявки');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'title', 
            'label' => 'Название',
        ]);
        CRUD::addColumn([
            'name' => 'status', 
            'label' => 'Статус',
            'type' => 'select_from_array',
            'options' => \App\Models\Entry::listReadableStatus()
        ]);
        CRUD::addColumn([
            'name' => 'organization', 
            'label' => 'Организация',
        ]);
        CRUD::addColumn([
            'name' => 'created_at', 
            'label' => 'Дата добавления'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EntryRequest::class);

        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => 'Заголовок',
                'tab' => 'Основное',
            ],
            [
                'label'     => 'Номинация',
                'type'      => 'select',
                'name'      => 'nomination_id',
                'entity'    => 'nomination',
                'model'     => "App\Models\Nomination", 
                'attribute' => 'title',
                'pivot'     => true,
                'options'   => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                }),
                'tab' => 'Основное',
            ],
            [
                'name'  => 'full_title',
                'label' => 'Полное название',
                'tab' => 'Основное',
            ],
            [
                'name'  => 'description',
                'label' => 'Краткое тезисное описание',
                'tab' => 'Основное',
            ],
            [
                'name'  => 'body',
                'label' => 'Полное описание',
                'attributes' => [
                    'style' => 'height:300px'
                ],
                'tab' => 'Основное',
            ],
            [
                'name'  => 'organization',
                'label' => 'Организация',
                'wrapper' => ['class' => 'form-group col-md-6'],
                'tab' => 'Основное',
            ],
            [
                'name'  => 'link',
                'label' => 'Адрес сайта',
                'type'  => 'url',
                'wrapper' => ['class' => 'form-group col-md-6'],
                'tab' => 'Основное',
            ],

            [
                'name'  => 'status',
                'label' => 'Статус',
                'type' => 'select_from_array',
                'options' => \App\Models\Entry::listReadableStatus(),
                'allows_null' => false,
                'default' => \App\Models\Entry::STATUS_DRAFT,
                'tab' => 'Системные',
            ],
            [ 
                'label'     => 'Мероприятие',
                'type'      => 'select',
                'name'      => 'event_id',
                'entity'    => 'event',
                'model'     => "App\Models\Event", 
                'attribute' => 'title',
                'tab' => 'Системные',
            ],
            [
                'name'  => 'place',
                'label' => 'Занятое место',
                'tab' => 'Системные',
            ],
            [
                'name'      => 'image',
                'label'     => 'Изображение для обложки',
                'type'      => 'upload',
                'upload'    => true,
                'disk'      => 'public',
                'tab' => 'Вложения',
            ],
            [
                'name'      => 'files',
                'label'     => 'Материалы и иллюстрации',
                'type'      => 'upload_multiple',
                'upload'    => true,
                'tab' => 'Вложения',
            ],

            [
                'name' => 'entry-members',
                'type' => 'view',
                'view' => 'crud::partials/entry-members',
                'tab' => 'Участники',
            ]
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupModerateOperation()
    {   
        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => 'Название заявки',
                'default' => $this->crud->getCurrentEntry()->title,
                'attributes' => [
                    'readonly' => 'readonly',
                    'disabled' => 'disabled',
                ]
            ],
            [
                'name' => 'note',
                'label' => 'Сообщение пользователю',
                'hint' => 'Текст будет отправлен в письме на адрес пользователя добавшего заявку',
                'type' => 'summernote',
                'validationRules' => 'required|min:5',
                'options' => [
                    'height' => '300px'
                ],
            ],
            [
                'name' => 'previous-notes',
                'type' => 'view',
                'view' => 'crud::partials/previous-notes'
            ]
        ]);

        $this->crud->addSaveAction([
            'name' => 'moderate',
            'redirect' => function ($crud, $request, $itemId) {
                return $crud->route;
            },
            'button_text' => 'Вернуть на доработку',
        ]);
    }
}
