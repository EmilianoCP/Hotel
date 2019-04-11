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

<form name="forms.frmReserva">
    <br><br>
    <div class="container">
        <div class="container" style="background: #000000; padding: .2em;color: white;">
            <h1>Alta Reservaciones</h1>
        </div>
        <br><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input id="nombre" type="text" name="nombre" ng-pattern ="/^[a-zA-ZáéíóúÁÉÍÓÚ\s]*$/" ng-model="reservacion.nombre"
                       class="form-control" placeholder="nombre" required>
                <span ng-show="(forms.frmReserva.nombre.$dirty && forms.frmReserva.nombre.$error.required) ||
                (forms.frmReserva.nombre.$dirty && !forms.frmReserva.nombre.$valid)">Nombre invalido.</span>
            </div>
            <div class="form-group col-md-6">
                <label>Apellido</label>
                <input id="apellido" type="text" name="apellido" ng-pattern ="/^[a-zA-ZáéíóúÁÉÍÓÚ\s]*$/" ng-model="reservacion.apellido"
                       class="form-control" placeholder="Apellido" required>
                <span ng-show="(forms.frmReserva.apellido.$dirty && forms.frmReserva.apellido.$error.required) ||
                (forms.frmReserva.apellido.$dirty && !forms.frmReserva.apellido.$valid)">Apellido(s) invalido(s).</span>
            </div>

            <div class="form-group col-md-12">
                <label>Fecha nacimiento</label>
                <input id="fechaNac" type="date" name="fechanac" min="@{{minn}}" max="@{{maxx}}" ng-model="reservacion.fechanac" class="form-control" required>
                <span ng-show="(forms.frmReserva.fechanac.$dirty && forms.frmReserva.fechanac.$error.required) ||
                (forms.frmReserva.fechanac.$dirty && !forms.frmReserva.fechanac.$valid)">Fecha de nacimiento invalida.</span>
            </div>

            <div class="form-group col-md-6">
                <label>Inicio de reservacion</label>
                <input id="inicio" type="date" name="inicio"  min="@{{min}}" ng-change="changeDate()"  ng-model="reservacion.inicioreserva" class="form-control" required>
                <span ng-show="(forms.frmReserva.inicio.$dirty && forms.frmReserva.inicio.$error.required) ||
                (forms.frmReserva.inicio.$dirty && !forms.frmReserva.inicio.$valid)">Fecha de registro invalida.</span>
            </div>

            <div class="form-group col-md-6">
                <label>Fin de reservacion</label>
                <input id="fin" type="date" name="fin"  min="@{{men}}" ng-change="difDias()"ng-model="reservacion.finreserva" class="form-control" required>
                <span ng-show="(forms.frmReserva.fin.$dirty && forms.frmReserva.fin.$error.required) ||
                (forms.frmReserva.fin.$dirty && !forms.frmReserva.fin.$valid)">Fecha de registro invalida.</span>
            </div>
            <div class="form-group col-md-6">
                <label>Tipo de Habitacion</label>
                <select id="tipohab" name="tipohab"  ng-change="difDias()"ng-model="reservacion.nombrehab" ng-options="x.nombrehab for x in reservaciones" class="form-control" required>
                </select>
                <span ng-show="(forms.frmReserva.tipohab.$dirty && forms.frmReserva.tipohab.$error.required) ||
                (forms.frmReserva.tipohab.$dirty && !forms.frmReserva.tipohab.$valid)">Tipo de habitacion invalida.</span>
            </div>
            <div class="form-group col-md-6">
                <label>Costo</label>
                <input id="costo" type="text" name="costo" ng-model="reservacion.costo"  ng-disabled="true"class="form-control" placeholder="Costo">
            </div>



            <div class="form-group col-md-12">
                <button type="button" ng-disabled="!forms.frmReserva.$valid"ng-click="guardarReservacion()"  class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-success"><a href="{{url('/showReservaciones')}}">Mostrar Reservaciones</a></button>
                <button type="button" class="btn btn-secondary" style="float: right"><a href="{{url('/')}}">Regresar</a></button>
            </div>
        </div>
    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('js/moment.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []).controller('ctrl', function ($scope , $http) {
        $scope.r = {};
        $scope.reservaciones = [];
        @if (isset($datos))
            $scope.reservaciones={!! json_encode($datos) !!};
        @endif
        $scope.maxMin=function () {
            let fecha = new Date();
            let mes = fecha.getMonth() + 1;
            let dia = fecha.getDate();
            let ano = fecha.getFullYear();
            if (dia < 10)
                dia = '0' + dia;
            if (mes < 10)
                mes = '0' + mes;
            $scope.minn="1869-00-00";
            $scope.maxx= (ano-18) + "-" + mes + "-" + dia;
            $scope.min= ano+ "-" + mes + "-" + dia;
        }
        $scope.maxMin();
        $scope.changeDate=function () {
            var fecha = new Date($scope.reservacion.inicioreserva);
            fecha.setDate(fecha.getDate() + 1);
            $scope.men=fecha;
            $scope.difDias();
        }
        $scope.difDias=function () {
            let fecha1 = moment($scope.reservacion.inicioreserva);
            let fecha2 = moment($scope.reservacion.finreserva);
            $scope.diferencia=fecha2.diff(fecha1, 'days');
            if((String($scope.diferencia)!="NaN" && $scope.diferencia>1)&& $scope.reservacion.nombrehab!=undefined)
                console.log($scope.diferencia);
                $scope.reservacion.costo=$scope.diferencia*$scope.reservacion.nombrehab.preciohab;
        }



            $scope.guardarReservacion = function () {
            $scope.reservacion.habitacion=$scope.reservacion.nombrehab.nombrehab;
            $scope.reservacion.id_habitaciones=$scope.reservacion.nombrehab.id;
            $http.post('/saveReservaciones', $scope.reservacion).then(function(response) {
                $scope.reservacion.nombrehab.cantcuartos=$scope.reservacion.nombrehab.cantcuartos-1;
                $http.post('/actualizarHab/' + $scope.reservacion.nombrehab.id, $scope.reservacion.nombrehab).then(
                    function (response) {
                        console.log(response.status);
                        $scope.reservacion = {};
                        $scope.forms.frmReserva.$setPristine();
                    },
                        function (errorResponse) {

                        }
                    );
                },
                 function(errorResponse) {

                 }
            );
        }
    });
</script>