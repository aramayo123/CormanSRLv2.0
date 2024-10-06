<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Imports\SucursalImport;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\Models\Historial;

class SucursalController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:sucursales.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalRequest $request)
    {
        //
        Sucursal::create($request->all());
        Historial::create([
            'data' => "La sucursal ".$request->numero." ".$request->sucursal. " ha sido creada",
            'user_id' => Auth::user()->id,
            'accion' => 'create',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('sucursales.index')->with('exito', "La sucursal ha sido creada con exito!");
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
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalRequest $request, $id)
    {
        //
        $sucursal = Sucursal::findOrFail($id);
        $olddata = $sucursal->numero. " ". $sucursal->sucursal;
        $sucursal->zona = $request->zona;
        $sucursal->numero = $request->numero;
        $sucursal->sucursal = $request->sucursal;
        $sucursal->direccion = $request->direccion;
        $sucursal->update();
        Historial::create([
            'data' => "La sucursal ".$olddata. " ha sido cambiada por ".$request->numero." ".$request->sucursal,
            'user_id' => Auth::user()->id,
            'accion' => 'update',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('sucursales.index')->with('exito', "La sucursal ha sido actualizada con exito!");
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
        $sucursal = Sucursal::findOrFail($id)->numero." ".Sucursal::findOrFail($id)->sucursal;
        Sucursal::destroy($id);
        Historial::create([
            'data' => "La sucursal ".$sucursal. " ha sido eliminada",
            'user_id' => Auth::user()->id,
            'accion' => 'destroy',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('sucursales.index')->with('exito', "La sucursal ha sido eliminada con exito!");
    }
    public function CargarExcel(Request $request){
        $request->validate([
            'archivo' => 'required|mimes:xlsx'
        ]);
        try{
            $file = $request->file('archivo');
            Excel::import(new SucursalImport, $file);
            return redirect()->route('sucursales.index')->with('exito', "Se ha cargado el EXCEL con exito!");
        }catch(\Exception $e){
            return redirect()->route('sucursales.index')->with('error', $e->getMessage());
        }
    }
}
