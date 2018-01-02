<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminpemda\Tujuan;
use App\Models\adminpemda\Misi;
use App\Http\Requests\adminpemda\reqTujuan;
use DB;

class TujuanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tujuan = DB::table('tujuan_pemda')
            ->select('tujuan_pemda.id as id', 'misi_pemda.nama_misi as nama_misi', 'tujuan_pemda.nama_tujuan as nama_tujuan')
            ->join('misi_pemda', 'tujuan_pemda.misi_id', '=', 'misi_pemda.id')
            ->get();
        return view('adminpemda.tujuan.index', compact('tujuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $misi = Misi::orderBy('nama_misi', 'desc')->pluck('nama_misi', 'id');
        return view('adminpemda.tujuan.create', compact('misi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqTujuan $request)
    {
        //
        $input = $request->all();
        $tujuan = new Tujuan($input);
        if ($tujuan->save()) {
            return redirect()->route('tujuan.index');
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
        $misi = Misi::pluck('nama_misi', 'id');
        $tujuan = Tujuan::find($id);
        return view('adminpemda.tujuan.edit', compact('misi', 'tujuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqTujuan $request, $id)
    {
        //
        $input = $request->all();
        $tujuan = Tujuan::find($id);
        if ($tujuan->update($input)) {
            return redirect()->route('tujuan.index');
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
        $tujuan = Tujuan::find($id);
        $tujuan->delete();
        return redirect()->route('tujuan.index');
    }
}
