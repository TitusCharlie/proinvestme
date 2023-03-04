$(".sitelangChange").click(function(e){
    var actionurl = $(this).attr("data-id");
    $.get(actionurl, function(data){
        var content = JSON.parse(data);
        setTimeout(
            function() {
                location.reload();
            }, 1000);
    });
});

$('.close').on('click', function(e){
    $('.drawer').removeClass('open');
})

$('.customizer-toggle').on('click', function(e){
    $('.drawer').addClass('open');
})

$('.choose-option__icon').on('click', function(e){
    var actionurl = $(this).attr("data-url");
    $.get(actionurl, function(data){
        var content = JSON.parse(data);

        setTimeout(
            function() {
                window.location.replace("./home");
            }, 1000);
    });
})