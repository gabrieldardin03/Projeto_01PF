$(function(){
    $('nav.mobile').click(function(){
        var listaMenu = $('nav.mobile ul');
        //Verificando se está aberto a barra mobile.

        //var listaMenu = $('nav.mobile').find('ul'); Segunda maneira de achar uma classe.

        //listaMenu.fadeIn();
        //listaMenu.show(); Eventos que mostram a classe nav.mobile ul
        //listaMenu.slideToggle();

        //Verificando se a barra está escondida ou não
        if(listaMenu.is(':hidden')){
            var icone = $('nav.mobile div').find('div');
            icone.removeClass('fa-bars');
            icone.addClass('fa-xmark');
            //listaMenu.fadeIn();
            //listaMenu.show();
            listaMenu.slideToggle();
            //listaMenu.css('display','block'); Acessa o CSS
        }else{
            var icone = $('nav.mobile div').find('div');
            icone.removeClass('fa-xmark');
            icone.addClass('fa-bars');
            //listaMenu.fadeOut();
            //listaMenu.hide();
            listaMenu.slideToggle();
            //listaMenu.css('display','none'); Acessa o CSS

        }
    })

    //Verificando se o elemento existe para aplicar o scroll
    if($('target').length > 0){
        var elemento = '#'+$('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({'scrollTop':divScroll}, 2000);
    }
})