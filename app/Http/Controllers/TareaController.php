<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = auth()->user()->tareas()->latest()->get();

        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        auth()->user()->tareas()->create($request->all());

        return redirect()->route('tareas.index')->with('mensaje', 'Tarea creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')->with('mensaje', 'Tarea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $this->authorize('delete', $tarea);
        $tarea->delete();

        return redirect()->route('tareas.index')->with('mensaje', 'Tarea eliminada');
    }

    public function completar(Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        $tarea->update(['completada' => true]);

        return redirect()->route('tareas.index')->with('mensaje', '¡Tarea completada!');
    }
}
