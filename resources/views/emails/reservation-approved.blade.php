<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\emails\reservation-approved.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de réservation</title>
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
        .meeting-details {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .consultant-notes {
            background-color: #f0f7ff;
            border-left: 4px solid #3490dc;
            padding: 15px;
            margin: 20px 0;
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
            color: #fff !important;
            padding: 10px 20px;
            text-align: center;
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
        <h2>Votre réservation est confirmée !</h2>
        
        <p>Bonjour {{ $reservation->user->name }},</p>
        
        <p>Nous avons le plaisir de vous informer que votre réservation de consultation a été confirmée par <strong>{{ $reservation->consultant->name }}</strong>.</p>
        
        <div class="meeting-details">
            <h3>Détails de votre rendez-vous:</h3>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
            <p><strong>Heure:</strong> {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}</p>
            <p><strong>Consultant:</strong> {{ $reservation->consultant->name }}</p>
        </div>
        
        <div class="consultant-notes">
            <h3>Message du consultant:</h3>
            <p>{!! nl2br(e($reservation->notes)) !!}</p>
        </div>
        
        <p>Si vous avez des questions ou besoin de modifier votre réservation, n'hésitez pas à contacter votre consultant ou notre service client.</p>
        
        <div style="text-align: center;">
            <a href="{{ route('user.reservations.show', $reservation->id) }}" class="button">Voir ma réservation</a>
        </div>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} LeJob.ma - Tous droits réservés</p>
        <p>Ceci est un email automatique, merci de ne pas y répondre.</p>
    </div>
</body>
</html>