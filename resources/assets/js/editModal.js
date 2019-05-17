$(document).ready(function(){
    $(document).on('click', '.showUpdateModal', function(){
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: url +'/'+ id + '/edit',
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
    
    

    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`#update`).trigger('click');
    }
})