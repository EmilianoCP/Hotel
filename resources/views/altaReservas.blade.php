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

    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}"><!---->
</head>
<body ng-controller="ctrl">

<form name="frmReserva">
    <br><br>
    <div class="container">
        <div class="container" style="background: #000000; padding: .2em;color: white;">
            <h1>Alta Reservaciones</h1>
        </div>
        <br><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" name="nombre" ng-model="reservacion.nombre" class="form-control" placeholder="nombre">
            </div>

            <div class="form-group col-md-6">
                <label>Apellido</label>
                <input type="text" name="apellido" ng-model="reservacion.apellido" class="form-control"
                       placeholder="Apellido">
            </div>

            <div class="form-group col-md-12">
                <label>Fecha nacimiento</label>
                <input type="date" name="fechanac" ng-model="reservacion.fechanac" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>Inicio de reservacion</label>
                <input type="date" name="inicio" ng-model="reservacion.inicioreserva" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>Fin de reservacion</label>
                <input type="date" name="fin" ng-model="reservacion.finreserva" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label>Tipo de Habitacion</label>
                <select ng-model="reservacion.nombrehab" ng-options="x.tipo for x in tipohab" class="form-control">
                    <option value="">Selecciona una Habitacion</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Costo</label>
                <input type="number" name="costo" ng-model="reservacion.costo" class="form-control" placeholder="Costo">
            </div>



            <div class="form-group col-md-12">
                <button type="button" ng-click="guardarReservacion()"  class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-success"><a href="{{url('/')}}">Mostrar Reservaciones</a></button>
                <button type="button" class="btn btn-secondary" style="float: right"><a href="{{url('/')}}">Regresar</a></button>
            </div>
        </div>
    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []).controller('ctrl', function ($scope , $http) {
        $scope.tipohab = [
            {id: 1, tipo: "individual"},
            {id: 2, tipo: "doble"},
            {id: 4, tipo: "triple"},
            {id: 5, tipo: "suite"},
            {id: 6, tipo: "presidencial"}
        ];
    });
    $scope.guardarReservacion = function () {

    }
</script>