<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #605ca8">
                <h3 style="color: #fff"> Edit Information </h3>

            </div>
                <div class="row m-t-20">
                  
                    <div class="{{ $crud->getEditContentClass() }}">
                        <!-- Default box -->

                        @include('crud::inc.grouped_errors')
                        <div class="alert alert-danger" style="display: none"></div>
                          <form method="post"
                                action="{{ url($crud->route.'/'.$entry->getKey()) }}"
                                @if ($crud->hasUploadFields('update', $entry->getKey()))
                                enctype="multipart/form-data"
                                @endif
                                >
                          {!! csrf_field() !!}
                          {!! method_field('PUT') !!}
                          <div class="col-md-12">
                            @if ($crud->model->translationEnabled())
                            <div class="row m-b-10">
                                <!-- Single button -->
                                <div class="btn-group pull-right">
                                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                        <li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
                                    @endforeach
                                  </ul>
                                </div>
                            </div>
                            @endif
                            <div class="row display-flex-wrap">
                              <!-- load the view from the application if it exists, otherwise load the one in the package -->
                              @if(view()->exists('vendor.backpack.crud.form_content'))
                                @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                              @else
                                @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                              @endif
                            </div><!-- /.box-body -->

                            <div class="">

                                <button type="submit" class = "btn btn-md btn-primary" id="update">
                                    <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    Submit</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-ban"></span> &nbsp;Close</button>
                            </div><!-- /.box-footer-->
                          </div><!-- /.box -->
                          </form>
                    </div>
                </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#update', function(e){
        console.log('1');
        e.preventDefault();
        $.ajax({
            url : ' {{ url($crud->route.'/'.$entry->getKey()) }} ',
            type: 'POST',
            data: $('form').serialize(),
            success: function(data){
                crud.table.ajax.reload();
                $("#editModal").modal("hide");
                $(".alert-success").html("");
                $(".alert-success").show();
                $(".alert-success").append('<span>Update item success</span>');
                $(".alert-success").hide(2000);
            },
            error: function(jqXhr, json, errorThrown){
                var errors = jqXhr.responseJSON.errors;
                if(errors)
                {
                    $('.alert-danger').html('');
                    $.each(errors, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>'+value+'</li>');
                    });
                }
            }
        })
    })
</script>