<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #605ca8">
                <h3 style="color: #fff"> Create  </h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display: none"></div>
                <div class="row m-t-20">
                    <div class="{{ $crud->getCreateContentClass() }}">
                        <!-- Default box -->

                        @include('crud::inc.grouped_errors')

                          <form method="post"
                                action="{{ url($crud->route) }}"
                                @if ($crud->hasUploadFields('create'))
                                enctype="multipart/form-data"
                                @endif
                                >
                          {!! csrf_field() !!}
                          <div class="col-md-12">

                            <div class="row display-flex-wrap">
                              <!-- load the view from the application if it exists, otherwise load the one in the package -->
                              @if(view()->exists('vendor.backpack.crud.form_content'))
                                @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                              @else
                                @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                              @endif
                            </div><!-- /.box-body -->
                            <div class="">

                                <button type="submit" class = "btn btn-md btn-primary" id="store">
                                    <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    Submit</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-ban"></span> &nbsp;Close</button>
                            </div><!-- /.box-footer-->

                          </div><!-- /.box -->
                          </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

