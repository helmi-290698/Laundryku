$(document).on('click','.open_modal',function(){
    let item_id= $(this).val();
    $('#id_item').val(item_id);
     $('#staticBackdrop').modal('show');
    $.ajax({ 
        type: 'GET', 
        url:url+'/item_laundry/find', 
        data: { id: item_id }, 
        dataType: 'json',
        success: function (data) { 
            $('#nama_item').val(data.name_item);
            $('#hitungan_select option[value="' + data.hitungan +'"]').prop("selected", true);
        
        }
    });
});

showdatatipe()

function showdatatipe() {
    $.ajax({
        url: url+"/tipelaundry/show",
        method: "get",
        processData: false,
        dataType: "json",
        contentType: false,
        success: function (data) {
          $.each(data,function (i,val) {
            $('select[name="tipelaundry_id"]').append(`<option value='`+val.id+`'>`+val.name_tipe+`</option>`)
          })
           
        }
    });
}

$("#form-tambah-item-laundry").on("submit", function(e) {
    
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
                    $("select[name='"+prefix+"']").addClass("is-invalid");
                    $("span." + prefix + "_error").text(val[0]);
           
                });
            } else {
                
                alert(data.message);
                window.location.href = url+"/item_laundry";
            }
        },
    });
});


function alert(data) {
    Toastify({
        text: data ,
        className: "info",
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        }
      }).showToast();
}
