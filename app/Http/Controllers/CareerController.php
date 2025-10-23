<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{
    // Listar todas las carreras
    public function listar()
    {
        $careers = Career::with('faculty')->get();
        return view('careers.listar', compact('careers'));
    }

    // Mostrar formulario para nueva carrera
    public function nuevo()
    {
        // Para seleccionar facultad en el formulario
        $faculties = Faculty::all();
        return view('careers.nuevo', compact('faculties'));
    }

    // Guardar nueva carrera
    public function guardar(Request $request)
    {
        $data = $request->only([
            'name_career',
            'id_fac'
        ]);

        Career::create($data);

        Session::flash('success', 'Carrera GUARDADA correctamente');
        return redirect()->route('careers.listar');
    }

    // Eliminar carrera
    public function eliminar($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        Session::flash('success', 'Carrera ELIMINADA correctamente');
        return redirect()->route('careers.listar');
    }

    // Mostrar formulario para editar carrera
    public function editar($id)
    {
        $career = Career::findOrFail($id);
        $faculties = Faculty::all(); // Para lista de facultades
        return view('careers.editar', compact('career', 'faculties'));
    }

    // Procesar edición de carrera
    public function procesarEdicion(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $career->name_career = $request->name_career;
        $career->id_fac = $request->id_fac;

        $career->save();

        Session::flash('success', 'Carrera ACTUALIZADA exitosamente');
        return redirect()->route('careers.listar');
    }
}
