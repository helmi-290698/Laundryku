$(document).on('click','.open-modal-status',function () {
    let pembayaran_id= $(this).data('id');
  
       $.ajax({
        url: url+"/pembayaran/find/"+pembayaran_id,
        method: "get",
        processData: false,
        dataType: "json",
        contentType: false,
        success: function (data) {
            $('#id_pembayaran').val(pembayaran_id)
            $("#status_select").find("option[value=" + data.status +"]").attr('selected', true);
        }
    });
   $('#modal_status').modal('show');
})

$('#update-status-pembayaran').on("submit", function(e) {
    
    e.preventDefault();
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
        beforeSend: function () {
            $(document).find("span.text-error").text("");
            $(".is-invalid").removeClass("is-invalid");
        },
        success: function (data) {
           
            if (data.status == 0) {
                $.each(data.error, function (prefix, val) {
                    $("input[name='"+prefix+"']").addClass("is-invalid");
                    $("span." + prefix + "_error").text(val[0]);
                    $("select[name='"+prefix+"']").addClass("is-invalid");
                });
            } else {
                
                alert(data.message);
                window.location.href = url+"/datalaundry";
            }
        },
    });
});