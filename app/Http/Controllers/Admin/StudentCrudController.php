<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();
        CRUD::removeColumn('password'); // Don't show the password in the list view
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);
        CRUD::setFromDb();

        CRUD::addField([
            'name' => 'password',
            'label' => 'Password',
            'type' => 'password',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation(); // Reuse the create operation setup
    }

    /**
     * Store the created student.
     * Encrypt the password before saving.
     */
    public function store()
    {
        // Encrypt password before saving to the database
        $this->crud->setRequest($this->crud->getRequest()->merge([
            'password' => bcrypt($this->crud->getRequest()->input('password'))
        ]));

        return parent::store();
    }

    /**
     * The update method automatically handles password encryption.
     */
    // No need to override update method, Backpack does it automatically
}
