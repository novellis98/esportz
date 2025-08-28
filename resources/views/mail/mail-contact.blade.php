<!DOCTYPE html>
<html>

<head>
    <title>Nuovo Messaggio</title>
</head>

<body>
    <h2>Nuovo Messaggio da {{ $userData['name'] }}</h2>
    <p><strong>Email:</strong> {{ $userData['email'] }}</p>
    <p><strong>Messaggio:</strong></p>
    <p>{{ $userData['message'] }}</p>
</body>

</html>
