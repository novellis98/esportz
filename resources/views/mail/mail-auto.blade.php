<!DOCTYPE html>
<html>

<head>
    <title>Grazie per averci contattato</title>
</head>

<body>
    <h1>Ciao {{ $userData['name'] }},</h1>
    <p>Abbiamo ricevuto il tuo messaggio:</p>
    <blockquote>{{ $userData['message'] }}</blockquote>
    <p>Ti risponderemo il prima possibile.</p>
    <br>
    <p>Grazie,</p>
    <p>Il team di E-Sport</p>
</body>

</html>
