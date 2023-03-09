
    $('#jenis_item').on('change',function () {
        let itempaket_id = $(this).val();
     
      
        $.ajax({ 
            type: 'GET', 
            url:url+'/item_laundry/find', 
            data: { id: itempaket_id }, 
            dataType: 'json',
            success: function (data) { 
                
                if (data.hitungan == "perkilo") {
                   $('#jenis_cucian').html(`<option value=' '>-- pilih --</option><option value='express'>Express</option><option value='oneday'>One day</option><option value='reguler'>Reguler</option>`);
                }else if (data.hitungan == "peritem") {
                    $('#jenis_cucian').html(`<option value=' '>-- pilih --</option><option value='express'>Express</option><option value='oneday'>One day</option><option value='reguler'>Reguler</option>`);
                }else if (data.hitungan == "permeter") {
                    $('#jenis_cucian').html(`<option value=' '>-- pilih --</option><option value='reguler'>Reguler</option>`);
                }
               
            },
            error:function () {
                $('#jenis_cucian').html(`<option value=' '>-- pilih --</option>`); 
            }
        });
    });

    $('#jenis_cucian').on('change',function () {
        let val = $(this).val();
        let itempaket_id = $('#jenis_item').val();
        $.ajax({ 
            type: 'GET', 
            url:url+'/laundry/findharga', 
            data: { 
                val: val,
                item_id :itempaket_id
            }, 
            dataType: 'json',
            success: function (data) { 
                if (val == 'reguler') {
                    $('#harga').val(data[0].harga_reguler);
                } else if(val == 'oneday'){
                    $('#harga').val(data[0].harga_oneday);
                }else if(val == 'express'){
                    $('#harga').val(data[0].harga_express);
                }
                
            }
        });
    });

    $('#jumlah_laundry').on('keyup change', function () {
        let harga = $('#harga').val()
        let jumlah = $(this).val()
        let hasil = harga*jumlah;
        $('#biaya_laundry').val(hasil)
        $('#total_biaya').val(hasil)
    })

    $('#diskon').on('keyup change',function () {
        // console.log('hai');
        let biaya_laundry = $('#biaya_laundry').val()
        let diskon = $(this).val()
        let hasil = biaya_laundry - diskon;
        $('#total_biaya').val(hasil)
    });

    $('#biaya_lainya').on('keyup change',function () {
        // console.log('hai');
        let biaya_laundry = parseFloat($('#biaya_laundry').val())
        let diskon = parseFloat($('#diskon').val())
        let biaya_lainya = parseFloat($(this).val())
        let hasil = biaya_laundry - diskon + biaya_lainya;
        $('#total_biaya').val(hasil)
    });

    $("#form_input_laundry").on("submit", function(e) {
    
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
            //    console.log(data);
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("input[name='"+prefix+"']").addClass("is-invalid");
                        $("span." + prefix + "_error").text(val[0]);
                        $("select[name='"+prefix+"']").addClass("is-invalid");
                        $("textarea[name='"+prefix+"']").addClass("is-invalid");
                    });
                } else {
                    
                    alert(data.message);
                    window.location.href = url+"/datalaundry";
                }
            },
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

$('select[name="tipelaundry_id"]').on('change',function () {
    let val = $(this).val();
    $.ajax({ 
        type: 'GET', 
        url:url+'/item_laundry/findbyidtipe', 
        data: { 
            id: val,
        }, 
        dataType: 'json',
        beforeSend:function () {
            $('select[name="item_id"]').html(' ')
        },
        success: function (data) {
            $('select[name="item_id"]').html('<option value=" ">-- pilih --</option>')
            $.each(data,function (i,val) {
                $('select[name="item_id"]').append(`<option value='`+val.id+`'>`+val.name_item+`</option>`);
            })
            
        }
    });
})
    $(document).on('click','.open_modal_status',function () {
        let id_laundry= $(this).val();
        $('#id_item').val(id_laundry);
        $('#modal_status').modal('show');
    })
    $(document).on('click','.open-modal-konsumen',function () {
        let consumen_id= $(this).data('id');
           $.ajax({
            url: url+"/consument/find/"+consumen_id,
            method: "get",
            processData: false,
            dataType: "json",
            contentType: false,
            success: function (data) {
                console.log(data);
             $('#code').val(data.code);
             $('#nama').val(data.name);
             $('#phone_number').val(data.phone_number);
             $('#email').val(data.email);
             $('#alamat').text(data.address)
          
               
            }
        });
        $('#modal_konsumen').modal('show');
    })

    $('#update-status-laundry').on("submit", function(e) {
    
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

    function deleteLaundry(data) {
    let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url+"/laundry/delete/"+data,
            method: "delete",
            data:{
                '_token': token
            },
            beforeSend:function(){
                return confirm("Are you sure?");
             },
            success: function (data) {
               alert(data.message);
                window.location.href = url+"/datalaundry";
               
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