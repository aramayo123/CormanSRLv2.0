<?php

namespace App\Http\Controllers;


use App\Models\Rubro;
use Illuminate\Http\Request;
use App\Http\Requests\RubroRequest;
use App\Imports\RubroImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\Models\Historial;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:rubros.index');
    }

    public function index()
    {
        //
        $rubros = Rubro::all();
        return view('rubros.index', compact('rubros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rubros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RubroRequest $request)
    {
        //
        Rubro::create($request->all());
        Historial::create([
            'data' => "El rubro ".$request->rubro. " ha sido creado",
            'user_id' => Auth::user()->id,
            'accion' => 'create',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('rubros.index')->with('exito', "El rubro ha sido creado con exito!");
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
        $rubro = Rubro::findOrFail($id);
        return view('rubros.edit', compact('rubro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RubroRequest $request, $id)
    {
        $rubro = Rubro::findOrFail($id);
        $olddata = $rubro->rubro;
        $rubro->rubro = $request->rubro;
        $rubro->update();
        Historial::create([
            'data' => "El rubro ".$olddata. " ha sido cambiado por ".$request->rubro,
            'user_id' => Auth::user()->id,
            'accion' => 'update',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('rubros.index')->with('exito', "El rubro ha sido actualizado con exito!");
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
        $rubro = Rubro::findOrFail($id)->rubro;
        Rubro::destroy($id);
        Historial::create([
            'data' => "El rubro ".$rubro. " ha sido eliminado",
            'user_id' => Auth::user()->id,
            'accion' => 'destroy',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return redirect()->route('rubros.index')->with('exito', "El rubro ha sido eliminado con exito!");
    }
    public function CargarExcel(Request $request){
        $request->validate([
            'archivo' => 'required|mimes:xlsx'
        ]);
        try{
            $file = $request->file('archivo');
            Excel::import(new RubroImport, $file);
            return redirect()->route('rubros.index')->with('exito', "Se ha cargado el EXCEL con exito!");
        }catch(\Exception $e){
            return redirect()->route('rubros.index')->with('error', $e->getMessage());
        }
    }
}
