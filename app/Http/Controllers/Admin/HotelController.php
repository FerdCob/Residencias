<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::latest('idHotel')
            ->paginate(10);

        return view('admin.hoteles.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.hoteles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:50|unique:hoteles,nombre',
            'direccion' => 'required|string|max:100',
            'contacto' => 'required|string|max:30',
        ]);
        Hotel::create($request->all());

        session()->flash('swal', [
            'title' => 'Hotel creado',
            'text' => 'El hotel se ha creado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.hoteles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //return $hotel;
        //$hotel = Hotel::findOrFail($id); // Busca el hotel por ID o lanza un error si no se encuentra
        return view('admin.hoteles.edit', compact('hotel')); // Devuelve la vista con el hotel
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {


        // $hotel = Hotel::findOrFail($id); // Busca el hotel por ID

        $request->validate([
            'nombre' => 'required|string|max:50|unique:hoteles,nombre,' . $hotel->idHotel . ',idHotel', // Excluir el hotel actual
            'direccion' => 'required|string|max:100',
            'contacto' => 'required|string|max:30',
        ]);

        // $hotel = Hotel::findOrFail($id); // Busca el hotel por ID o lanza un error si no se encuentra
        $hotel->update($request->all());

        session()->flash('swal', [
            'title' => 'Hotel actualizado',
            'text' => 'El hotel se ha actualizado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.hoteles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        // return $id;
        // $hotel = Hotel::findOrFail($id); // Busca el hotel por ID o lanza un error si no se encuentra
        $hotel->delete();

        session()->flash('swal', [
            'title' => 'Hotel eliminado',
            'text' => 'El hotel se ha eliminado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.hoteles.index');
    }
}
