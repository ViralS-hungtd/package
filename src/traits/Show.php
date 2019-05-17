<?php

namespace MyVendor\MyPackage\Traits;

use Backpack\CRUD\CrudPanel;

trait Show
{
    public function create()
    {
        $saveAction = session('save_action', config('backpack.crud.default_save_action', 'save_and_back'));
        $crud = $this->crud;
        return view('myvendor::modal.modal_create', compact('crud', 'saveAction'));
    }

    public function edit($id)
    {
        $saveAction = session('save_action', config('backpack.crud.default_save_action', 'save_and_back'));
        $crud = $this->crud;
        $entry = $this->crud->getEntry($id);
        $fields = $this->crud->getUpdateFields($id);
        return view('myvendor::modal.modal_edit', compact('crud', 'entry', 'fields', 'saveAction'));
    }
}