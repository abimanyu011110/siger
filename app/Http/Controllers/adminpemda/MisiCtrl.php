<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminpemda\reqMisi;
use App\Models\adminpemda\Misi;
use App\Models\adminpemda\Visi;
use DB;

class MisiCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $misi = DB::table('misi_pemda')
            ->select('misi_pemda.id as id', 'visi_pemda.nama_visi as nama_visi', 'misi_pemda.nama_misi as nama_misi')
            ->join('visi_pemda', 'misi_pemda.visi_id', '=', 'visi_pemda.id')
            ->get();
        return view('adminpemda.misi.index', compact('misi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $visi = Visi::pluck('nama_visi', 'id');
        return view('adminpemda.misi.create', compact('visi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqMisi $request)
    {
        //
        $input = $request->all();
        $misi = new Misi($input);
        if ($misi->save()) {
            return redirect()->route('misi.index');
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
        $visi = Visi::pluck('nama_visi', 'id');
        $misi = Misi::find($id);
        return view('adminpemda.misi.edit', compact('visi', 'misi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqMisi $request, $id)
    {
        //
        $input = $request->all();
        $misi = Misi::find($id);
        if ($misi->update($input)) {
            return redirect()->route('misi.index');
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
        $misi = Misi::find($id);
        $misi->delete();
        return redirect()->route('misi.index');
    }
}
