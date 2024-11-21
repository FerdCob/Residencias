<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $evidences = Evidence::where('id_hotel', Auth::user()->hotel->idHotel)
            ->Latest('id')
            ->paginate(10);

        return view('admin.evidencias.index', compact('evidences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $evidences = Evidence::all();
        // return $evidences;


        return view('admin.evidencias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return 'store';
        $request->validate([
            'title' => 'required|string|max:50|unique:evidenciasimg,title',
            'slug_image' => 'required|string|max:50|unique:evidenciasimg,slug_image',
            'fecha' => 'required|date',
            'descripcion' => 'string|max:100',


            //'id_hotel' => 'exists:hoteles,idHotel',
        ]);
        //$hotelId = auth()->user()->hotel->idHotel;
        //return $hotelId;
        //return $request;
        $evidence = Evidence::create($request->all());

        session()->flash('swal', [
            'title' => 'Evidencia creada',
            'text' => 'La evidencia se ha creado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.evidencias.edit', $evidence);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evidence $evidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evidence $evidencia)
    {
        Gate::authorize('author', $evidencia);

        // return $evidencia;
        //$evidence = Evidence::find($id); // Buscar la evidencia manualmente usando el ID
        // return $evidence; // Devuelve para comprobar si el objeto es correcto
        return view('admin.evidencias.edit', compact('evidencia')); // Devuelve la vista con la evidencia
    }

    // public function edit(Evidence $evidence)
    // {
    //     return $evidence;
    //     //$evidence = Evidence::findOrFail($id);
    //     // Busca la evidencia por ID o lanza un error si no se encuentra
    //     return view('admin.evidencias.edit', compact('evidence'));
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evidence $evidencia)
    {
        // return $evidencia;
        //$evidence = Evidence::find($id); // Buscar la evidencia manualmente usando el ID
        //return request();
        $request->validate([
            'title' => 'required|string|max:50|unique:evidenciasimg,title,' . $evidencia->id .  ',id',
            'slug_image' => 'required|string|max:50|unique:evidenciasimg,slug_image,' . $evidencia->id . ',id',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:100',
            'image' => 'nullable|image',
        ]);
        // return "paso validacion";
        // return $request;
        $data = $request->all();

        // if ($request->file('image')) {
        //     $data['image_path'] = Storage::put('Evidencias', $request->file('image'));
        // }
        if ($request->file('image')) {
            if ($evidencia->image_path) {
                Storage::delete($evidencia->image_path);
            }
            $file_name = request()->slug_image . '.' . $request->file('image')->getClientOriginalExtension();
            //Forma 1 de guardar la imagen con nombre unico
            //     $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name);
            //Forma 2 de guardar la imagen con nombre unico(storeAs)
            $data['image_path'] = $request->file('image')->storeAs('Evidencias', $file_name);
        }
        $evidencia->update($data);

        session()->flash('swal', [
            'title' => 'Evidencia actualizada',
            'text' => 'La evidencia se ha actualizado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.evidencias.index', $evidencia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evidence $evidencia)
    {
        $evidencia->delete();

        session()->flash('swal', [
            'title' => 'Evidencia eliminada',
            'text' => 'La evidencia se ha eliminado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.evidencias.index');
    }
    // {
    //     $evidence = Evidence::find($id); // Buscar la evidencia manualmente usando el ID
    //     $evidence->delete();

    //     session()->flash('swal', [
    //         'title' => 'Evidencia eliminada',
    //         'text' => 'La evidencia se ha eliminado correctamente',
    //         'icon' => 'success'
    //     ]);

    //     return redirect()->route('admin.evidencias.index');
    // }
}
