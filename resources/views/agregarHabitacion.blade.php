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

    <!--<style type="text/css">
        a:link
        {
            text-decoration:none;
            text-decoration-color: white;
            color: #ffffff;
        }
        a:hover
        {
            text-decoration:none;
            text-decoration-color: white;
            color: #ffffff;
        }
        a
        {
            text-decoration:none;
            text-decoration-color: white;
            color: #ffffff;
        }
    </style>-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body ng-controller="ctrl">

<form name="frmLibro">
    <br><br>
    <div class="container">
        <div class="container" style="background: #000000; padding: .2em;color: white;">
        <h1>Agregar Habitaciones</h1>
        </div>
        <br><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre de Habitacion</label>
                <select ng-model="habitacion.nombrehab" ng-options="x.tipo for x in tipohab" class="form-control">
                    <option value="">Selecciona una Habitacion</option>
                </select>
                <!--<input type="text" name="nombrehab" ng-model="habitacion.nombrehab" class="form-control" placeholder="nombre">-->
            </div>

            <div class="form-group col-md-6">
                <label>Tipo de Cama</label>
                <select ng-model="habitacion.tipocama" ng-options="x.tipo for x in camas" class="form-control">
                    <option value="">Selecciona una cama</option>
                </select>
                <!--<input type="text" name="cama" ng-model="habitacion.tipocama" class="form-control"
                       placeholder="tipo de cama">-->
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
                <button type="button" ng-click="guardarhabitacion()"  class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-success"><a href="{{url('/showHabitaciones')}}">Mostrar Habitaciones</a></button>
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

        $scope.camas = [
            {id: 1, tipo: "individual"},
            {id: 2, tipo: "matrimonial"},
            {id: 4, tipo: "queen size"},
            {id: 5, tipo: "king size"}
        ];

        $scope.guardarhabitacion = function () {
            $scope.habitacion.nombrehab = $scope.habitacion.nombrehab.tipo;
            $scope.habitacion.tipocama = $scope.habitacion.tipocama.tipo;
            console.log($scope.habitacion);
            $http.post('/saveHabitacion', $scope.habitacion).then(
                function (response) {
                    console.log(response.status);
                    alert("la habitacion fue dada de alta con exito");
                    location.reload();
                })
        }



    });
</script>