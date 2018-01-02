<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminpemda\Visi;
use App\Http\Requests\adminpemda\reqVisi;
use DB;

class VisiCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $visi = DB::table('visi_pemda')
            ->select('visi_pemda.id as id', 'visi_pemda.nama_visi as nama_visi')
            ->get();
        return view('adminpemda.visi.index', compact('visi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['visi'] = DB::table('visi_pemda');
        return view('adminpemda.visi.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqVisi $request)
    {
        //
        $input = $request->all();
        $visi = new Visi($input);
        if ($visi->save()) {
            return redirect()->route('visi.index');
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
        $this->data['visi'] = Visi::find($id);
        return view('adminpemda.visi.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqVisi $request, $id)
    {
        //
        $input = $request->all();
        $visi = Visi::find($id);
        if ($visi->update($input)) {
            return redirect()->route('visi.index');
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
        $visi = Visi::find($id);
        $visi->delete();
        return redirect()->route('visi.index');
    }
}
