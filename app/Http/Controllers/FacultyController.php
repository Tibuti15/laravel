<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Mostrar listado de facultades
     */
    public function index()
    {
        $faculties = Faculty::with('careers.teachers')->get();
        return view('faculties.index', compact('faculties'));
    }

    /**
     * Mostrar formulario de creación (opcional)
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Guardar una nueva facultad en la base de datos (opcional)
     */
    public function store(Request $request)
    {
        Faculty::create($request->all());
        return redirect()->route('faculties.index');
    }

    /**
     * Mostrar una facultad específica (opcional)
     */
    public function show(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculties.show', compact('faculty'));
    }

    /**
     * Mostrar formulario para editar una facultad (opcional)
     */
    public function edit(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Actualizar una facultad existente
     */
    public function update(Request $request, string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->update($request->all());
        return redirect()->route('faculties.index');
    }

    /**
     * Eliminar una facultad
     */
    public function destroy(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        return redirect()->route('faculties.index');
    }
}
