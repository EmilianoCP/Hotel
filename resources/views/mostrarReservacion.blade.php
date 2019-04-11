<!doctype html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Reservaciones</title>
    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body ng-controller="ctrl">

<form name="frmLibro">
    <br><br>
    <div class="container">
        <div class="container" style="background: #000000; padding: .2em;color: white;">
            <h1>Reservaciones</h1>
        </div>
        <br><br>
        <table class="table table-hover" ng-show="mostrartabla == true">
            <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>EDAD</th>
                <th>TIPO DE HABITACION</th>
                <th>ENTRADA</th>
                <th>SALIDA</th>
                <th>TOTAL</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($datos as $reservacion)
                <tr>
                    <td>{{$reservacion->id}}</td>
                    <td>{{$reservacion->nombre}}</td>
                    <td>{{$reservacion->apellido}}</td>
                    <td>{{$reservacion->edad}}</td>
                    <td>{{$reservacion->habitacionName}}</td>
                    <td>{{date('d/m/Y',strtotime($reservacion->inicioreserva))}}</td>
                    <td>{{date('d/m/Y',strtotime($reservacion->finreserva))}}</td>
                    <td>${{$reservacion->costo}}</td>
                    <td>
                        <button class="btn btn-danger" ng-click="mandarBaja({{$reservacion}})">Eliminar</button>
                    </td>
                    <td>
                        <button class="btn btn-warning" ng-click="mandarDatos({{$reservacion}})">Modificar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div ng-show="mostrarUpdate == true">
            <div class="form-group col-md-4">
                <input type="text" ng-model="res.habitacionName" class="form-control" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Habitacion</label>
                <select ng-model="res.habName" ng-change="calculoCosto()"  ng-options="x.nombrehab for x in habs" class="form-control" required>
                    <option value="">selecciona una habitacion</option>
                </select>
                <!--<input type="text" ng-model="res.habitacionName" class="form-control" disabled>-->
            </div>
            <!--<div class="form-row">-->
            <div class="form-group col-md-4">
                <label>fecha inicio</label>
                <input type="date" ng-model="res.inicioreserva" class="form-control" disabled>
            </div>
            <div class="form-group col-md-4">
                <label>fecha fin</label>
                <input type="date" min="@{{minn}}" ng-change="calculoCosto()" ng-model="res.finreserva" class="form-control">
            </div>
            <!--</div>-->
            <div class="form-group col-md-2">
                <label>costo</label>
                <input type="text" ng-model="res.costo" class="form-control" disabled>
                <br>
                <button type="button" ng-click="updateRes()" class="btn btn-primary">Aceptar</button>
            </div>
        </div>

        <!-- PARTE DAR DE BAJA -->
        <div ng-show="mostrarbaja == true">
            <div class="form-group col-md-2">
                <label>Habitacion</label>
                <input type="text" ng-model="baja_r.habitacionName" class="form-control" disabled>
            </div>
            <!--<div class="form-row">-->
            <div class="form-group col-md-4">
                <label>fecha inicio</label>
                <input type="date" ng-model="baja_r.inicioreserva" class="form-control" disabled>
            </div>
            <div class="form-group col-md-4" ng-show="fechafin == false">
                <label>fecha fin</label>
                <input type="date" ng-model="baja_r.finreserva" class="form-control" disabled>
            </div>
            <!--</div>-->
            <div class="form-group col-md-2">
                <label>costo Generado</label>
                <input type="text" ng-model="baja_r.costo_g" class="form-control" disabled>
                <br>
                <button type="button" ng-click="difDias()" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        <!-- FIN DE PARTE DAR DE BAJA -->

        <button type="button" class="btn btn-secondary" style="float: right"><a
                    href="{{url('/reservaciones')}}">Regresar</a></button>
        <!--<select ng-model="hola.xx" ng-options="x.nombrehab for x in data" class="form-control">
            <option value="">Selecciona una Habitacion</option>
        </select>-->

    </div>
</form>


<script src="{{asset('js/angular.js')}}" type="text/javascript"></script>
<script src="{{asset('js/moment.js')}}" type="text/javascript"></script>
</body>
</html>
<script>
    var app = angular.module('app', []).controller('ctrl', function ($scope, $http, $filter) {
        $scope.mostrartabla = true;
        $scope.b;
        $scope.reservaciones;

        $scope.habs = {!! json_encode($hab) !!};
        console.log($scope.habs[0].preciohab);

        $scope.mandarBaja = function (datos) {
            let fecha = new Date();
            $scope.mostrarbaja = true;
            $scope.mostrarUpdate = false;
            $scope.datoss = datos;
            console.log(fecha);
            datos.inicioreserva = new Date($filter('date')($scope.datoss.inicioreserva));
            datos.finreserva = new Date($filter('date')(fecha));
            $scope.baja_r = datos;
            if ($scope.baja_r.inicioreserva <= fecha) {
                $scope.fechafin = false;
                $scope.b = 0;
            } else {

                $scope.fechafin = true;
                $scope.b = 1;
            }
            console.log($scope.b);


        }
        $scope.mandarDatos = function (datos) {
            //$scope.mostrarbaja = true;

            $scope.mostrarUpdate = true;
            $scope.mostrarbaja = false;
            //$scope.mostrartabla = false;
            //console.log(datos);
            //$scope.hab = datos;
            //$scope.habitaciones = $scope.hab.cantcuartos;
            datos.inicioreserva = new Date($filter('date')(datos.inicioreserva));
            datos.finreserva = new Date($filter('date')(datos.finreserva));
            //$scope.min = new Date($filter('date')($scope.min));
            $scope.res = datos;
            $scope.fin = $scope.res.finreserva;
            //$scope.minn="2019-04-18";
            /*let dia,mes,ano;
            dia = (datos.inicioreserva.getDate() + 1);
            mes = (datos.inicioreserva.getMonth() + 1);
            ano = datos.inicioreserva.getFullYear();
            $scope.minn = ano + "-" + mes + "-" + dia;
            $scope.minn = new Date($filter('date')($scope.minn));
            console.log($scope.minn);*/
        }

        ////////////////////////////////////////bajas
        $scope.difDias = function () {
            if (confirm("¿Desea continuar?")) {
                if ($scope.b == 0) {
                    let fecha1 = moment($scope.baja_r.inicioreserva);
                    let fecha2 = moment($scope.baja_r.finreserva);
                    $scope.diferencia = fecha2.diff(fecha1, 'days');
                    console.log($scope.diferencia);
                    $scope.baja_r.costo_g = $scope.diferencia * $scope.habs[$scope.baja_r.id_habitaciones - 1].preciohab;
                    $scope.habs[$scope.baja_r.id_habitaciones - 1].cantcuartos++;
                    console.log($scope.habs[$scope.baja_r.id_habitaciones - 1].cantcuartos);
                    $http.post('/updatehab/' + $scope.baja_r.id_habitaciones, $scope.habs[$scope.baja_r.id_habitaciones - 1]).then(function (response) {
                            $http.post('/bajaReserva/' + $scope.baja_r.id).then(
                                function (response) {
                                    console.log(response.status);
                                    alert("costo generado por: " + $scope.baja_r.costo_g);
                                    location.reload();
                                },
                                function (errorResponse) {

                                }
                            );
                        },
                        function (errorResponse) {

                        });
                } else {
                    alert("sin costos");
                    $scope.habs[$scope.baja_r.id_habitaciones - 1].cantcuartos++;
                    $http.post('/updatehab/' + $scope.baja_r.id_habitaciones, $scope.habs[$scope.baja_r.id_habitaciones - 1]).then(function (response) {
                            $http.post('/bajaReserva/' + $scope.baja_r.id).then(
                                function (response) {
                                    console.log(response.status);
                                    location.reload();
                                },
                                function (errorResponse) {

                                }
                            );
                        },
                        function (errorResponse) {

                        });

                }
            }

        }
//////////////////////////////////////////////fin bajas

        /*$scope.darBaja = function () {
            //console.log($scope.baja);
            if (confirm("¿Desea continuar?")) {
                $scope.baja.cantcuartos--;
                $http.post('/darBaja/' + $scope.baja.id, $scope.baja).then(
                    function (response) {
                        console.log(response.status);
                        alert("baja por:" + $scope.baja.descripcion);
                        location.reload();
                    }, function (errorResponse) {

                    }
                )
            }

        }*/
        $scope.calculoCosto = function(){
            let fecha1 = moment($scope.res.inicioreserva);
            let fecha2 = moment($scope.res.finreserva);
            $scope.diferencia = fecha2.diff(fecha1, 'days');
            console.log($scope.diferencia);

            if($scope.diferencia<=0){
                alert("el fin de reservacion es igual o menor al inicio");
                $scope.res.finreserva = $scope.fin;
                console.log($scope.fin);
            }else{
                if ($scope.res.habName!=undefined) {
                    $scope.res.costo = $scope.diferencia * $scope.habs[$scope.res.habName.id - 1].preciohab;
                    $scope.res.habitacionName = $scope.res.habName.nombrehab;
                }else{
                    console.log("no entro");
                }

            }
        }
        $scope.calculohab = function(){
            console.log($scope.res.habName);
        }



        $scope.updateRes = function () {
            //console.log($scope.habitaciones);
                if (confirm("¿Desea continuar?")) {
                    $http.post('/updateRes/' + $scope.res.id, $scope.res).then(
                        function (response) {
                            console.log(response.status);
                            alert("se a actualizado la reservacion de : " + $scope.res.nombre);
                            location.reload();
                        }, function (errorResponse) {

                        }
                    )
                }


        }

    });
</script>