<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription en attente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; }
        .container {
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 24px;
            text-align: center;
        }
        h2 { color: #007bff; }
        .btn {
            display: inline-block;
            margin-top: 24px;
            padding: 10px 24px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription en attente de validation</h2>
        <p>
            Votre inscription a bien été prise en compte.<br>
            Votre compte producteur est en cours de vérification par un administrateur.<br>
            Vous recevrez un email dès que votre compte sera validé.<br>
            Merci pour votre confiance !
        </p>
        <a href="{{ route('login') }}" class="btn">Retour à la connexion</a>
    </div>
</body>
</html>