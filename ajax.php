<?php 
if (!isset($_POST)){
    die('No Autorizado');
}

//funcion pra nuestras respuestas
function json_output($status = 200, $msg ='OK', $data = []){
    echo json_encode(['status'=>$status, 'msg'=>$msg, 'data'=>$data]);
    die;
}

// Si no estan llenos los campos, redirecciona con error
    if (empty($_POST['nombre'])){
        json_output(400, 'Ingrese un nombre valido.');
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        json_output(400, 'Ingrese un email valido.');
    }

    if(empty($_POST('tel'))){
        json_output(400, 'Ingrese un telefono valido.');
    }   
    if (empty($_POST['mensaje']) || strlen($_POST['mensaje'] < 5)){
        json_output(400, 'Ingrese un mensaje valido.');
    }    

    //informacion del formulario

    $info['nombre']=$_POST['nombre'];
    $info['email']=$_POST['email'];
    $info['tel']=$_POST['tel'];
    $info['mensaje']=$_POST['mensaje'];
    $info['ip']=$_POST['REMOTE_ADDR'];
    $info['fecha']=$_POST['d M Y h:m:s'];

    //remitente
    $para =$_POST['email'];
    
    //email delservidor local
    $de = 'black@blackparadox.com';

    //asunto del corrreo
    $asunto = "Nuevo mensaja para Blackparadox";

    //cabeceras que aparecen arriba de tu correo
    $headers = "From: $de\r\n";
    $headers = "MIME-Verasion: 1.0\r\n";
    $headers = "Content-type: text/html; charset=uft-8\r\n";


    //Mensaje del correo
    //$mensaje es el mensaje
    $mensaje="
    <html>
    <body>
    <h3>Tu mensaje ha sido enviado</h3>
    <p><strong>Nombre:</strong>{$info['nombre']}</p>
    <p><strong>E-mail:</strong>{$info['email']}</p>
    <p><strong>Telefono:</strong>{$info['tel']}</p>
    <p><strong>Mensaje:</strong>{$info['mensaje']}</p>
    <br>
    <p><strong>IP:</strong>{$info['ip']}</p>
    <p><strong>Fecha:</strong>{$info['fecha']}</p>
    </body>
    </html>
    ";



        //Enviando el Formulario
        $enviar = mail($para,$asunto,$mensaje,$headers);
        if(!$enviar){
         json_output(400, 'Hubo un error al enviar el mensaje ');
        }
        json_output(200, 'Mensaje enviado con exito', $mensaje);

?>