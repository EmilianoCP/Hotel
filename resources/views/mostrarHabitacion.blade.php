<!doctype html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Habitaciones</title>
</head>
<body ng-controller="ctrl">

<form name="frmLibro">
    <br><br>
    <div class="container">
        <div class="container" style="background: #000000; padding: .2em;color: white;">
            <h1>Habitaciones</h1>
        </div>
        <br><br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>HABITACION</th>
                <th>CAMA</th>
                <th>CANTIDAD CAMAS</th>
                <th>CUARTOS</th>
                <th>PRECIO</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($datos as $habitacion)
                <tr>
                    <td>{{$habitacion->id}}</td>
                    <td>{{$habitacion->nombrehab}}</td>
                    <td>{{$habitacion->tipocama}}</td>
                    <td>{{$habitacion->cantcamas}}</td>
                    <td>{{$habitacion->cantcuartos}}</td>
                    <td>${{$habitacion->preciohab}}</td>
                    <td>
                        <button class="btn btn-danger" ng-click="eliminar({{$habitacion->id}})">Eliminar</button>
                    </td>
                    <td>
                        <button class="btn btn-warning" ng-click="eliminar({{$habitacion}})">Modificar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary" style="float: right"><a href="{{url('/habitaciones')}}">Regresar</a></button>

    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []).controller('ctrl', function ($scope , $http) {

    });
</script>