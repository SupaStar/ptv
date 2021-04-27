<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información sobre el cierre de caja</title>
</head>
<body>
<br><hr><hr><br><br>
    Se cerro la caja con un total de ventas con pago en efectivo de: ${{$ventasTotales}}
    <br><br>
    Se cerro la caja con un total de ventas con pago de tarjeta: ${{$ventasTotalesTarjeta}}
<div>
    <br><br><br><br>
    Con utilidades de pago en efectivo: ${{$utilidades}}
    <br><br>
    Con utilidades de pago con tarjeta: ${{$utilidadesTarjeta}}
</div>
<div>
    <br><br><br><br>
    Suma total de ventas: ${{$ventasTotales+$ventasTotalesTarjeta}}
    <br><br>
    Utilidades total de ventas: ${{$utilidades+$utilidadesTarjeta}}
</div>

<div>
    <br><br>
    Fecha y hora de cierre: {{$fecha_hora_cierre}}
</div>
<br><hr><hr><br>
</body>
</html>