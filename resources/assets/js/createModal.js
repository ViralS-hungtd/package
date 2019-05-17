$(document).ready(function(){
    $(document).on('click', '#showCreateModal', function(){
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: url +'/create',
            type: 'GET',
            data: {
                "id": id,
                "_token": token,
                "errors": errors,
            },
            success:function(data){
                $(".includeModal").html(data);
                $("#create").modal("show");
            },
        });
    })
    $(document).on('click', '#store', function(e){
        e.preventDefault();
        $.ajax({
            url : url,
            type: 'POST',
            data: $('form').serialize(),
            success:function(data){
                crud.table.ajax.reload();
                $("#create").modal("hide");
                $(".alert-success").html("");
                $(".alert-success").show();
                $(".alert-success").append('<span>Create item success</span>');
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

    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`#store`).trigger('click');
    }
})