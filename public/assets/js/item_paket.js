showItem();
function showItem() {
    $.ajax({
        type: 'GET', 
        url:url+'/item_laundry/show', 
        dataType: 'json',
        success: function (data) { 
           console.log(data);
        data.forEach(hasil => {
            $('#item').append('<option value="'+hasil.id+'">'+hasil.name_item+'</option>')
        });
        }
    });
}