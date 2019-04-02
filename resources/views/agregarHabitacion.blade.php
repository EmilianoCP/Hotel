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
    <div class="container">
        <h1>Agregar Habitaciones</h1>
        <br><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre de Habitacion</label>
                <input type="text" name="nombrehab" ng-model="habitacion.nombre" class="form-control" placeholder="nombre">
            </div>

            <div class="form-group col-md-6">
                <label>Tipo de Cama</label>
                <input type="text" name="cama" ng-model="habitacion.tipocama" class="form-control"
                       placeholder="tipo de cama">
            </div>

            <div class="form-group col-md-6">
                <label>Cantidad de Camas</label>
                <input type="number" name="cantcamas" ng-model="habitacion.cantcamas" class="form-control"
                       placeholder="camas">
            </div>

            <div class="form-group col-md-6">
                <label>Cantidad de Cuartos</label>
                <input type="number" name="cantcuartos" ng-model="habitacion.cantcuartos" class="form-control"
                       placeholder="cuartos">
            </div>

            <div class="form-group col-md-2">
                <label>Precio por Habitacion</label>
                <input type="number" name="precio" ng-model="habitacion.precio" class="form-control"
                       placeholder="precio">
            </div>

            <div class="form-group col-md-12">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary">Mostrar</button>

            </div>
        </div>
    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []);
    app.controller('ctrl', function ($scope) {

    });
</script>