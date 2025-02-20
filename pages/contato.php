<div class="contato-container">
    <div class="center">
        <h2>Contato</h2>
        <form method="post" action="">
            <input type="text" name="nome" id="" placeholder="Nome:">
            <input type="text" name="email" id="" placeholder="E-mail:">
            <input type="text" name="telefone" id="" placeholder="Telefone:">
            <textarea name="mensagem" id="" placeholder="Digite a sua mensagem:"></textarea>
            <input type="submit" name="btnEnviar" value="Enviar">
        </form>
    </div>
</div>

<?php
    if(isset($_POST['btnEnviar'])){

        new email(); // Enviar Email para Mailtrap
    }
?>

<!--Manipular no CSS-->
<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14318.407128778308!2d-50.94516633151815!3d-26.209629331594407!2m3!1f0!2f0!3f0!3
    m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94e6f5e07d7116ed%3A0xa8d7501a8599999d!2sPaula%20Freitas%2C%20PR%2C%2084630-000!5e0!3m2!1spt-BR!2sbr!4v174001
    1727607!5m2!1spt-BR!2sbr" 
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </iframe>
</div>