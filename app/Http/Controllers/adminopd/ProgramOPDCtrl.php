<?php

namespace App\Http\Controllers\adminopd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminopd\ProgramOPD;
use App\Models\adminopd\SasaranOPD;
use App\Http\Requests\adminopd\reqProgramOPD;
use App\Models\adminpemda\OPD;
use DB;
use Auth;

class ProgramOPDCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $program = DB::table('program_opd')
            ->select('program_opd.id as id', 'tbl_opd.nama_opd as nama_opd', 'sasaran_opd.nama_sasaran as nama_sasaran', 'program_opd.nama_program as nama_program')
            ->join('tbl_opd', 'program_opd.opd_id', '=', 'tbl_opd.id')
            ->join('sasaran_opd', 'program_opd.sasaran_id', '=', 'sasaran_opd.id')
            ->where('program_opd.opd_id',Auth::user()->opd_id)
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('adminopd.programopd.index', compact('program', 'nama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $opd = OPD::where('tbl_opd.id', Auth::user()->opd_id)->pluck('nama_opd', 'id');
        $sasaran = SasaranOPD::where('opd_id',Auth::user()->opd_id)->pluck('nama_sasaran', 'id');
        return view('adminopd.programopd.create', compact('opd','sasaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqProgramOPD $request)
    {
        //
        $input = $request->all();
        $program = new ProgramOPD($input);
        if ($program->save()) {
            return redirect()->route('programopd.index');
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
        $opd = OPD::where('tbl_opd.id', Auth::user()->opd_id)->pluck('nama_opd', 'id');
        $sasaran = SasaranOPD::where('opd_id',Auth::user()->opd_id)->pluck('nama_sasaran', 'id');
        $program = ProgramOPD::find($id);
        return view('adminopd.programopd.edit', compact('opd','sasaran', 'program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqProgramOPD $request, $id)
    {
        //
        $input = $request->all();
        $program = ProgramOPD::find($id);
        if ($program->update($input)) {
            return redirect()->route('programopd.index');
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
        $program = ProgramOPD::find($id);
        $program->delete();
        return redirect()->route('programopd.index');
    }
}
