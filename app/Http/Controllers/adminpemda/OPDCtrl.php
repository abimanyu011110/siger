<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminpemda\OPD;
use App\Http\Requests\adminpemda\reqOPD;
use App\Models\adminpemda\Urusan;
use App\Models\adminpemda\Bidang;
use DB;

class OPDCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $opd = DB::table('tbl_opd')
                ->select('tbl_opd.id as id', 'ref_urusan.nama_urusan as nama_urusan', 'ref_bidang.nama_bidang as nama_bidang', 'tbl_opd.nama_opd as nama_opd', 'tbl_opd.kepala_opd as kepala_opd', 'tbl_opd.jabatan as jabatan')
                ->join('ref_urusan', 'tbl_opd.urusan_id', '=', 'ref_urusan.id')
                ->join('ref_bidang', 'tbl_opd.bidang_id', '=', 'ref_bidang.id')
                ->get();
        return view('adminpemda.opd.index', compact('opd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $urusan = Urusan::pluck('nama_urusan', 'id');
        return view('adminpemda.opd.create', compact('urusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqOPD $request)
    {
        //
        $input = $request->all();
        $opd = OPD::create($input);
        return redirect()->route('opd.index');
    }

    public function pilihBidang($id) 
    {  
        $bidang = DB::table('ref_bidang')
                ->where('urusan_id', $id)
                ->get()
                ->pluck('nama_bidang', 'id');
        return json_encode($bidang);
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
        $this->data['urusan'] = Urusan::pluck('nama_urusan', 'id');
        $this->data['opd'] = OPD::find($id);
        return view('adminpemda.opd.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqOPD $request, $id)
    {
        //
        $input = $request->all();
        $opd = OPD::find($id);
        if ($opd->update($input)) {
            return redirect()->route('opd.index');
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
        $opd = OPD::find($id);
        $opd->delete();

        return redirect()->route('opd.index');
    }
}
