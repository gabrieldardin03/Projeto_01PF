$(function(){
    var include_path = $('base').attr('base');
    $('select').change(function(){
        location.href=include_path+"noticias/"+$(this).val();
    })

})