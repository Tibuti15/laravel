<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class FacultyController extends Controller
{
    // Listar todas las facultades
    public function listar()
    {
        $faculties = Faculty::with('careers.teachers')->get();
        return view('faculties.listar', compact('faculties'));
    }

    // Mostrar formulario para nueva facultad
    public function nuevo()
    {
        return view('faculties.nuevo');
    }

    // Guardar nueva facultad
    public function guardar(Request $request)
    {
        $data = $request->only([
            'name_fac',
            'acronym_fac',
            'dean_name_fac',
            'phone_fac',
            'email_fac',
            'year_foundation_fac'
        ]);

        // Manejo de logo si se sube
        if ($request->hasFile('logo_fac')) {
            $data['logo_fac'] = $request->file('logo_fac')->store('logos', 'public');
        }

        Faculty::create($data);

        Session::flash('success', 'Facultad GUARDADA correctamente');
        return redirect()->route('faculties.listar');
    }

    // Eliminar facultad
    public function eliminar($id)
    {
        $faculty = Faculty::findOrFail($id);

        // Borrar logo si existe
        if ($faculty->logo_fac && Storage::disk('public')->exists($faculty->logo_fac)) {
            Storage::disk('public')->delete($faculty->logo_fac);
        }

        $faculty->delete();

        Session::flash('success', 'Facultad ELIMINADA correctamente');
        return redirect()->route('faculties.listar');
    }

    // Mostrar formulario para editar facultad
    public function editar($id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculties.editar', compact('faculty'));
    }

    // Procesar edición de facultad
    public function procesarEdicion(Request $request, $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->name_fac = $request->name_fac;
        $faculty->acronym_fac = $request->acronym_fac;
        $faculty->dean_name_fac = $request->dean_name_fac;
        $faculty->phone_fac = $request->phone_fac;
        $faculty->email_fac = $request->email_fac;
        $faculty->year_foundation_fac = $request->year_foundation_fac;

        // Manejo de logo
        if ($request->hasFile('logo_fac')) {
            // Borrar logo anterior si existe
            if ($faculty->logo_fac && Storage::disk('public')->exists($faculty->logo_fac)) {
                Storage::disk('public')->delete($faculty->logo_fac);
            }
            $faculty->logo_fac = $request->file('logo_fac')->store('logos', 'public');
        }

        $faculty->save();

        Session::flash('success', 'Facultad ACTUALIZADA exitosamente');
        return redirect()->route('faculties.listar');
=======

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
>>>>>>> 81be8a41ed8711e58c0ca86cf24a314065de9a04
    }
}
