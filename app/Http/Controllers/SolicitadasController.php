<?php

namespace App\Http\Controllers;

use App\Models\Aprobadas;
use App\Models\Institution;
use App\Models\Solicitadas;
use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;

class SolicitadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin');
    }
    public function index()
    {
        try {
            $institutions = Institution::OrderCreate()->get();
            $solicitadas = Solicitadas::OrderCreate()->WhereInsId(request('institution_id'))->paginate(15);
            return view('identification.print.index', compact('solicitadas', 'institutions'))
                ->with('error', 'No se encuentran registros');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitadas $solicitadas)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitadas $solicitada)
    {
        //
        $aprobadas = new Aprobadas();
        $aprobadas->solicitadas_id = $solicitada->id;
        $aprobadas->institution_id = $solicitada->institution_id;
        $aprobadas->save();
        return back()->with('success', 'Aprobada exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitadas $solicitadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            Solicitadas::findOrFail($id)->delete();
            return redirect()->route('solicitadas.index')->with('delete', 'Solicitud eliminada exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
}
