@if ($crud->hasAccess('update'))
    <button data-style="zoom-in" data-toggle="modal" class="btn btn-xs btn-default showUpdateModal" data-id ={{ $entry->getKey() }}><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('backpack::crud.edit') }} {{ $crud->entity_name }}</span></button>
@endif

