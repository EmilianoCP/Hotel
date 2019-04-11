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
                <select ng-model="habitacion.nombrehab" ng-options="x.tipo for x in tipohab" class="form-control"
                        required>
                    <option value="">Selecciona una Habitacion</option>
                </select>
                <span ng-show="frmLibro.select.$dirty && frmLibro.select.$error.required">Campo requerido</span>
                <!--<input type="text" name="nombrehab" ng-model="habitacion.nombrehab" class="form-control" placeholder="nombre">-->
            </div>

            <div class="form-group col-md-6">
                <label>Tipo de Cama</label>
                <select ng-model="habitacion.tipocama" ng-options="x.tipo for x in camas" class="form-control" required>
                    <option value="">Selecciona una cama</option>
                </select>
                <span ng-show="frmLibro.select.$dirty && frmLibro.select.$error.required">Campo requerido</span>

            </div>

            <div class="form-group col-md-6">
                <label>Cantidad de Camas</label>
                <input type="number" name="cantcamas" ng-model="habitacion.cantcamas" class="form-control"
                       placeholder="camas" required>
                <span ng-show="frmLibro.cantcamas.$dirty && frmLibro.cantcamas.$error.required" class="danger">Campo requerido*</span>
            </div>

            <div class="form-group col-md-6">
                <label>Cantidad de Cuartos</label>
                <input type="number" name="cantcuartos" ng-model="habitacion.cantcuartos" class="form-control"
                       placeholder="cuartos" required>
                <span ng-show="frmLibro.cantcuartos.$dirty && frmLibro.cantcuartos.$error.required" class="danger">Campo requerido*</span>
            </div>

            <div class="form-group col-md-2">
                <label>Precio por Habitacion</label>
                <input type="number" name="precio" ng-model="habitacion.precio" class="form-control"
                       placeholder="precio" required>
                <span ng-show="frmLibro.precio.$dirty && frmLibro.precio.$error.required" class="danger">Campo requerido*</span>
            </div>

            <div class="form-group col-md-12">
                <button type="button" ng-click="guardarhabitacion()" class="btn btn-primary"
                        ng-disabled="!frmLibro.$valid">Guardar
                </button>
                <button type="button" class="btn btn-success"><a href="{{url('/showHabitaciones')}}">Mostrar
                        Habitaciones</a></button>
                <button type="button" class="btn btn-secondary" style="float: right"><a href="{{url('/')}}">Regresar</a>
                </button>
            </div>
        </div>
    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []).controller('ctrl', function ($scope, $http) {
        $scope.data = {!! json_encode($datos) !!};
        console.log($scope.data);
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

        for (var x = 0; x < $scope.data.length; x++) {
            for (var y = 0; y < $scope.tipohab.length; y++) {
                if ($scope.data[x].nombrehab == $scope.tipohab[y].tipo) {
                    $scope.tipohab.splice(y, 1);
                }
            }
        }

        $scope.guardarhabitacion = function () {

            if ($scope.habitacion.cantcuartos != 0 && $scope.habitacion.cantcamas != 0 && $scope.habitacion.precio != 0) {
                $scope.habitacion.nombrehab = $scope.habitacion.nombrehab.tipo;
                $scope.habitacion.tipocama = $scope.habitacion.tipocama.tipo;
                console.log($scope.habitacion);
                $http.post('/saveHabitacion', $scope.habitacion).then(
                    function (response) {
                        console.log(response.status);
                        alert("la habitacion fue dada de alta con exito");
                        location.reload();
                    })
            }else{
                alert("cantidad de camas o cuartos invalido");
            }
        }


    });
</script>
