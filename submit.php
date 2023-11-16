<?php 
if (isset($_POST['submit'])) {

    if (empty($_POST['nombre']) ||
        empty($_POST['email']) || 
        empty($_POST('tel')) ||
        empty($_POST['mensaje'])
        ) {
        // Si no estan llenos los campos, redirecciona con error
        header("location: ./contacto.html?llena-todos-los-campos");
        exit();
    }
    $info['nombre']=$_POST['nombre'];
    $info['email']=$_POST['email'];
    $info['tel']=$_POST['tel'];
    $info['mensaje']=$_POST['mensaje'];
    $info['ip']=$_POST['REMOTE_ADDR'];
    $info['fecha']=$_POST['d M Y h:m:s'];



    $para ="leconaandre51@gmail.com";
    $de = $para;

    //asunto del corrreo
    $asunto = "Hola, es mi primer correo - Blackparadox";

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
        if($enviar){
            header("Location: ../contacto.html?success");
            exit();
        }else{
            header("Location: ../contacto.html?error");
            exit();
        }

    }
    else{
    // Si no se manda el formulario, regresa a contacto con error
    // Prueba
    header("Location: ./contacto.html?error");
}


?>

<br>
<a href="contacto.html">Regresa</a>
