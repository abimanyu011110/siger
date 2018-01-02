<?php

namespace App\Http\Controllers\adminopd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminopd\KegiatanOPD;
use App\Models\adminopd\ProgramOPD;
use App\Models\adminpemda\OPD;
use App\Models\adminopd\RiskOwner;
use App\Http\Requests\adminopd\reqKegiatanOPD;
use DB;
use Auth;

class KegiatanOPDCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kegiatan = DB::table('kegiatan_opd')
            ->select('kegiatan_opd.id as id', 'tbl_opd.nama_opd as nama_opd', 'program_opd.nama_program as nama_program', 'kegiatan_opd.nama_kegiatan as nama_kegiatan', 'kegiatan_opd.bobot as bobot', 'kegiatan_opd.jabatan as pemilik_risiko')
            ->join('tbl_opd', 'kegiatan_opd.opd_id', '=', 'tbl_opd.id')
            ->join('program_opd', 'kegiatan_opd.program_id', '=', 'program_opd.id')
            ->where('kegiatan_opd.opd_id',Auth::user()->opd_id)
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('adminopd.kegiatanopd.index', compact('kegiatan', 'nama'));
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
        $program = ProgramOPD::where('opd_id', Auth::user()->opd_id)->pluck('nama_program', 'id');
        return view('adminopd.kegiatanopd.create', compact('opd','program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqKegiatanOPD $request)
    {
        //
        $input = $request->all();
        $kegiatan = new KegiatanOPD($input);
        if ($kegiatan->save()) {
            return redirect()->route('kegiatanopd.index');
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
        $program = ProgramOPD::where('opd_id', Auth::user()->opd_id)->pluck('nama_program', 'id');
        $kegiatan = KegiatanOPD::find($id);
        return view('adminopd.kegiatanopd.edit', compact('opd','program', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $a = KegiatanOPD::find($id);
        $a->opd_id = $request->opd_id;
        $a->program_id = $request->program_id;
        $a->nama_kegiatan = $request->nama_kegiatan;
        $a->bobot = $request->bobot;
        $a->nama = $request->nama;
        $a->jabatan = $request->jabatan;
        if ($a->save()) {
            return redirect()->route('kegiatanopd.index', compact('a'));
        };
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
        $kegiatan = KegiatanOPD::find($id);
        $kegiatan->delete();
        return redirect()->route('kegiatanopd.index');
    }
}
