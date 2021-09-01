<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <h1>Ciao Admin</h1>
    <h2>Hai ricevuto una nuova richiesta di Revisore</h2>
    <p>Ecco le sue info</p>
    <ul>
        <li>Nome: {{$contact['name']}}</li>
        <li>Email: {{$contact['email']}}</li>
        <li>Messaggio: {{$contact['message']}}</li>
    </ul>

</body>

</html>