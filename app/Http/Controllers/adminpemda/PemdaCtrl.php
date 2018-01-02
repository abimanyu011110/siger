<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\adminpemda\reqPemda;
use App\Models\adminpemda\Pemda;
use DB;

class PemdaCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pemda = DB::table('tbl_pemda')
            ->select('tbl_pemda.id as id', 'tbl_pemda.tahun as tahun', 'tbl_pemda.nama_pemda as nama_pemda', 'tbl_pemda.alamat as alamat', 'tbl_pemda.kepala_daerah as kepala_daerah', 'tbl_pemda.jabatan as jabatan')
            ->get();
        return view('adminpemda.pemda.index', compact('pemda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['pemda'] = DB::table('tbl_pemda');
        return view('adminpemda.pemda.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqPemda $request)
    {
        //
        $input = $request->all();
        $pemda = new Pemda($input);
        if ($pemda->save()) {
            return redirect()->route('pemda.index');
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
        $this->data['pemda'] = Pemda::find($id);
        return view('adminpemda.pemda.edit', $this->data);
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
        $input = $request->all();
        $pemda = Pemda::find($id);
        if ($pemda->update($input)) {
            return redirect()->route('pemda.index');
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
        $pemda = Pemda::find($id);
        $pemda->delete();
        return redirect()->route('pemda.index');
    }
}