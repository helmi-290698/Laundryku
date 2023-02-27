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
                    console.log(val[0]);
                });
            } else {
                window.location.href = url+"/item_paket";
            }
        },
    });
});