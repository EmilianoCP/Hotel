<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\habitacion;

class habitaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitaciones = new habitacion();
        $datos = $habitaciones::all();
        return view('agregarHabitacion', compact('datos'));
    }
    public function indexHabitaciones()
    {
        $habitaciones = new habitacion();
        $datos = $habitaciones::all();
        return view('mostrarHabitacion', compact('datos'));
    }
    public function indexReservaciones()
    {
        $habitaciones = new habitacion();
        $datos = $habitaciones::all();
        return view('altaReservas', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datos = new habitacion();
        $datos->nombrehab = $request->nombrehab;
        $datos->tipocama =  $request->tipocama;
        $datos->cantcamas =  $request->cantcamas;
        $datos->cantcuartos =  $request->cantcuartos;
        $datos->preciohab =  $request->precio;
        $datos->save();
        return $datos->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $habitacion = habitacion::find($id);
        $habitacion->cantcuartos = $request->cantcuartos;
        $habitacion->cantcamas = $request->cantcamas;
        $habitacion->preciohab = $request->preciohab;
        $habitacion->save();
    }
    public function updateCuartos(Request $request, $id)
    {
        //
        $habitaciones = habitacion::find($id);
        $habitaciones->cantcuartos = $request->cantcuartos;
        $habitaciones->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
