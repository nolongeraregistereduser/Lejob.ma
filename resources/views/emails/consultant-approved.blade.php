<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compte Consultant Activé</title>
    <style>
        body {
            font-family: 'Quicksand', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">LeJob.ma</div>
    </div>
    
    <div class="content">
        <h2>Félicitations {{ $user->name }}!</h2>
        
        <p>Votre compte consultant est maintenant activé. Vous pouvez commencer à prendre des rendez-vous.</p>
        
        <p>Nous sommes heureux de vous compter parmi notre équipe de consultants. Votre expertise sera précieuse pour nos utilisateurs.</p>
        
        <p>Connectez-vous dès maintenant pour configurer votre disponibilité et commencer à aider nos candidats dans leur recherche d'emploi.</p>
        
        <div style="text-align: center;">
            <a href="{{ route('login') }}" class="button">Se connecter</a>
        </div>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} LeJob.ma - Tous droits réservés</p>
        <p>Ceci est un email automatique, merci de ne pas y répondre.</p>
    </div>
</body>
</html>