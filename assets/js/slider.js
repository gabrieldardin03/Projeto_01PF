$(function () {
    var delay = 5 //Tempo do carousel
    var currentSlide = 0; //Valor atual do slide
    var maxSlide = $('.banner-single').length - 1; //Quantidade máxima de slides

    initSlider();
    changeSlider();

    function initSlider() {
        $('.banner-single').hide(); //Esconder todos os elementos com a classe: banner-single
        $('.banner-single').eq(currentSlide).show(); //eq(0) -> selecionar o index() | show() -> mostrar

        for (var i = 0; i < maxSlide + 1; i++) {
            var content = $('.bullets').html(); //Recuperando o conteúdo do html

            //Verificando se é o primeiro bullets
            if (i == 0) {
                content += '<span class="active-slider"></span>';
            } else {
                content += '<span></span>';
            }

            $('.bullets').html(content);
        }
    }

    function changeSlider() {
        setInterval(function () {
            $('.banner-single').eq(currentSlide).stop().fadeOut(3000);
            currentSlide++;

            if (currentSlide > maxSlide)
                currentSlide = 0;

            $('.banner-single').eq(currentSlide).stop().fadeIn(3000);

            $('.bullets span').removeClass('active-slider'); // Trocar os bullets na navegação
            $('.bullets span').eq(currentSlide).addClass('active-slider');
        }, delay * 1000);
    }

    $('body').on('click', '.bullets span', function(){
        var currentBullet = $(this);

        $('.banner-single').eq(currentSlide).stop().fadeOut(); //Sincronizar bullets e slider
        currentSlide = currentBullet.index();
        $('.banner-single').eq(currentSlide).stop().fadeIn();

        $('.bullets span').removeClass('active-slider'); //Removendo a classe antiga
        currentBullet.addClass('active-slider'); //Atualizando a classe do click
    })  
})