<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bienvenue sur StaffHub</title>
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
            background-color: #4a90e2;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .credentials {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue sur StaffHub</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $employee->prenom }},</p>
        
        <p>Votre compte a été créé avec succès sur la plateforme StaffHub. Voici vos informations de connexion :</p>
        
        <div class="credentials">
            <p><strong>Email :</strong> {{ $employee->email }}</p>
            <p><strong>Mot de passe temporaire :</strong> {{ $password }}</p>
        </div>
        
        <p>Pour votre sécurité, nous vous recommandons de :</p>
        <ul>
            <li>Changer votre mot de passe dès votre première connexion</li>
            <li>Ne jamais partager vos identifiants</li>
            <li>Utiliser un mot de passe fort et unique</li>
        </ul>
        
        <p>Vous pouvez vous connecter en cliquant sur le bouton ci-dessous :</p>
        
        <a href="{{ url('/login') }}" class="button">Se connecter</a>
        
        <p>Si vous avez des questions, n'hésitez pas à contacter le service RH.</p>
        
        <p>Cordialement,<br>L'équipe StaffHub</p>
    </div>
</body>
</html> 