<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Imports\MaterialImport;
use App\Models\Material;
use App\Models\MaterialGastado;
use App\Models\Rubro;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\Models\Historial;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:materiales.index');
    }
     
    public function index()
    {
        //
        $materiales = Material::all();
        return view('materiales.index', compact('materiales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rubros = Rubro::all();
        return view('materiales.create', compact('rubros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        //
        Material::create($request->all());
        Historial::create([
            'data' => "El material ".$request->descripcion. " ha sido creado",
            'user_id' => Auth::user()->id,
            'accion' => 'create',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('materiales.index')->with('exito', "El material ha sido creado con exito!");
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
        $material = Material::findOrFail($id);
        $rubros = Rubro::all();
        return view('materiales.edit', compact('material', 'rubros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, $id)
    {
        //
        $material = Material::findOrFail($id);
        $olddata = $material->descripcion;
        $material->rubro_id = $request->rubro_id;
        $material->descripcion = $request->descripcion;
        $material->unidad = $request->unidad;
        $material->update();
        Historial::create([
            'data' => "El material ".$olddata. " ha sido cambiado por ".$request->descripcion,
            'user_id' => Auth::user()->id,
            'accion' => 'update',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('materiales.index')->with('exito', "El material ha sido actualizado con exito!");
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
        $material = Material::findOrFail($id)->descripcion;
        Material::destroy($id);
        Historial::create([
            'data' => "El material ".$material. " ha sido eliminado",
            'user_id' => Auth::user()->id,
            'accion' => 'destroy',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('materiales.index')->with('exito', "El material ha sido eliminado con exito!");
    }
    public function CargarExcel(Request $request){
        $request->validate([
            'archivo' => 'required|mimes:xlsx'
        ]);
        try{
            $file = $request->file('archivo');
            Excel::import(new MaterialImport, $file);
            return redirect()->route('materiales.index')->with('exito', "Se ha cargado el EXCEL con exito!");
        }catch(\Exception $e){
            return redirect()->route('materiales.index')->with('error', $e->getMessage());
        }
    }
}
