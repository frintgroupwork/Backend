<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogCrudController
 * @package App\Http\Controllers\Admin
 */
class BlogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog');
        CRUD::setEntityNameStrings('blog', 'blogs');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);

        CRUD::addColumn([
            'name' => 'blog_type_id',
            'label' => 'Blog Type',
            'type' => 'select',
            'entity' => 'blogType',
            'attribute' => 'type_name',
            'model' => \App\Models\BlogType::class,
        ]);

        CRUD::addColumn([
            'name' => 'source',
            'label' => 'Source',
            'type' => 'url', // Ensures it is displayed as a clickable link in the list
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BlogRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);

        CRUD::addField([
            'name' => 'blog_type_id',
            'label' => 'Blog Type',
            'type' => 'select',
            'entity' => 'blogType',
            'attribute' => 'type_name',
            'model' => \App\Models\BlogType::class,
        ]);

        CRUD::addField([
            'name' => 'source',
            'label' => 'Source',
            'type' => 'url', // Input field to add a URL
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
