<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Cache\TagSet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\Boolean;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::where('user_id', Auth::id())
            ->Latest('id')
            ->paginate(10);
        //con Compact se envia la variable posts a la vista
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        request()->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts',
            //checar si va user_id
        ]);

        //cuidado con el observador
        $post = Post::create($request->all());

        //mensaje de confirmacion
        session()->flash('swal', [
            'title' => 'Post creado',
            'text' => 'El post se ha creado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   // Sintaxis en laravel 10 sirve para validar si el usuario es el autor del post y mandar un error y puedo agregar quien esta intentando entrar        // if (!Gate::allows('author', $post)) {
        //     return abort(403, 'NO ESTAS AUTORIZADO');
        // }
        //return $post;
        //Sintaxis en laravel 11 sirve para validar si el usuario es el autor del post y solo mandar un error
        Gate::authorize('author', $post);

        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        request()->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'excerpt' => $request->published ? 'required' : 'nullable',
            'body' => $request->published ? 'required' : 'nullable',
            'published' => 'required|boolean',
            'tags' => 'nullable|array',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        $tags = [];
        foreach ($request->tags ?? []  as $name) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags);

        if ($request->file('image')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            $file_name = request()->slug . '.' . $request->file('image')->getClientOriginalExtension();
            //Forma 1 de guardar la imagen con nombre unico
            //     $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name);
            //Forma 2 de guardar la imagen con nombre unico(storeAs)
            $data['image_path'] = $request->file('image')->storeAs('posts', $file_name);
        }

        $post->update($data);

        session()->flash('swal', [
            'title' => 'Post actualizado',
            'text' => 'El post se ha actualizado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'title' => 'Post eliminado',
            'text' => 'El post se ha eliminado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
