<?php

namespace App\Http\Controllers\userpemda1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\userpemda1\reqIdentifikasi;
use App\Models\adminpemda\Sasaran;
use App\Models\adminpemda\Pemda;
use App\Models\adminpemda\Baganrisiko;
use App\Models\adminpemda\OPD;
use App\Models\userpemda1\Identifikasi;
use DB;
use App\Models\adminpemda\Misi;
use PDF;
use Auth;
use App\Models\adminpemda\Pemda;

class IdentifikasiPemda1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('vw_pemda')
                ->select('vw_pemda.id as id', 'vw_pemda.nama_sasaran as nama_sasaran', 'vw_pemda.nama_risiko as nama_risiko', 'analisis_opd.tingkat_risiko as tingkat_risiko', 'vw_pemda.tk2 as tk2', 'identifikasi_pemda.sisa_risiko as sisa_risiko')
                ->leftjoin('analisis_opd', 'analisis_opd.id', '=', 'vw_pemda.id')
                ->leftjoin('identifikasi_pemda', 'vw_pemda.id', 'identifikasi_pemda.analisis_id')
                ->get();

        return view('userpemda1.identifikasipemda1.index', compact('data'));
    }

    public function createby($ida)
    {
        //
        $this->data['sasaran'] = DB::table('vw_pemda')->where('vw_pemda.id', $ida)->first();
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['Controllable', 'Uncontrollable'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        return view('userpemda1.identifikasipemda1.create', $this->data);
    }

    public function transaksi()
    {
        $data = DB::table('identifikasi_pemda')
                ->select('identifikasi_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'identifikasi_pemda.periode as periode','tbl_baganrisiko.nama_risiko', 'identifikasi_pemda.uraian as uraian', 'identifikasi_pemda.sumber_risiko as sumber_risiko', 'identifikasi_pemda.kontrol as kontrol', 'identifikasi_pemda.penyebab as penyebab', 'identifikasi_pemda.dampak as dampak', 'identifikasi_pemda.pengendalian as pengendalian', 'identifikasi_pemda.sisa_risiko as sisa_risiko')

                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
                ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_pemda.risiko_id')
                ->get();
        return view('userpemda1.identifikasipemda1.tranIdentifikasiPemda', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['misi'] = Misi::pluck('nama_misi', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['risiko'] = Baganrisiko::orderBy('nama_risiko', 'asc')->pluck('nama_risiko', 'id');
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['Controllable', 'Uncontrollable'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        return view('userpemda1.identifikasipemda1.createidentifikasipemda',  $this->data);
    }

    public function cetak()
    {
        $identifikasipemda = DB::table('identifikasi_pemda')
                ->select('identifikasi_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'identifikasi_pemda.periode as periode', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'identifikasi_pemda.uraian as uraian', 'identifikasi_pemda.sumber_risiko as sumber_risiko', 'identifikasi_pemda.kontrol as kontrol', 'identifikasi_pemda.penyebab as penyebab', 'identifikasi_pemda.dampak as dampak', 'identifikasi_pemda.pengendalian as pengendalian', 'identifikasi_pemda.sisa_risiko as sisa_risiko')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
                ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                ->orderBy('identifikasi_pemda.id', 'asc')
                ->get();

        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('userpemda1.identifikasipemda1.cetak',  compact('identifikasipemda', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape'); 
        return $pdf->stream();
    }

    public function pilihRisiko(Request $request) 
    {  
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("tbl_baganrisiko")
                    ->select("id","nama_risiko")
                    ->where('nama_risiko','LIKE',"%$search%")
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
        $a = new Identifikasi();
      $a->analisis_id = $request->analisis_id;
      $a->sasaran_id = $request->sasaran_id;
      $a->periode = $request->periode;
      $a->risiko_id = $request->risiko_id;
      $a->uraian = $request->uraian;
      $a->sumber_risiko = $request->sumber_risiko;
      $a->kontrol = $request->kontrol;
      $a->penyebab = $request->penyebab;
      $a->dampak = $request->dampak;
      $a->pengendalian = $request->pengendalian;
      $a->sisa_risiko = $request->sisa_risiko;
      if ($a->save()) {
          return redirect()->route('identifikasipemda1.index');
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

    public function pilihTujuan($id) 
    {  
        $tujuan = DB::table('tujuan_pemda')
                ->where('misi_id', $id)
                ->get()
                ->pluck('nama_tujuan', 'id');
        return json_encode($tujuan);
    }

    public function pilihSasaran($id) 
    {  
        $sasaran = DB::table('sasaran_pemda')
                ->where('tujuan_id', $id)
                ->get()
                ->pluck('nama_sasaran', 'id');
        return json_encode($sasaran);
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
        $this->data['misi'] = Misi::pluck('nama_misi', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['risiko'] = BaganRisiko::pluck('nama_risiko', 'id');
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['Controllable', 'Uncontrollable'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        $this->data['identifikasi'] = Identifikasi::find($id);
        return view('userpemda1.identifikasipemda1.edit',  $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqIdentifikasi $request, $id)
    {
        //
        $input = $request->all();
        $identifikasi = Identifikasi::find($id);
        if ($identifikasi->update($input)) {
            return redirect()->route('identifikasipemda1.index');
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
        $identifikasi = Identifikasi::find($id);
        $identifikasi->delete();
        return redirect()->route('identifikasipemda1.index');
    }
}