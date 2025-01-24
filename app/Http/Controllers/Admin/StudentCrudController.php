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

         // Add dropdown for gender
         CRUD::addField([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'select_from_array',
            'options' => [
                'male' => 'Male',
                'female' => 'Female',
                'rather_not_to_say' => 'Rather not say',
            ],
            'allows_null' => false, // Set to true if you want to allow no selection
            'default' => 'male', // Default value for the field
        ]);

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
    

    /**
     * The update method automatically handles password encryption.
     */
    // No need to override update method, Backpack does it automatically
}
