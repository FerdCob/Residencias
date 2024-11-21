<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subproducto;
use Illuminate\Http\Request;

class SubproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subproductos = Subproducto::latest('id_subproducto')
            ->paginate();
        // return $subproductos;

        return view('admin.subproductos.index', compact('subproductos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subproductos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:30|unique:subproductos,tipo',
        ]);
        Subproducto::create($request->all());

        session()->flash('swal', [
            'title' => 'Subproducto creado',
            'text' => 'El subproducto se ha creado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.subproductos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subproducto $subproducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subproducto $subproducto)
    {
        // return $subproducto;
        return view('admin.subproductos.edit', compact('subproducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subproducto $subproducto)
    {;
        // return $request;
        $request->validate([
            'tipo' => 'required|string|max:30|unique:subproductos,tipo,' . $subproducto->id_subproducto . ',id_subproducto',
        ]);

        $subproducto->update($request->all());

        session()->flash('swal', [
            'title' => 'Subproducto actualizado',
            'text' => 'El subproducto se ha actualizado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.subproductos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subproducto $subproducto)
    {
        $subproducto->delete();
        session()->flash('swal', [
            'title' => 'Subproducto eliminado',
            'text' => 'El subproducto se ha eliminado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.subproductos.index');
    }
}
