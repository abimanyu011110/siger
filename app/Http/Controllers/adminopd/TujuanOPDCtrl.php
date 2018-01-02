<?php

namespace App\Http\Controllers\adminopd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminopd\TujuanOPD;
use App\Models\adminpemda\Misi;
use App\Http\Requests\adminopd\reqTujuanOPD;
use App\Models\adminpemda\OPD;
use App\Models\adminpemda\User;
use Auth;
use DB;

class TujuanOPDCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tujuan = DB::table('tujuan_opd')
            ->select('tujuan_opd.id as id', 'tbl_opd.nama_opd as nama_opd', 'misi_pemda.nama_misi as nama_misi', 'tujuan_opd.nama_tujuan as nama_tujuan')
            ->join('tbl_opd', 'tujuan_opd.opd_id', '=', 'tbl_opd.id')
            ->join('misi_pemda', 'tujuan_opd.misi_id', '=', 'misi_pemda.id')
            ->where('tujuan_opd.opd_id',Auth::user()->opd_id)
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('adminopd.tujuanopd.index', compact('tujuan', 'nama'));
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
        $misi = Misi::pluck('nama_misi', 'id');
        return view('adminopd.tujuanopd.create', compact('misi', 'opd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqTujuanOPD $request)
    {
        //
        $input = $request->all();
        $tujuan = new TujuanOPD($input);
        if ($tujuan->save()) {
            return redirect()->route('tujuanopd.index');
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
        $misi = Misi::pluck('nama_misi', 'id');
        $tujuan = TujuanOPD::find($id);
        return view('adminopd.tujuanopd.edit', compact('opd','misi', 'tujuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqTujuanOPD $request, $id)
    {
        //
        $input = $request->all();
        $tujuan = TujuanOPD::find($id);
        if ($tujuan->update($input)) {
            return redirect()->route('tujuanopd.index');
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
        $tujuan = TujuanOPD::find($id);
        $tujuan->delete();
        return redirect()->route('tujuanopd.index');
    }
}
