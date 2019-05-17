$(document).ready(function(){
    $(document).on('click', '.showUpdateModal', function(){
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: url +'/update/' + id,
            type: 'GET',
            data: {
                "id": id,
                "_token": token,
                "errors": errors
            },
            success:function(data){
                $(".includeModal").html(data);
                $("#editModal").modal("show");
            },
        });
    })
    
    $(document).on('click', '#update', function(e){
        e.preventDefault();
        $.ajax({
            url : url,
            type: 'POST',
            data: $('form').serialize(),
            success:function(data){
                crud.table.ajax.reload();
                $("#editModal").modal("hide");
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

    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`#update`).trigger('click');
    }
})