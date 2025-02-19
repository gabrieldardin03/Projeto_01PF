$(function(){
    var current = -1
    var max = $('.box-especialidades').length-1;
    var timer;
    var delay = 3;

    runAnimation();

    function runAnimation(){
        $('.box-especialidades').hide();
        timer = setInterval(animation, delay*1000);

        function animation(){
            current++;
            if(current > max){
                clearInterval(timer);
                return false;
            }
            $('.box-especialidades').eq(current).fadeIn();
        }
    }   
})