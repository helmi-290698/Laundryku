$("#form-setting").on("submit", function(e) {
    
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
                    $("textarea[name='"+prefix+"']").addClass("is-invalid");
                    $("span." + prefix + "_error").text(val[0]);
           
                });
            } else {
                
                alert(data.message);
                window.location.href = url+"/setting";
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