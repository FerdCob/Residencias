<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form\SeccionFive\SeccionVolumetrico5;
use App\Models\Form\SeccionFour\SeccionVolumetrico4;
use App\Models\Form\SeccionOne\SeccionGeneracion1;
use App\Models\Form\SeccionSix\SeccionValorizables;
use App\Models\Form\SeccionThree\SeccionValorsub3;
use App\Models\Form\SeccionTwo\SeccionCantidad2;
use App\Models\Form\SeccionTwo\SeccionTotal2;
use App\Models\Hotel;
use App\Services\FormValidationService;
use App\Services\GentotalService;
use App\Services\NovalorService;
use App\Services\PercapitaService;
use App\Services\PersonaService;
use App\Services\SubproductoService;
use App\Services\ValorizablesService;
use App\Services\ValorSec5Service;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $GentotalService;
    protected $PersonService;
    protected $PercapitaService;
    protected $SubproductoService;
    protected $NovalorService;
    protected $ValorSec5Service;
    protected $ValorizablesService;
    protected $ConsultaGenTotal;

    public function __construct(
        GentotalService $GentotalService,
        PersonaService $PersonService,
        PercapitaService $PercapitaService,
        SubproductoService $SubproductoService,
        NovalorService $NovalorService,
        ValorSec5Service $ValorSec5Service,
        ValorizablesService $ValorizablesService,
    ) {
        $this->GentotalService = $GentotalService;
        $this->PersonService = $PersonService;
        $this->PercapitaService = $PercapitaService;
        $this->SubproductoService = $SubproductoService;
        $this->NovalorService = $NovalorService;
        $this->ValorSec5Service = $ValorSec5Service;
        $this->ValorizablesService = $ValorizablesService;
    }

    public function index()
    {
        $hotelId = Auth::user()->hotel->idHotel;

        // Obtener los últimos registros por fecha
        $posts = SeccionGeneracion1::select(DB::raw('*, DATE(fecha) as fecha_dia'))
            ->where('idHotel', $hotelId)
            ->whereIn('id_secTotal', function ($query) use ($hotelId) {
                $query->select(DB::raw('MAX(id_secTotal)'))
                    ->from('sec1gtotal')
                    ->where('idHotel', $hotelId)
                    ->groupBy(DB::raw('DATE(fecha)'));
            })
            ->latest('fecha')
            ->paginate(10);
        //con Compact se envia la variable posts a la vista
        // Obtener el hotel actual por ID del usuario autenticado
        $hotel = Hotel::find(Auth::user()->hotel->idHotel);

        return view('admin.forms.index', compact('posts', 'hotel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Consulta para obtener el hotel asociado

        $namehotel = Auth::user()->hotel->nombre; // Asegúrate de que el usuario está autenticado y tiene un hotel

        return view('admin.forms.create', compact('namehotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FormValidationService $validationService)
    {

        // Validar los datos usando el servicio
        $validationService->validateStoreRequest($request->all());

        //return $request->all();
        DB::beginTransaction();
        try {
            // Llamada al servicio para preparar los datos, descomentar al finalizar la implementación
            $insert_data = $this->GentotalService->prepararDatosResiduos($request); // Inserción en la base de datos
            SeccionGeneracion1::insert($insert_data); // Descomenta esta línea si deseas insertar los datos en la base de datos
            // return $insert_data;

            $insert_personal = $this->PersonService->prepararDatosPersona($request); // Inserción en la base de datos
            SeccionCantidad2::insert($insert_personal); // Descomenta esta línea si deseas insertar los datos en la base de datos
            // return $insert_personal;

            $insert_percapita = $this->PercapitaService->prepararDatosPercapita($request); // Inserción en la base de datos
            SeccionTotal2::insert($insert_percapita); // Descomenta esta línea si deseas insertar los datos en la base de datos
            //return $insert_percapita;

            $insert_subproductos = $this->SubproductoService->prepararDatosSubproductos($request); // Inserción en la base de datos
            SeccionValorsub3::insert($insert_subproductos); // Descomenta esta línea si deseas insertar los datos en la base de datos
            // return $insert_subproductos;

            $insert_noValor = $this->NovalorService->prepararDatosNovalor($request); // Inserción en la base de datos
            //return $insert_noValor;
            SeccionVolumetrico4::insert($insert_noValor); // Descomenta esta línea si deseas insertar los datos en la base de datos

            $insert_Sec5 = $this->ValorSec5Service->prepararDatosValor($request); // Inserción en la base de datos
            //return $insert_data;
            SeccionVolumetrico5::insert($insert_Sec5); // Descomenta esta línea si deseas insertar los datos en la base de datos

            $insert_valorizable = $this->ValorizablesService->prepararDatosValorizable($request); // Inserción en la base de datos
            //return $insert_valorizable;
            SeccionValorizables::insert($insert_valorizable); // Descomenta esta línea si deseas insertar los datos en la base de datos

            // Confirma la transacción
            DB::commit();

            session()->flash('swal', [
                'title' => 'Registro creado',
                'text' => 'El registro se ha creado correctamente',
                'icon' => 'success'
            ]);
            return redirect()->route('admin.forms.index');
        } catch (\Exception $e) {
            // En caso de error, se cancela la transacción
            DB::rollback();
            return redirect()->back()->withErrors('Error en la inserción de datos.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Capturar la fecha desde el query string
        $fecha = request()->query('fecha');
        $hotel = Auth::user()->hotel;

        //Considerar cambiar esto a servicios por seccion,
        //para no tener que hacer tantas consultas en el controlador
        //Y mantener limpio el código (Controller)

        //Consulta Seccion 1 Restaurante
        $alires = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 4)->where('id_tiporesiduo', 16)->where('fecha', $fecha)->pluck('valorkg')->first();
        $comres = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 4)->where('id_tiporesiduo', 17)->where('fecha', $fecha)->pluck('valorkg')->first();
        $inores = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 4)->where('id_tiporesiduo', 18)->where('fecha', $fecha)->pluck('valorkg')->first();
        $inonores = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 4)->where('id_tiporesiduo', 19)->where('fecha', $fecha)->pluck('valorkg')->first();
        //Consulta Seccion 2 Habitaciones
        $inohab = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 6)->where('id_tiporesiduo', 18)->where('fecha', $fecha)->pluck('valorkg')->first();
        $sanhab = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 6)->where('id_tiporesiduo', 21)->where('fecha', $fecha)->pluck('valorkg')->first();
        //Consulta Seccion 3 Areas comunes
        $sancom = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 5)->where('id_tiporesiduo', 19)->where('fecha', $fecha)->pluck('valorkg')->first();
        $orgcom = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 5)->where('id_tiporesiduo', 20)->where('fecha', $fecha)->pluck('valorkg')->first();
        $inocom = SeccionGeneracion1::where('idHotel', $hotel->idHotel)->where('id_nomseccion', 5)->where('id_tiporesiduo', 18)->where('fecha', $fecha)->pluck('valorkg')->first();
        //Calculo de totales
        $totalres = ($alires ?? 0) + ($comres ?? 0) + ($inores ?? 0) + ($inonores ?? 0);
        $totalhab = ($inohab ?? 0) + ($sanhab ?? 0);
        $totalcom = ($sancom ?? 0) + ($orgcom ?? 0) + ($inocom ?? 0);
        $totalgen = $totalres + $totalhab + $totalcom;

        //Consulta Seccion 2 Cantidad de personas
        $hab = SeccionCantidad2::where('idHotel', $hotel->idHotel)->where('id_tpercapita', 1)->where('fecha', $fecha)->pluck('cantidad')->first();
        $hue = SeccionCantidad2::where('idHotel', $hotel->idHotel)->where('id_tpercapita', 2)->where('fecha', $fecha)->pluck('cantidad')->first();
        $per = SeccionCantidad2::where('idHotel', $hotel->idHotel)->where('id_tpercapita', 3)->where('fecha', $fecha)->pluck('cantidad')->first();
        //Consulta Seccion 2 Per Capita
        $per1 = SeccionTotal2::where('idHotel', $hotel->idHotel)->where('fecha', $fecha)->pluck('percapita1')->first();
        $per2 = SeccionTotal2::where('idHotel', $hotel->idHotel)->where('fecha', $fecha)->pluck('percapita2')->first();

        //Consulta Seccion 3 Subproductos
        $car = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 1)->where('fecha', $fecha)->pluck('valorkg')->first();
        $pap = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 2)->where('fecha', $fecha)->pluck('valorkg')->first();
        $alu = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 3)->where('fecha', $fecha)->pluck('valorkg')->first();
        $met = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 4)->where('fecha', $fecha)->pluck('valorkg')->first();
        $pet = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 5)->where('fecha', $fecha)->pluck('valorkg')->first();
        $rig = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 6)->where('fecha', $fecha)->pluck('valorkg')->first();
        $jar = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 7)->where('fecha', $fecha)->pluck('valorkg')->first();
        $ali = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 8)->where('fecha', $fecha)->pluck('valorkg')->first();
        $com = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 9)->where('fecha', $fecha)->pluck('valorkg')->first();
        $san = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 10)->where('fecha', $fecha)->pluck('valorkg')->first();
        $nva = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 11)->where('fecha', $fecha)->pluck('valorkg')->first();
        $mes = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 12)->where('fecha', $fecha)->pluck('valorkg')->first();
        $pel = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 13)->where('fecha', $fecha)->pluck('valorkg')->first();
        $vid = SeccionValorsub3::where('idHotel', $hotel->idHotel)->where('id_subproductos', 14)->where('fecha', $fecha)->pluck('valorkg')->first();
        $totalsub = $car + $pap + $alu + $met + $pet + $rig + $jar + $ali + $com + $san + $nva + $mes + $pel + $vid;

        //Consulta Seccion 4 Valorizables(peso)
        $vre = SeccionVolumetrico4::where('idHotel', $hotel->idHotel)->where('id_peso', 1)->where('fecha', $fecha)->pluck('valorkg')->first();
        $pne = SeccionVolumetrico4::where('idHotel', $hotel->idHotel)->where('id_peso', 4)->where('fecha', $fecha)->pluck('valorkg')->first();
        $pvo = SeccionVolumetrico4::where('idHotel', $hotel->idHotel)->where('id_peso', 5)->where('fecha', $fecha)->pluck('valorkg')->first();

        //Consulta Seccion 5 No Valorizables(peso)
        $nvro = SeccionVolumetrico5::where('idHotel', $hotel->idHotel)->where('id_peso', 1)->where('fecha', $fecha)->pluck('valorkg')->first();
        $npne = SeccionVolumetrico5::where('idHotel', $hotel->idHotel)->where('id_peso', 4)->where('fecha', $fecha)->pluck('valorkg')->first();
        $npvo = SeccionVolumetrico5::where('idHotel', $hotel->idHotel)->where('id_peso', 5)->where('fecha', $fecha)->pluck('valorkg')->first();

        //Consulta Seccion 6 Total Valorizables
        $tval = SeccionValorizables::where('idHotel', $hotel->idHotel)->where('fecha', $fecha)->get(['semana', 'dia', 'valorkg'])->first();


        //return $hotel->idHotel;
        //return view('admin.forms.show', compact('hotel->idHotel'));

        return view('admin.forms.show', compact(
            'hotel',
            'fecha',
            'alires',
            'comres',
            'inores',
            'inonores',
            'totalres',
            'inohab',
            'sanhab',
            'totalhab',
            'sancom',
            'orgcom',
            'inocom',
            'totalcom',
            'totalgen',
            'hab',
            'hue',
            'per',
            'per1',
            'per2',
            'car',
            'pap',
            'alu',
            'met',
            'pet',
            'rig',
            'jar',
            'ali',
            'com',
            'san',
            'nva',
            'mes',
            'pel',
            'vid',
            'totalsub',
            'vre',
            'pne',
            'pvo',
            'nvro',
            'npne',
            'npvo',
            'tval'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}