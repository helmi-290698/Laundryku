
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