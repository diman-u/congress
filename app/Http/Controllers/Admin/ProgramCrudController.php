<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProgramsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProgramsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProgramCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Program::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/programs');
        CRUD::setEntityNameStrings('program', 'programs');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');

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
        CRUD::setValidation(ProgramsRequest::class);

        CRUD::field('date')->type('date');
        CRUD::field('time')->type('time');
        CRUD::field('time_end')->type('time');
        CRUD::field('title');
        CRUD::field('info');
        $this->crud->addFields([
            [
                'name'  => 'header',
                'label' => 'header',
                'type'  => 'summernote',
                'options' => [
                    'minheight' => 100,
                    'height' => 100
                ]
            ],
        ]);
        CRUD::field('moderators');

        $this->crud->addFields([
            [
                'label'     => 'Speakers',
                'type'      => 'select_multiple',
                'name'      => 'speaker',
                'entity'    => 'speaker',
                'model'     => 'App\Models\Speaker',
                'attribute' => 'fio',
                'pivot'     => true,
                'options'   => (function ($query) {
                    return $query->orderBy('fio', 'ASC')->get();
                })
            ],
            [
                'name'  => 'text',
                'label' => 'text',
                'type'  => 'summernote',
                'options' => [
                    'minheight' => 100,
                    'height' => 100
                ]
            ],
        ]);
        $this->crud->addFields([
            [
                'name'  => 'summary',
                'label' => 'summary',
                'type'  => 'summernote',
                'options' => [
                    'minheight' => 100,
                    'height' => 100
                ]
            ],
        ]);
        CRUD::field('video_id');
        $this->crud->addFields([
            [
                'name'      => 'files',
                'label'     => 'Файлы',
                'type'      => 'upload_multiple',
                'upload'    => true,
                'disk'      => 'public'
            ],
        ]);
        CRUD::field('preview');
        CRUD::field('is_payed');

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
