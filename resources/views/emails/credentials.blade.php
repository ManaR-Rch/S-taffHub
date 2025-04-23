<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3B82F6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .credentials {
            background-color: #e5e7eb;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background-color: #3B82F6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #6B7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue sur StaffHub</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $name }},</p>

        <p>Votre compte StaffHub a été créé avec succès. Voici vos identifiants de connexion :</p>

        <div class="credentials">
            <p><strong>Email :</strong> {{ $email }}</p>
            <p><strong>Mot de passe :</strong> {{ $password }}</p>
        </div>

        <p>Pour des raisons de sécurité, nous vous recommandons de changer votre mot de passe lors de votre première connexion.</p>

        <a href="{{ url('/login') }}" class="button">Se connecter</a>
    </div>

    <div class="footer">
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html> 