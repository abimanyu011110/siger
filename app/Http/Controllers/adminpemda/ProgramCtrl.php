<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminpemda\reqProgram;
use App\Models\adminpemda\Program;
use App\Models\adminpemda\Sasaran;
use DB;

class ProgramCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $program = DB::table('program_pemda')
            ->select('program_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'program_pemda.nama_program as nama_program')
            ->join('sasaran_pemda', 'program_pemda.sasaran_id', '=', 'sasaran_pemda.id')
            ->get();
        return view('adminpemda.program.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sasaran = Sasaran::pluck('nama_sasaran', 'id');
        return view('adminpemda.program.create', compact('sasaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqProgram $request)
    {
        //
        $input = $request->all();
        $program = new Program($input);
        if ($program->save()) {
            return redirect()->route('program.index');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sasaran = Sasaran::pluck('nama_sasaran', 'id');
        $program = Program::find($id);
        return view('adminpemda.program.edit', compact('sasaran', 'program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqProgram $request, $id)
    {
        //
        $input = $request->all();
        $program = Program::find($id);
        if ($program->update($input)) {
            return redirect()->route('program.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $program = ProgramPemda::find($id);
        $program->delete();
        return redirect()->route('program.index');
    }
}
