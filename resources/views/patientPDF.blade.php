<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
            font-family: poppins, sans-serif;
        }
    </style>
    <div>
        <h1 style="color: #FF4500;">SHEFAA</h1>
    </div>
    <div>
        <h3>le {{$patient['planDate']}} a {{$patient['appTime']}}</h3>
        <h3>Nom et prenom: {{$patient['patientLName']}} {{$patient['patientFName']}}</h3>
        <h3>Dr : {{$patient['planDoc']}}</h3>
    </div>
    
</body>
</html>