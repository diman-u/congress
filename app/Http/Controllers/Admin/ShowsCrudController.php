<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShowsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ShowsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ShowsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Shows::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/shows');
        CRUD::setEntityNameStrings('shows', 'shows');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        CRUD::column('published');
        CRUD::column('name');
//        CRUD::column('slogan');
//        CRUD::column('description');
//        CRUD::column('phone');
//        CRUD::column('email');
//        CRUD::column('image');
//        CRUD::column('logo');
//        CRUD::column('modal');
//        CRUD::column('created_at');
//        CRUD::column('updated_at');

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
        CRUD::setValidation(ShowsRequest::class);

        CRUD::field('published');
        CRUD::field('name');
        CRUD::field('slogan');
        $this->crud->addFields([
            [
                'name'  => 'description',
                'label' => 'Описание',
                'type'  => 'summernote',
                'options' => [
                    'minheight' => 100,
                    'height' => 100
                ]
            ]
        ]);
        CRUD::field('phone');
        CRUD::field('email')->type('email');
        CRUD::field('image');
        $this->crud->addFields([
            [
                'name' => 'image',
                'label' => 'Картинка',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public',
            ],
            [
                'name' => 'logo',
                'label' => 'Лого',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public',
            ]
        ]);
        CRUD::field('modal');

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
