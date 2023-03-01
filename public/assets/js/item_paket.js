showItem();
function showItem() {
    $.ajax({
        type: 'GET', 
        url:url+'/item_laundry/show', 
        dataType: 'json',
        success: function (data) { 
        data.forEach(hasil => {
            $('#item').append('<option value="'+hasil.id+'">'+hasil.name_item+'</option>')
        });
        }
    });

}
changeItem();
function changeItem() {
    $('#item').on('change',function () {
        let id_item = $(this).find(':selected').val();
        $.ajax({ 
            type: 'GET', 
            url:url+'/item_laundry/find', 
            data: { id: id_item }, 
            dataType: 'json',
            success: function (data) { 
              if (data.hitungan == "peritem") {
               $('#harga').html(`<label for="harga_reguler" class="form-label">Harga Reguler</label>
               <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" >
               <span class="text-danger text-error harga_reguler_error"></span><br>
               <label for="harga_oneday" class="form-label" >Harga One Day</label>
               <input name="harga_oneday" type="number" class="form-control" id="harga_oneday" placeholder="0" min="0" >
               <span class="text-danger text-error harga_oneday_error"></span><br>
               <label for="harga_express" class="form-label">Harga Express</label>
               <input name="harga_express" type="number" class="form-control" id="harga_express" placeholder="0" min="0" >
               <span class="text-danger text-error harga_express_error"></span><br>`);
                } else if (data.hitungan == "perkilo") {
                    $('#harga').html(`<label for="harga_reguler" class="form-label">Harga Reguler</label>
               <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" >
               <span class="text-danger text-error harga_reguler_error"></span><br>
               <label for="harga_oneday" class="form-label">Harga One Day</label>
               <input name="harga_oneday" type="number" class="form-control" id="harga_oneday" placeholder="0" min="0" >
               <span class="text-danger text-error harga_oneday_error"></span><br>
               <label for="harga_express" class="form-label">Harga Express</label>
               <input name="harga_express" type="number" class="form-control" id="harga_express" placeholder="0" min="0" >
               <span class="text-danger text-error harga_express_error"></span><br>`);
                }else if(data.hitungan == "permeter") {
                    $('#harga').html(`<label for="harga_reguler" class="form-label">Harga Reguler</label>
                    <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" >
                    <span class="text-danger text-error harga_reguler_error"></span><br>`);
                }
            
            }
        });
    })

}

$("#form-tambah-item-paket").on("submit", function(e) {
    
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
                    
                });
            } else {
                
                alert(data.message);
                window.location.href = url+"/item_paket";
            }
        },
    });
});


function deleteItempaket(data) {
    let token = $("input[name='_token']").val();
    // let id = $("input[name='id_item_paket']").val();
    let method = $("input[name='_method']").val();
    $.ajax({
        url: url+"/item_paket/delete/"+data,
        method: "delete",
        data: {
            '_token':token,
        },
        success: function (data) {
           alert(data.message);
            window.location.href = url+"/item_paket";
           
        }
    });
}
 
function alert(data) {
    Toastify({
        text: data ,
        className: "info",
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        }
      }).showToast();
}
   

   
