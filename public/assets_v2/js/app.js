$(document).ready(function () {
   

    $('[data-toggle="tooltip"]').tooltip();

    var scroll_pos = 0;
    $(document).scroll(function () {
        scroll_pos = $(this).scrollTop();
        if (scroll_pos > 100) {
            $(".navbar-light").addClass("fondoNav");
        } else {
            $(".navbar-light").removeClass("fondoNav");
        }
    });

    $colSidebarIzq = 0;
    $colSidebarIzq = $(".colSidebarIzq").width();
    $(".contenidoPrincipal").css("margin-left",($colSidebarIzq+30));
});

function artista(){
    var windowHeight = $(window).height();

    var temp1 = window.getComputedStyle(document.getElementById('rowNombre')).getPropertyValue('margin-top');
    temp1 = temp1.substring(0, ((temp1.length ) - 2));
    temp1 = parseInt(temp1) + $(".rowNombre").height();

    var temp2 = window.getComputedStyle(document.getElementById('rowBtnContactar')).getPropertyValue('margin-bottom');
    temp2 = temp2.substring(0, ((temp2.length ) - 2));
    temp2 = parseInt(temp2) + $(".rowBtnContactar").height();

    var temp3 = $(".rowVideos").height();

    var temp5 = $(".rowCosto").height();
    var temp6 = temp1 + temp2 + temp3 + temp5;
    var temp7 = (windowHeight - temp6 - 30);

    $(".rowCosto").css("margin-top",(temp7));

}