<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminpemda\reqKategori;
use App\Models\adminpemda\Kategori;
use DB;

class KategoriCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori = DB::table('tbl_kategori')
            ->select('tbl_kategori.id as id', 'tbl_kategori.nama_kategori as nama_kategori', 'tbl_kategori.selera_risiko as selera_risiko')
            ->get();
        return view('adminpemda.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['kategori'] = DB::table('tbl_kategori');
        return view('adminpemda.kategori.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqKategori $request)
    {
        //
        $input = $request->all();
        $kategori = new Kategori($input);
        if ($kategori->save()) {
            return redirect()->route('kategori.index');
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
        $this->data['kategori'] = Kategori::find($id);
        return view('adminpemda.kategori.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqKategori $request, $id)
    {
        //
        $input = $request->all();
        $kategori = Kategori::find($id);
        if ($kategori->update($input)) {
            return redirect()->route('kategori.index');
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
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori.index');
    }
}