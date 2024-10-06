<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RubroController;
use App\Http\Requests\MaterialesGastadosRequest;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Imagen;
use App\Models\Material;
use App\Models\MaterialGastado;
use App\Models\Prioridad;
use App\Models\Sucursal;
use App\Models\Tarea;
use App\Models\TareaAsignada;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Madzipper\Zipper;
use Madnest\Madzipper\Madzipper;
use Jenssegers\Date\Date;
use App\Models\Historial;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/historial', function (){
    $historiales = Historial::all();
    return view('historial', compact('historiales'));
})->middleware('auth')->name('historial');

Route::post('/notificar_all', function (Request $request){
    $tareas = Tarea::where('estado_id', '!=', '2')->get();
   
    $cuerpo = "";
    $sucursales = [];
    foreach($tareas as $tarea){
        $personales = "";
        $personal_asignado = TareaAsignada::where('tarea_id', $tarea->id)->get();
        foreach($personal_asignado as $personal){
            $personales .= $personal->User->name."\n";
        }
        $sucursal = "Suc. ".$tarea->Sucursal->numero. " ". $tarea->Sucursal->sucursal."\n";
        if($tarea->tipo_de_tarea == "PREVENTIVO")
            $descripcion = "•	Visita preventiva"."\n";
        else    
            $descripcion = "•	".$tarea->ticket.", ".$tarea->descripcion."\n";

        $cuerpo .= "$personales$sucursal $descripcion\n";
    }
    $mensaje = "Personal Asignado: Salta capital \n$cuerpo";

    $params=array(
        'token' => 'ro2lstpspu9c58wb',
        'to' => '120363313705319582@g.us',
        'body' => $mensaje,
        'priority' => '',
        'referenceId' => '',
        'msgId' => '',
        'mentions' => ''
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance89273/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return response()->json([
            'message' => 'error',
            'error' => "cURL Error #: $err"
        ]);
    } else {
        Historial::create([
            'data' => "Notificacion de todas las tareas",
            'user_id' => Auth::user()->id,
            'accion' => 'noticar_all',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);


        return response()->json([
            'message' => 'exito',
            'response' => $response
        ]);
    }
});

Route::post('/notificar_tarea', function (Request $request){
    $id_tarea = $request->id_tarea;
    $tarea = Tarea::findOrFail($id_tarea);
    if($tarea->estado_id == 2)
        return response()->json([
            'message' => 'error',
            'error' => "Esta tarea ya fue cerrada"
        ]);

    $personales = "";
    $personal_asignado = TareaAsignada::where('tarea_id', $tarea->id)->get();
    foreach($personal_asignado as $personal){
        $personales .= $personal->User->name."\n";
    }
    $sucursal = "Suc. ".$tarea->Sucursal->numero. " ". $tarea->Sucursal->sucursal."\n";
    if($tarea->tipo_de_tarea == "PREVENTIVO")
        $descripcion = "•	Visita preventiva"."\n";
    else    
        $descripcion = "•	".$tarea->ticket.", ".$tarea->descripcion."\n";

    $cuerpo = "$personales$sucursal $descripcion\n";
    $mensaje = "Personal Asignado: Salta capital \n$cuerpo";

    $params=array(
        'token' => 'ro2lstpspu9c58wb',
        'to' => '120363313705319582@g.us',
        'body' => $mensaje,
        'priority' => '',
        'referenceId' => '',
        'msgId' => '',
        'mentions' => ''
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance89273/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return response()->json([
            'message' => 'error',
            'error' => "cURL Error #: $err"
        ]);
    } else {
        Historial::create([
            'data' => "Notificacion a todos los operarios de la tarea $tarea->ticket",
            'user_id' => Auth::user()->id,
            'accion' => 'noticar_all',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);
        return response()->json([
            'message' => 'exito',
            'response' => $response
        ]);
    }
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $re = TareaAsignada::where('user_id', Auth::user()->id)->get()->reverse()->values();
        $tareasAsignadas = [];
        foreach($re as $tarea){
            if($tarea->Tarea->Estado->numero == 2)
                continue;
            else
                array_push($tareasAsignadas, $tarea);
        }
        $tareas = Tarea::all();
        $clientes = Cliente::all();
        $sucursales = Sucursal::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $users = User::all();
        $materiales = Material::all();
        $materialesGastados = [];
        $ra = MaterialGastado::all();
        foreach($ra as $material){
            if(!$material->Tarea->fecha_cerrado)
                continue;
            
            $mes = explode("-",$material->Tarea->fecha_cerrado);
            if($mes[1] == now()->month)
                array_push($materialesGastados, $material);
        }
        $all_tareas = Tarea::whereMonth('fecha_cerrado', now()->month)->where('estado_id', '2')->orderBy('created_at')->get();

        $total_correctivos = count(Tarea::whereMonth('fecha_cerrado', now()->month)->where('atm', NULL)->where('estado_id', '2')->orderBy('created_at')->get());
        $total_atm = count(Tarea::whereMonth('fecha_cerrado', now()->month)->where('atm', '1')->where('estado_id', '2')->orderBy('created_at')->get());
        $total_altas = count(Tarea::whereMonth('fecha_cerrado', now()->month)->where('prioridad_id', '1')->where('estado_id', '2')->orderBy('created_at')->get());
        $total_medias = count(Tarea::whereMonth('fecha_cerrado', now()->month)->where('prioridad_id', '2')->where('estado_id', '2')->orderBy('created_at')->get());
        $total_bajas = count(Tarea::whereMonth('fecha_cerrado', now()->month)->where('prioridad_id', '3')->where('estado_id', '2')->orderBy('created_at')->get());
        return view('index', compact(
            'tareasAsignadas', 
            'tareas', 'clientes',
            'sucursales', 'prioridades',
            'users', 'estados', 
            'total_correctivos', 
            'total_atm',
            'total_altas',
            'total_medias',
            'total_bajas',
            'all_tareas',
            'materiales',
            'materialesGastados',
        ));
    })->name('dashboard');
   
   
    Route::resource('/clientes', ClienteController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/sucursales', SucursalController::class);
    Route::resource('/materiales', MaterialController::class);
    Route::resource('/rubros', RubroController::class);

    Route::resource('/tareas', TareaController::class);
    Route::get('/tareas/{id}/completar', [TareaController::class, 'CompletarTarea']);
    Route::post('/tareas/{id}/cerrar', [TareaController::class, 'CerrarTarea']);
    Route::post('/tareas/materiales', [TareaController::class, 'CargarMaterial']);
    Route::delete('/tareas/materiales/{id}', [TareaController::class, 'EliminarMaterial']);
    Route::post('/tareas/fotos_ot', [TareaController::class, 'FotosOt']);
    Route::post('/tareas/fotos_boleta', [TareaController::class, 'FotosBoleta']);
    Route::post('/tareas/fotos_trabajo', [TareaController::class, 'FotosTrabajo']);
    Route::post('/tareas/fotos_preventivo', [TareaController::class, 'FotosPreventivo']);
    Route::post('/tareas/fotos_planilla', [TareaController::class, 'FotosPlanillaPreventivo']);
    Route::post('/tareas/imagenes', function (Request $request){
        $imagenes = Imagen::where('tarea_id', $request->tarea_id)->orderBy('created_at')->get();
        return response()->json(['message' => $imagenes]);
    });
    Route::post('tareas/eliminar', function (Request $request){
        $imagen = Imagen::findOrFail($request->imagen_id);
        $imagen_name = $imagen->nombre;
        $tarea = Tarea::findOrFail($imagen->tarea_id);
        if(Storage::exists("public/".substr($imagen->url, 8)))
            Storage::delete("public/".substr($imagen->url, 8));
        
        Imagen::destroy($request->imagen_id);
        
        $mesActual = TareaController::ObtenerMes($tarea->fecha_mail);
        if($tarea->tipo_de_tarea == "CORRECTIVO") 
            $data = "La imagen $imagen_name del ticket $tarea->ticket ha sido eliminada";
        else    
            $data = "La imagen ".$imagen_name. " del preventivo ".$tarea->Sucursal->numero." ".$tarea->Sucursal->sucursal." de $mesActual ha sido eliminada";

        Historial::create([
            'data' => $data,
            'user_id' => Auth::user()->id,
            'accion' => 'destroy',
            'fecha' => Date::now()->format('l j F Y'),
            'hora' => now()->isoFormat('H:mm:ss A')
        ]);

        return response()->json(['message' => "exito"]);
    });
    Route::post('/download', function (Request $request) {
        if(!Storage::exists("public/$request->folder")){
            return response()->json([
                'success' => 'ERROR',
                'url' => 'La descarga no se pudo completar debido a que la carpeta no contiene archivos.',
            ]);
        }
        $folderPath = $request->folder;
        $zip = new Madzipper();
        $zip->make('zips/'.$request->remedit.'.zip')->addDir('storage/'.$folderPath);
        $url = asset(asset('zips/'.$request->remedit.'.zip'));
        return response()->json([
            'success' => 'Archivo ZIP creado y guardado correctamente.',
            'url' => $url,
        ]);
    });

    Route::post('/materiales_gastados', [TareaController::class, 'ObtenerMateriales']);  
    
    Route::post('/sucursales/importar', [SucursalController::class, 'CargarExcel']);
    Route::post('/clientes/importar', [ClienteController::class, 'CargarExcel']);
    Route::post('/materiales/importar', [MaterialController::class, 'CargarExcel']); 
    Route::post('/tareas/importar', [TareaController::class, 'CargarExcel']); 
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'UpdateAvatar'])->name('profile.updateavatar');



});

require __DIR__.'/auth.php';
