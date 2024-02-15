<!DOCTYPE html>
<html>

<head>
    <title>Reserva en El Pesto</title>
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
