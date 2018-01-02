<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\adminpemda\Sasaran;
use App\Models\adminopd\SasaranOPD;
use App\Models\adminpemda\OPD;
use App\Models\adminpemda\Mapping;

class MappingCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('tbl_maping')
            ->select('tbl_maping.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran_pemda', 'tbl_opd.nama_opd as nama_opd', 'sasaran_opd.nama_sasaran as nama_sasaran_opd', 'tbl_maping.bobot as bobot')
            ->join('sasaran_pemda', 'sasaran_pemda.id', 'tbl_maping.sasaranpemda_id')
            ->join('tbl_opd', 'tbl_opd.id', 'tbl_maping.opd_id')
            ->join('sasaran_opd', 'sasaran_opd.id', 'tbl_maping.sasaranopd_id')
            ->get();
        return view('adminpemda.mapping.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['opd'] = OPD::pluck('nama_opd', 'id');
        return view('adminpemda.mapping.create', $this->data);
    }

    public function pilihSasaranOpd($id)
    {
        $data = DB::table('sasaran_opd')
            ->where('opd_id', $id)
            ->get()
            ->pluck('nama_sasaran', 'id');
        return json_encode($data);
    }


    public function cariSasaran(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("sasaran_pemda")
                    ->select("id","nama_sasaran")
                    ->where('nama_sasaran','LIKE',"%$search%")
                    ->get();
        }

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $a = new Mapping();
        $a->sasaranpemda_id = $request->sasaranpemda_id;
        $a->opd_id = $request->opd_id;
        $a->sasaranopd_id = $request->sasaranopd_id;
        $a->bobot = $request->bobot;
        if ($a->save()) {
            return redirect()->route('mapping.index');
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
        $this->data['mapping'] = Mapping::find($id);
        $this->data['opd'] = OPD::pluck('nama_opd', 'id');
        return view('adminpemda.mapping.edit', $this->data);
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
        $a = Mapping::find($id);
        $a->sasaranpemda_id = $request->sasaranpemda_id;
        $a->opd_id = $request->opd_id;
        $a->sasaranopd_id = $request->sasaranopd_id;
        $a->bobot = $request->bobot;
        if ($a->update()) {
            return redirect()->route('mapping.index');
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
    }
}
