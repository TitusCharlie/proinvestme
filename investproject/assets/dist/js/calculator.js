// Get the modal
var modal = document.getElementById("calcModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

$("#calcForm").submit(function(e) {
    e.preventDefault();
    
    //Remove error fields
    $('.form-control').removeClass('inputTxtError');
    $(".error").html('');

    //Form Data
    var actionurl = e.currentTarget.action;
    $.ajax({
            url: actionurl,
            type: 'post',
            data: $("#calcForm").serialize(),
            success: function(data) {
                var content = JSON.parse(data);
                $("input[name="+content.csrfTokenName+"]").val(content.csrfHash);
                if(content.success == false){
                    $.each(content.errors, function(key, value){
                        var msg = value;
                        $('input[name="' + key + '"], select[name="' + key + '"]').addClass('inputTxtError');
                        $('#' + key + 'error').html(msg);
                    });
                } else {
                    var modal = document.getElementById("calcModal");
                    modal.style.display = "block";

                    $.each(content.plan_info, function(key, value){
                        $('#' + key).html(value);
                    })
                }
            },
            error: function(data) {}
    });
    
});