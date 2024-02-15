<!DOCTYPE html>
<html>

<head>
    <title>Reserva en El Pesto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            color: #555;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        li {
            margin: 5px 0;
        }

        li::before {
            content: "•";
            color: #333;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
    </style>
</head>

<body>
    <h1>¡Gracias por tu reserva!</h1>
    <p>Detalles de la reserva:</p>

    <ul>
        <li>Número de personas: {{ $reserva->n_personas }}</li>
        <li>Menú: {{ $reserva->menu }}</li>
        <li>Alergias: {{ $reserva->alergias }}</li>
        <li>Fecha: {{ $reserva->fecha }}</li>
        <li>Hora: {{ $reserva->hora }}</li>
    </ul>

    <p>¡Esperamos verte pronto en nuestro restaurante!</p>
</body>

</html>
