<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminpemda\Sasaran;
use App\Models\adminpemda\Tujuan;
use App\Http\Requests\adminpemda\reqSasaran;
use DB;

class SasaranCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sasaran = DB::table('sasaran_pemda')
            ->select('sasaran_pemda.id as id', 'tujuan_pemda.nama_tujuan as nama_tujuan', 'sasaran_pemda.nama_sasaran as nama_sasaran')
            ->join('tujuan_pemda', 'sasaran_pemda.tujuan_id', '=', 'tujuan_pemda.id')
            ->get();
        return view('adminpemda.sasaran.index', compact('sasaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tujuan = Tujuan::pluck('nama_tujuan', 'id');
        return view('adminpemda.sasaran.create', compact('tujuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqSasaran $request)
    {
        //
        $input = $request->all();
        $sasaran = new Sasaran($input);
        if ($sasaran->save()) {
            return redirect()->route('sasaran.index');
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
        $tujuan = Tujuan::pluck('nama_tujuan', 'id');
        $sasaran = Sasaran::find($id);
        return view('adminpemda.sasaran.edit', compact('tujuan', 'sasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqSasaran $request, $id)
    {
        //
        $input = $request->all();
        $sasaran = Sasaran::find($id);
        if ($sasaran->update($input)) {
            return redirect()->route('sasaran.index');
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
        $sasaran = Sasaran::find($id);
        $sasaran->delete();
        return redirect()->route('sasaran.index');
    }
}
