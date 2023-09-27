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
               <div class="input-group">
               <span class="input-group-text">Rp</span>
               <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" ><br>
               
               </div><span class="text-danger text-error harga_reguler_error"></span><br>
               <label for="harga_oneday" class="form-label" >Harga One Day</label>
               <div class="input-group">
               <span class="input-group-text">Rp</span>
               <input name="harga_oneday" type="number" class="form-control" id="harga_oneday" placeholder="0" min="0" ><br>
              
               </div>
               <span class="text-danger text-error harga_oneday_error"></span><br>
               <label for="harga_express" class="form-label">Harga Express</label>
               <div class="input-group">
               <span class="input-group-text">Rp</span>
               <input name="harga_express" type="number" class="form-control" id="harga_express" placeholder="0" min="0" ><br>
              
               </div>
               <span class="text-danger text-error harga_express_error"></span>
               <br>`);
                } else if (data.hitungan == "perkilo") {
                    $('#harga').html(`<label for="harga_reguler" class="form-label">Harga Reguler</label>
                    <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" ><br>
                    </div>
                    <span class="text-danger text-error harga_reguler_error"></span><br>
                    <label for="harga_oneday" class="form-label" >Harga One Day</label>
                    <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input name="harga_oneday" type="number" class="form-control" id="harga_oneday" placeholder="0" min="0" ><br>
                    
                    </div><span class="text-danger text-error harga_oneday_error"></span><br>
                    <label for="harga_express" class="form-label">Harga Express</label>
                    <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input name="harga_express" type="number" class="form-control" id="harga_express" placeholder="0" min="0" ><br>
                   
                    </div>
                    <span class="text-danger text-error harga_express_error"></span><br>`);
                }else if(data.hitungan == "permeter") {
                    $('#harga').html(`<label for="harga_reguler" class="form-label">Harga Reguler</label>
                    <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input name="harga_reguler" type="number" class="form-control" id="harga_reguler" placeholder="0" min="0" ><br>
                    </div><span class="text-danger text-error mb-3 harga_reguler_error"></span><br>`);
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
        beforeSend:function(){
            return confirm("Are you sure?");
         },
        success: function (data) {
           alert(data.message);
            window.location.href = url+"/item_paket";
           
        }
    });
}

$(document).on('click','.open_modal',function(){
    let itempaket_id= $(this).val();
    $.ajax({ 
        type: 'GET', 
        url:url+'/item_paket/find', 
        data: { id: itempaket_id }, 
        dataType: 'json',
        success: function (data) { 
            console.log(data);
            if (data[0].item.hitungan == "perkilo") {
                $('#modal-update-itempaket').modal('show');
                $('#itempaket_id').val(data[0].id);
                $('#id_item').val(data[0].item.id);
                $('#itempaket_select option[value="' + data[0].item.id +'"]').prop("selected", true);
                $('#harga_reguler').val(data[0].harga_reguler);
                $('#harga_oneday').val(data[0].harga_oneday);
                $('#harga_express').val(data[0].harga_express);
            }else if (data[0].item.hitungan == "peritem") {
                $('#modal-update-itempaket').modal('show');
                $('#itempaket_id').val(data[0].id);
                $('#id_item').val(data[0].item.id);
                $('#itempaket_select option[value="' + data[0].item.id +'"]').prop("selected", true);
                $('#harga_reguler').val(data[0].harga_reguler);
                $('#harga_oneday').val(data[0].harga_oneday);
                $('#harga_express').val(data[0].harga_express);
            }else if (data[0].item.hitungan == "permeter") {
                $('#modal-update-itempaket-permeter').modal('show');
                $('#itempaket_id_permeter').val(data[0].id);
                $('#id_item_permeter').val(data[0].item_id);
                $('#itempaket_select option[value="' + data[0].item.id +'"]').prop("selected", true);
                $('#harga_reguler_permeter').val(data[0].harga_reguler);
                
            }
           
        }
    });
});


//ubah-paket-item//

$('.update-item-paket').on("submit", function(e) {
    
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
           console.log(data);
            if (data.status == 0) {
                $.each(data.error, function (prefix, val) {
                    $("input[name='"+prefix+"']").addClass("is-invalid");
                    $("span." + prefix + "_error").text(val[0]);
                    console.log(prefix);
                });
            } else {
                
                alert(data.message);
                window.location.href = url+"/item_paket";
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
   

   
