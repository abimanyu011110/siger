<?php

namespace App\Http\Controllers\adminopd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminopd\SasaranOPD;
use App\Models\adminopd\TujuanOPD;
use App\Http\Requests\adminopd\reqSasaranOPD;
use App\Models\adminpemda\OPD;
use DB;
use Auth;

class SasaranOPDCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sasaran = DB::table('sasaran_opd')
            ->select('sasaran_opd.id as id', 'tbl_opd.nama_opd as nama_opd', 'tujuan_opd.nama_tujuan as nama_tujuan', 'sasaran_opd.nama_sasaran as nama_sasaran')
            ->join('tbl_opd', 'sasaran_opd.opd_id', '=', 'tbl_opd.id')
            ->join('tujuan_opd', 'sasaran_opd.tujuan_id', '=', 'tujuan_opd.id')
            ->where('sasaran_opd.opd_id',Auth::user()->opd_id)
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('adminopd.sasaranopd.index', compact('sasaran', 'nama'));
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
        $tujuan = TujuanOPD::pluck('nama_tujuan', 'id');
        return view('adminopd.sasaranopd.create', compact('tujuan', 'opd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqSasaranOPD $request)
    {
        //
        $input = $request->all();
        $sasaran = new SasaranOPD($input);
        if ($sasaran->save()) {
            return redirect()->route('sasaranopd.index');
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
        $tujuan = TujuanOPD::pluck('nama_tujuan', 'id');
        $sasaran = SasaranOPD::find($id);
        return view('adminopd.sasaranopd.edit', compact('opd','tujuan', 'sasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqSasaranOPD $request, $id)
    {
        //
        $input = $request->all();
        $sasaran = SasaranOPD::find($id);
        if ($sasaran->update($input)) {
            return redirect()->route('sasaranopd.index');
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
        $sasaran = SasaranOPD::find($id);
        $sasaran->delete();
        return redirect()->route('sasaranopd.index');
    }
}
