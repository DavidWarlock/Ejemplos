<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>
        <div>
            Gracias por registrares en Aerolinea, para activar su cuenta
            haga click en el siguiente enlace:
            {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>
        </div>
    </body>
</html>
