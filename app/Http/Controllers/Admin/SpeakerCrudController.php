<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpeakersRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SpeakersCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SpeakerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Speaker::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/speakers');
        CRUD::setEntityNameStrings('лицо отрасли', 'лица отрасли');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('fio');

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
        CRUD::setValidation(SpeakersRequest::class);

        $this->crud->addFields([
            [
                'label' => 'ФИО',
                'name' => 'fio',
            ],
            [
                'name' => 'image',
                'label' => 'Картинка',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public',
            ],
            [
                'name'  => 'position',
                'label' => 'Должность',
                'type'  => 'textarea',
            ],
            [
                'name'  => 'body',
                'label' => 'Описание',
                'type'  => 'summernote',
                'options' => [
                    'minheight' => 100,
                    'height' => 100
                ]
            ],
            [
                'label'     => 'Программы',
                'type'      => 'select_multiple',
                'name'      => 'program',
                'entity'    => 'program', // the method that defines the relationship in your Model
                'model'     => 'App\Models\Program', // foreign key model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'pivot'     => true,
                'options'   => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                })
            ],
            [
                'label'     => 'Спикер на мероприятиях',
                'type'      => 'select_multiple',
                'name'      => 'events',
                'options'   => (function ($query) {
                    return $query->orderBy('id', 'DESC')->get();
                })
            ],
            [
                'label'     => 'Эксперт на мероприятиях',
                'type'      => 'select_multiple',
                'name'      => 'eventsExpertAssigned',
                'options'   => (function ($query) {
                    return $query->orderBy('id', 'DESC')->get();
                })
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
}
