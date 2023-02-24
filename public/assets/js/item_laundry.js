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