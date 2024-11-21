<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{

    //En laravel 11 asi se hace el middleware
    //Se debe implementar la interfaz HasMiddleware
    public static function middleware(): array
    {
        return [
            // Aplica el middleware 'can:Gestion Categorias' a todas las acciones
            new Middleware('can:Gestion categorias'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //informacion mandada del formulario
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //creacion de la categoria en la bd
        Category::create($request->all());

        //mensaje de confirmacion
        session()->flash('swal', [
            'title' => 'Categoria creada',
            'text' => 'La categoria se ha creado correctamente',
            'icon' => 'success'
        ]);

        //retorno al index
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //informacion mandada del formulario
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->all());
        //mensaje de confirmacion
        session()->flash('swal', [
            'title' => 'Categoria creada',
            'text' => 'La categoria se ha actualizo correctamente',
            'icon' => 'success'
        ]);
        //retorno al index
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $post = Post::where('category_id', $category->id)->exists();
        if ($post) {
            //mensaje de confirmacion
            session()->flash('swal', [
                'title' => 'Categoria no eliminada',
                'text' => 'La categoria no se puede eliminar porque tiene posts asociados',
                'icon' => 'error'
            ]);
            //retorno al edit
            return redirect()->route('admin.categories.edit', $category);
        }
        $category->delete();
        //mensaje de confirmacion
        session()->flash('swal', [
            'title' => 'Categoria eliminada',
            'text' => 'La categoria se ha eliminado correctamente',
            'icon' => 'success'
        ]);
        //retorno al index
        return redirect()->route('admin.categories.index');
    }
}
