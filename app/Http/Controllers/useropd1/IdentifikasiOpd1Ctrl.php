<?php

namespace App\Http\Controllers\useropd1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\adminpemda\OPD;
use App\Models\adminpemda\Baganrisiko;
use App\Models\adminopd\SasaranOPD;
use Auth;
use App\Http\Requests\useropd1\reqIdentifikasiOpd;
use App\Models\useropd1\IdentifikasiOpd;
use PDF;
use App\Models\adminpemda\Pemda;

class IdentifikasiOpd1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $identifikasiopd = DB::table('vw_opd')
                ->select('vw_opd.id as id', 'vw_opd.nama_sasaran as nama_sasaran', 'vw_opd.nama_proses as nama_proses', 'vw_opd.nama_risiko as nama_risiko',
                 'vw_opd.tk1 as tk1', 'vw_opd.opd_id as opd_id', 'analisis_kegiatan.tingkat_risiko as tingkat_risiko', 'identifikasi_opd.sisa_risiko as sisa_risiko')
                ->leftjoin('analisis_kegiatan', 'analisis_kegiatan.id', '=', 'vw_opd.id')
                ->leftjoin('identifikasi_opd', 'vw_opd.id', 'identifikasi_opd.analisis_id')
                ->where('vw_opd.opd_id', Auth::user()->opd_id)
                ->get();

        return view('useropd1.identifikasiopd1.index', compact('identifikasiopd'));
    }

    public function pilihRisiko($id) 
    {  
        $risiko = DB::table('tbl_baganrisiko')
                ->where('proses_id', $id)
                ->get()
                ->pluck('nama_risiko', 'id');
        return json_encode($risiko);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $this->data['opd'] = OPD::where('tbl_opd.id', Auth::user()->opd_id)->pluck('nama_opd', 'id');
        $this->data['sasaran'] = SasaranOPD::where('sasaran_opd.opd_id', Auth::user()->opd_id)->pluck('nama_sasaran', 'id');
        $this->data['proses'] = DB::table('tbl_proses')->pluck('nama_proses', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['risiko'] = Baganrisiko::pluck('nama_risiko', 'id');
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['C', 'U'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        return view('useropd1.identifikasiopd1.createnew', $this->data);
    }

    public function transaksi()
    {
        $data = DB::table('identifikasi_opd')
                ->select('identifikasi_opd.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'identifikasi_opd.periode as periode', 'tbl_proses.nama_proses as nama_proses', 'tbl_baganrisiko.nama_risiko', 'tbl_opd.jabatan as pemilik_risiko', 'identifikasi_opd.uraian as uraian', 'identifikasi_opd.sumber_risiko as sumber_risiko', 'identifikasi_opd.kontrol as kontrol', 'identifikasi_opd.penyebab as penyebab', 'identifikasi_opd.dampak as dampak', 'identifikasi_opd.pengendalian as pengendalian', 'identifikasi_opd.sisa_risiko as sisa_risiko')

                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
                ->join('tbl_proses', 'identifikasi_opd.proses_id', 'tbl_proses.id')
                ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_opd.risiko_id')
                ->join('tbl_opd', 'tbl_opd.id', 'identifikasi_opd.opd_id')
                ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                ->get();
        return view('useropd1.identifikasiopd1.tranIdentifikasiOpd', compact('data'));
    }

    public function cetak()
    {
        $data = DB::table('identifikasi_opd')
                ->select('identifikasi_opd.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'tbl_proses.nama_proses as nama_proses', 'identifikasi_opd.periode', 'tbl_baganrisiko.nama_risiko', 'identifikasi_opd.uraian as uraian', 'tbl_opd.jabatan as pemilik_risiko', 'identifikasi_opd.sumber_risiko as sumber_risiko', 'identifikasi_opd.kontrol as kontrol', 'identifikasi_opd.penyebab as penyebab', 'identifikasi_opd.dampak as dampak', 'identifikasi_opd.pengendalian as pengendalian', 'identifikasi_opd.sisa_risiko as sisa_risiko')

                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
                ->join('tbl_proses', 'identifikasi_opd.proses_id', 'tbl_proses.id')
                ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_opd.risiko_id')
                ->join('tbl_opd', 'tbl_opd.id', 'identifikasi_opd.opd_id')
                ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                ->get();
        $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('useropd1.identifikasiopd1.cetak',  compact('data', 'nama_opd', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('identifikasi_opd.pdf', array('Attachment' => false));
        exit(0);
    }

    public function pilihPemilik($id) 
    {  
        $pemilik = DB::table('tbl_opd')
                ->where(Auth::user()->opd_id, $id)
                ->get()
                ->pluck('jabatan', 'id');
        return json_encode($pemilik);
    }

    public function createbyanalisis($ida)
    {
        //
        $this->data['kegiatan'] = DB::table('vw_opd')->where('id', $ida)->first();
        $this->data['proses'] = DB::table('tbl_proses')->pluck('nama_proses', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['C', 'U'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        return view('useropd1.identifikasiopd1.create', $this->data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $a = new IdentifikasiOpd();
      $a->opd_id = Auth::user()->opd_id;
      $a->analisis_id = $request->analisis_id;
      $a->sasaran_id = $request->sasaran_id;
      $a->periode = $request->periode;
      $a->proses_id = $request->proses_id;
      $a->risiko_id = $request->risiko_id;
      $a->uraian = $request->uraian;
      $a->sumber_risiko = $request->sumber_risiko;
      $a->kontrol = $request->kontrol;
      $a->penyebab = $request->penyebab;
      $a->dampak = $request->dampak;
      $a->pengendalian = $request->pengendalian;
      $a->sisa_risiko = $request->sisa_risiko;
      if ($a->save()) {
          return redirect()->route('identifikasiopd1.index');
      };

    }

    public function pilihPemilikUserOpd($id)
    {
        $pemilik = DB::table('tbl_opd')
                ->where('id', $id)
                ->get()
                ->pluck('jabatan', 'id');
        return json_encode($pemilik);
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
        $this->data['opd'] = OPD::where('tbl_opd.id', Auth::user()->opd_id)->pluck('nama_opd', 'id');
        $this->data['sasaran'] = SasaranOPD::where('sasaran_opd.opd_id', Auth::user()->opd_id)->pluck('nama_sasaran', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['proses'] = DB::table('tbl_proses')->pluck('nama_proses', 'id');
        $this->data['risiko'] = Baganrisiko::pluck('nama_risiko', 'id');
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['C', 'U'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        $this->data['identifikasi'] = IdentifikasiOpd::find($id);
        return view('useropd1.identifikasiopd1.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqIdentifikasiOpd $request, $id)
    {
        //
        $input = $request->all();
        $identifikasi = IdentifikasiOpd::find($id);
        if ($identifikasi->update($input)) {
            return redirect()->route('tranIdentifikasiOpd');
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
        $identifikasi = IdentifikasiOpd::find($id);
        $identifikasi->delete();
        return redirect()->route('identifikasiopd1.index');
    }
}
