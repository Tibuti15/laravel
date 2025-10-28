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
        $careers = Career::with('faculty', 'teachers')->get();
        return view('careers.listar', compact('careers'));
    }

    // Mostrar formulario para nueva carrera
    public function nuevo()
    {
        $faculties = Faculty::all();
        return view('careers.nuevo', compact('faculties'));
    }

    // Guardar nueva carrera
    public function guardar(Request $request)
    {
        $data = $request->only(['name_career','id_fac']);
        Career::create($data);
        Session::flash('success', 'Carrera GUARDADA correctamente');
        return redirect()->route('careers.listar');
    }

    // Mostrar formulario para editar carrera
    public function editar($id)
    {
        $career = Career::findOrFail($id);
        $faculties = Faculty::all();
        return view('careers.editar', compact('career','faculties'));
    }

    // Procesar edición de carrera
    public function procesarEdicion(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $career->name_career = $request->name_career;
        $career->id_fac = $request->id_fac;
        $career->save();
        Session::flash('success', 'Carrera ACTUALIZADA correctamente');
        return redirect()->route('careers.listar');
    }

    // Eliminar carrera (mantener wrapper GET)
    public function eliminar($id)
    {
        return $this->destroy($id);
    }

    // Eliminar carrera RESTful
    public function destroy($id)
    {
        $career = Career::with('teachers')->findOrFail($id);

        // Eliminar todos los profesores asociados
        foreach ($career->teachers as $teacher) {
            $teacher->delete();
        }

        // Eliminar la carrera
        $career->delete();

        Session::flash('success', 'Carrera ELIMINADA correctamente');
        return redirect()->route('careers.listar');
    }

    // Mostrar detalles de carrera
    public function show($id)
    {
        $career = Career::with('faculty','teachers')->findOrFail($id);
        return view('careers.show', compact('career'));
    }
}
