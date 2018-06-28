<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            //criando o recurso cURL 
            $cr = curl_init();   
            //definindo a url de busca 
            curl_setopt($cr, CURLOPT_URL, "http://localhost/avaliacao/clientes.html");   
            //definindo a url de busca 
            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);   
            //definindo uma variável para receber o conteúdo da página... 
            $retorno = curl_exec($cr);   
            //fechando-o para liberação do sistema. 
            curl_close($cr); //fechamos o recurso e liberamos o sistema...   
            //mostrando o conteúdo... 
            echo $retorno;


        ?>
    </body>
</html>
