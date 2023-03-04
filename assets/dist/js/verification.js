$(document).ready(function () {
    $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer',
                error:   'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })

        $(".iddoc").click(function() {
            $('.iddoc').not(this).prop("checked", false);
            $('.wid').hide(400);
        });

        $("#idimg").change(function(){
            $('.wimgd').hide(400);
        });

        $("#addressimg").change(function(){
            $('.wiadd').hide(400);
        });

        $(".addressdoc").click(function() {
            $('.addressdoc').not(this).prop("checked", false);
            $('.wad').hide(400);
        });

    //    Le compteur d'étapes
        var count = 0;
        $('.counter span').text(count);

        //Section 1
        $(document).on('click', '#to-q-2', function (e) {
            e.preventDefault();
            $('.question1').removeClass('in-view').addClass('up');
            $('.question2').removeClass('down').addClass('in-view');
            $(this).attr("id", "to-q-3");
            $('#back-to-q-1').show();
            $('#new-form').css('background-position', '25% -41%');
            count = 1;
            $('.counter span').text(count);
        })

        $(document).on('click', '#back-to-q-1', function (e) {
            e.preventDefault();
            $('.question1').removeClass('up').addClass('in-view');
            $('.question2').removeClass('in-view').addClass('down');
            $('#to-q-3').attr("id", "to-q-2");
            $('#back-to-q-2').hide();
            $('#new-form').css('background-position', '25% -41%');
            count2 = 0; 
            $('.counter span').text(count2);
        })
    
        //    La question 1 (gender)
        $(document).on('click', '#to-q-3', function (e) {
            e.preventDefault();
            var val = $('input[name="identification_doc"]:checked').val();

            if(val == null){
                $('.wid').show(400);
            } else {
                $('.question2').removeClass('in-view').addClass('up');
                $('.question3').removeClass('down').addClass('in-view');
                $(this).attr("id", "to-q-4");
                $('#back-to-q-1').attr("id", "back-to-q-2");
                $('#new-form').css('background-position', '25% -41%');
                count2 = 2;
                $('.counter span').text(count2);
            }
        })

        $(document).on('click', '#back-to-q-2', function (e) {
            e.preventDefault();
            $('.question2').removeClass('up').addClass('in-view');
            $('.question3').removeClass('in-view').addClass('down');
            $('#to-q-4').attr("id", "to-q-3");
            $('#back-to-q-2').attr("id", "back-to-q-1");
            $('#new-form').css('background-position', '25% -41%');
            count2 = 1; 
            $('.counter span').text(count2);
        })
    
        //    La question 2 (age)
        $(document).on('click', '#to-q-4', function (e) {
            e.preventDefault();
            var imgval = $('#idimg').attr('data-default-file');
            if ($('#idimg').get(0).files.length === 0 && imgval === '') {
                //No file selected
                $('.wimgd').show(400);
            } else {
                //File selected
                $('.question3').removeClass('in-view').addClass('up');
                $('.question4').removeClass('down').addClass('in-view');
                $(this).attr("id", "to-q-5");
                $('#back-to-q-2').attr("id", "back-to-q-3");
                $('#new-form').css('background-position', '-30% -5%');
                count2 = 3;
                $('.counter span').text(count2);
            }
        });

        $(document).on('click', '#back-to-q-3', function (e) {
            e.preventDefault();
            $('.question3').removeClass('up').addClass('in-view');
            $('.question4').removeClass('in-view').addClass('down');
            $('#to-q-5').attr("id", "to-q-4");
            $('#back-to-q-3').attr("id", "back-to-q-2");
            $('#new-form').css('background-position', '25% -41%');
            count2 = 2; 
            $('.counter span').text(count2);
        })
        
        //    La question 3 (poids actuel)
        $(document).on('click', '#to-q-5', function (e) {
            e.preventDefault();
            var val = $('input[name="address_doc"]:checked').val();
            if (val == null) {
                $('.wad').show(400);
            } 
            else {
                $('.question4').removeClass('in-view').addClass('up');
                $('.question5').removeClass('down').addClass('in-view');
                $(this).attr("id", "to-q-6");
                $('#back-to-q-3').attr("id", "back-to-q-4");
                var overallstatus = $('#ovstat').val();
                if(overallstatus == 0 || overallstatus == 1 || overallstatus == 3) {
                    $('#to-q-6').hide();
                }else{
                    $(this).html("Submit Form");
                }
                $('#new-form').css('background-position', '166% 44%');
                count2 = 4;
                $('.counter span').text(count2);
            }
        });

        $(document).on('click', '#back-to-q-4', function (e) {
            e.preventDefault();
            $('.question4').removeClass('up').addClass('in-view');
            $('.question5').removeClass('in-view').addClass('down');
            $('#to-q-6').show();
            $('#to-q-6').html("Next Page");
            $('#to-q-6').attr("id", "to-q-5");
            $('#back-to-q-4').attr("id", "back-to-q-3");
            $('#new-form').css('background-position', '25% -41%');
            count2 = 3; 
            $('.counter span').text(count2);
        })
        
        $(document).on('click', '#to-q-6', function (e) {
            e.preventDefault();
            var actionurl = $('#kycApply').attr('action');
            var form = document.getElementById("kycApply");
            var formData = new FormData(form)
            if ($('#addressimg').get(0).files.length === 0) {
                //No file selected
                $('.wiadd').show(400);
            } else {
                $('.question5').removeClass('in-view').addClass('up');
                $('#back-to-q-4').hide();
                $('.load-space').show().removeClass('down').addClass('in-view');
                $(this).hide();
                $('#new-form').css('background-position', '107% -50%');
                $('.counter').css('display', 'none');
                $.ajax({
                    type: "POST",
                    url: actionurl,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        var content = JSON.parse(result);
                        $("input[name="+content.csrfTokenName+"]").val(content.csrfHash);
                        if(content.success == true){
                        }
                    },
                    error: function(result) {}
                })
                //File selected
            }
        });
        
    });