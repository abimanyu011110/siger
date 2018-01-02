<?php

namespace App\Http\Controllers\useropd1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use App\Models\useropd1\AnalisisOpd;
use App\Models\adminpemda\OPD;
use App\Models\adminpemda\Pemda;
use PDF;

class AnalisisOpd1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $analisisopd = DB::table('identifikasi_opd')
              ->select('identifikasi_opd.id as id', 'tbl_opd.nama_opd as nama_opd',
              'sasaran_opd.nama_sasaran as nama_sasaran',
              'analisis_opd.tingkat_risiko as tingkat_risiko',
               'tbl_baganrisiko.nama_risiko as nama_risiko',
              'identifikasi_opd.sisa_risiko as sisa_risiko')
              ->join('tbl_opd', 'identifikasi_opd.opd_id', '=', 'tbl_opd.id')
              ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
              ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
              ->leftjoin('analisis_opd', 'identifikasi_opd.id','analisis_opd.identifikasi_id' )
              ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
              ->where('identifikasi_opd.sisa_risiko','Ada')
              ->groupBy('identifikasi_opd.id')
              ->get();

        return view('useropd1.analisisopd1.index', compact('analisisopd'));
    }

    public function transaksi()
       {
           $dt = DB::table('analisis_opd')
                  ->select('analisis_opd.id as id',
                   'tbl_baganrisiko.nama_risiko as nama_risiko',
                   'ref_kemungkinan.nama_kemungkinan as kemungkinan',
                   'sasaran_opd.nama_sasaran as nama_sasaran',
                    'ref_dampak.nama_dampak as dampak', 'analisis_opd.tingkat_risiko')
                  ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
                  ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
                   ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
                   ->join('ref_kemungkinan', 'analisis_opd.kemungkinan_id', '=', 'ref_kemungkinan.id')
                   ->join('ref_dampak', 'analisis_opd.dampak_id', '=', 'ref_dampak.id')
                   ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                   ->orderBy('analisis_opd.id', 'asc')
                   ->get();
          return view('useropd1.analisisopd1.transaksiopd',compact('dt'));
      }

      public function CetakAnalisis()
      {
        $dt = DB::table('analisis_opd')
                  ->select('analisis_opd.id as id',
                   'tbl_baganrisiko.nama_risiko as nama_risiko',
                   'ref_kemungkinan.id as kemungkinan',
                   'sasaran_opd.nama_sasaran as nama_sasaran',
                    'ref_dampak.id as dampak', 'analisis_opd.tingkat_risiko')
                  ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
                  ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
                   ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
                   ->join('ref_kemungkinan', 'analisis_opd.kemungkinan_id', '=', 'ref_kemungkinan.id')
                   ->join('ref_dampak', 'analisis_opd.dampak_id', '=', 'ref_dampak.id')
                   ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                   ->orderBy('analisis_opd.id', 'asc')
                   ->get();
        $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('useropd1.analisisopd1.cetak',  compact('dt', 'nama_opd', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('analisis_opd.pdf', array('Attachment' => false));
        exit(0);
      }

      public function googlechartopd()
      {
        $chart = DB::table('analisis_opd')
                ->select('analisis_opd.id as id', 
                    'ref_kemungkinan.nilai as kemungkinan',
                    'ref_dampak.nilai as dampak',
                    'analisis_opd.tingkat_risiko as tingkat_risiko',
                    'tbl_baganrisiko.nama_risiko as nama_risiko', 'sasaran_opd.nama_sasaran as nama_sasaran')

                ->join('ref_kemungkinan', 'ref_kemungkinan.id', 'analisis_opd.kemungkinan_id')
                ->join('ref_dampak', 'ref_dampak.id', 'analisis_opd.dampak_id')
                ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', 'identifikasi_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', 'tbl_baganrisiko.id')
                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
                ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                ->orderBy('analisis_opd.tingkat_risiko', 'desc')
                ->limit(10)
                ->get();

        $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
        return view('useropd1.analisisopd1.googlechartopd', compact('chart', 'nama_opd'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idn)
    {
      $kegiatan = DB::table('identifikasi_opd')->where('id', $idn)->first();
      $risiko = DB::table('identifikasi_opd')
              ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
              ->select('tbl_baganrisiko.nama_risiko','tbl_baganrisiko.id as id')
              ->where('identifikasi_opd.opd_id',Auth::user()->opd_id)
              ->get()
              ->pluck('nama_risiko','id');
      $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
      $dampak = Dampak::pluck('nama_dampak', 'id');
      return view('useropd1.analisisopd1.create', compact('risiko','kemungkinan','dampak','kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $srt = new AnalisisOpd;
      $srt->identifikasi_id = $request['identifikasi_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->save();
//      return view('useropd1.analisisopd1.index');
      return redirect()->route('transaksiopd');
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
        $this->data['kemungkinan'] = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $this->data['dampak'] = Dampak::pluck('nama_dampak', 'id');
        $this->data['analisis'] = AnalisisOpd::find($id);
        return view('useropd1.analisisopd1.edit', $this->data);
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
      $srt = AnalisisOpd::find($id);
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->update();
//      return view('useropd1.analisisopd1.index');
      return redirect()->route('transaksiopd');
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
        $a = AnalisisOpd::find($id);
        $a->delete();
        return redirect()->route('transaksiopd');
    }
}
