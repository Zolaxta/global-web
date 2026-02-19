<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canje Exitoso</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .notification-card {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-align: center;
            max-width: 400px;
            width: 90%;
            border-top: 5px solid #10b981;
        }
        .icon {
            color: #10b981;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        h1 {
            color: #111827;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        p {
            color: #4b5563;
            margin-bottom: 1.5rem;
        }
        .reward-name {
            font-weight: bold;
            color: #10b981;
            font-size: 1.25rem;
        }
        .btn {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="notification-card">
        <div class="icon">🎉</div>
        <h1>¡Felicidades!</h1>
        <p>Has canjeado exitosamente:</p>
        <div class="reward-name">{{ $reward->name }}</div>
        <p>Se han descontado {{ $reward->point_cost }} puntos de tu balance.</p>
        
        <a href="{{ url('/') }}" class="btn">Volver al Inicio</a>
    </div>
</body>
</html>
