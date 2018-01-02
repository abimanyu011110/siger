<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminpemda\reqBaganrisiko;
use App\Models\adminpemda\Baganrisiko;
use App\Models\adminpemda\Kategori;
use App\Models\adminpemda\Proses;

use DB;

class BaganrisikoCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $baganrisiko = DB::table('tbl_baganrisiko')
            ->select('tbl_baganrisiko.id as id', 'tbl_kategori.nama_kategori as nama_kategori', 'tbl_proses.nama_proses as nama_proses', 'tbl_baganrisiko.nama_risiko as nama_risiko')
            ->join('tbl_kategori', 'tbl_baganrisiko.kategori_id', '=', 'tbl_kategori.id')
            ->join('tbl_proses', 'tbl_baganrisiko.proses_id', '=', 'tbl_proses.id')
            ->get();
        return view('adminpemda.baganrisiko.index', compact('baganrisiko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori = Kategori::pluck('nama_kategori', 'id');
        $proses = Proses::pluck('nama_proses', 'id');
        return view('adminpemda.baganrisiko.create', compact('kategori', 'proses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqBaganrisiko $request)
    {
        //
        $input = $request->all();
        $baganrisiko = new BaganRisiko($input);
        if ($baganrisiko->save()) {
            return redirect()->route('baganrisiko.index');
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
        $kategori = Kategori::pluck('nama_kategori', 'id');
        $proses = Proses::pluck('nama_proses', 'id');
        $baganrisiko = BaganRisiko::find($id);
        return view('adminpemda.baganrisiko.edit', compact('kategori', 'proses', 'baganrisiko'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqBaganrisiko $request, $id)
    {
        //
        $input = $request->all();
        $baganrisiko = BaganRisiko::find($id);
        if ($baganrisiko->update($input)) {
            return redirect()->route('baganrisiko.index');
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
        $baganrisiko = BaganRisiko::find($id);
        $baganrisiko->delete();
        return redirect()->route('baganrisiko.index');
    }
}
