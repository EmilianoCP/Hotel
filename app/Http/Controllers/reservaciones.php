<?php

namespace App\Http\Controllers;

use App\habitacion;
use Illuminate\Http\Request;
use App\reservacion;

class reservaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function indexReservaciones()
    {
        $reservaciones = new reservacion();
        $datos = $reservaciones::all();
        return view('mostrarReservacion', compact('datos'));
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
        $datos=new reservacion();
        $datos->nombre=$request->input('nombre');
        $datos->apellido=$request->input('apellido');
        $datos->costo=$request->input('costo');
        $fecha = time() - strtotime($request->input('fechanac'));
        $edad = floor($fecha / 31556926);
        $datos->edad=$edad;
        $datos->id_habitaciones=$request->input('id_habitaciones');
        $datos->fechanac=$request->input('fechanac');
        $datos->inicioreserva=$request->input('inicioreserva');
        $datos->finreserva=$request->input('finreserva');
        $datos->habitacionName=$request->input('habitacion');
        $datos->save();
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
