<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{
    public function listar()
    {
        $careers = Career::with('faculty')->get();
        return view('careers.listar', compact('careers'));
    }

    public function nuevo()
    {
        $faculties = Faculty::all();
        return view('careers.nuevo', compact('faculties'));
    }

    public function guardar(Request $request)
    {
        $data = $request->only(['name_career','id_fac']);
        Career::create($data);
        Session::flash('success', 'Carrera GUARDADA correctamente');
        return redirect()->route('careers.listar');
    }

    public function editar($id)
    {
        $career = Career::findOrFail($id);
        $faculties = Faculty::all();
        return view('careers.editar', compact('career','faculties'));
    }

    public function procesarEdicion(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $career->name_career = $request->name_career;
        $career->id_fac = $request->id_fac;
        $career->save();
        Session::flash('success', 'Carrera ACTUALIZADA correctamente');
        return redirect()->route('careers.listar');
    }

    public function eliminar($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();
        Session::flash('success', 'Carrera ELIMINADA correctamente');
        return redirect()->route('careers.listar');
    }

    public function show($id)
    {
        $career = Career::with('faculty','teachers')->findOrFail($id);
        return view('careers.show', compact('career'));
    }
}

