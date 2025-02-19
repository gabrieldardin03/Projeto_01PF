$(function(){
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    if(windowSize <= 768){
        open = false;
    }

    $('.menu-btn').click(function(){
        if(open){
            //Menu está aberto, precisamos fechar
            $('header, .content').css('width','100%');
            $('header, .content').animate({left:'0'});
            $('aside').fadeOut();
            open = false;
        }else{
            //Menu está fechado, precisamos abrir
            $('header, .content').css('width','calc(100% - 250px)');
            $('header, .content').animate({left:'250px'});
            $('aside').fadeIn();
            open = true;
        }
    })

    $('[formato="data"]').mask('99/99/9999');

    $('[actionBtn=delete]').click(function () {
        let text;
        if (confirm("Deseja excluir o registro?") == true) {
            return true;
        } else {
            return false;
        }
    })
})