<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogTypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogTypeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\BlogType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog_type');
        CRUD::setEntityNameStrings('blog type', 'blog types');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/5.x/crud-operation-list
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'type_name',
            'label' => 'Type Name',
            'type' => 'text',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/5.x/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BlogTypeRequest::class);

        CRUD::addField([
            'name' => 'type_name',
            'label' => 'Type Name',
            'type' => 'text',
        ]);
    }


    
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/5.x/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/5.x/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'name' => 'type_name',
            'label' => 'Type Name',
            'type' => 'text',
        ]);
    }
}
