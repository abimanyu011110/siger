<?php

namespace App\Http\Controllers\userpemda1;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\adminpemda\Misi;
use App\Models\adminpemda\Baganrisiko;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use Illuminate\Http\Request;
use App\Models\userpemda1\AnalisisPemda;
use PDF;
use App\Models\adminpemda\Pemda;

class AnalisisPemda1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $analisis = DB::table('identifikasi_pemda')
                ->select('identifikasi_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 
                'tbl_baganrisiko.nama_risiko as nama_risiko', 'identifikasi_pemda.periode as periode', 'identifikasi_pemda.uraian as uraian',
                'identifikasi_pemda.sumber_risiko as sumber_risiko', 'identifikasi_pemda.kontrol as kontrol',
                 'identifikasi_pemda.penyebab as penyebab',
                'identifikasi_pemda.dampak as dampak', 'identifikasi_pemda.pengendalian as pengendalian',
                'identifikasi_pemda.sisa_risiko as sisa_risiko','analisis_pemda.tingkat_risiko')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
                ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                ->leftjoin('analisis_pemda', 'identifikasi_pemda.id','analisis_pemda.identifikasi_id' )
                ->where('identifikasi_pemda.sisa_risiko','Ada')
                ->get();
        return view('userpemda1.analisispemda1.index', compact('analisis'));
    }

    public function transaksi()
     {
         $dt = DB::table('analisis_pemda')
                ->select('analisis_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_pemda.tingkat_risiko')
                ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', '=', 'identifikasi_pemda.id')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
                 ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_pemda.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_pemda.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_pemda.sisa_risiko','Ada')
                 ->get();
        return view('userpemda1.analisispemda1.transaksi',compact('dt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idk)
    {
        //
        $kegiatan = DB::table('identifikasi_pemda')->where('id', $idk)->first();
        $risiko = DB::table('identifikasi_pemda')
                ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
                ->select('tbl_baganrisiko.nama_risiko','tbl_baganrisiko.id as id')
                ->get()
                ->pluck('nama_risiko','id');
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        return view('userpemda1.analisispemda1.create', compact('risiko','kemungkinan','dampak','kegiatan'));
    }

    public function googlechart()
      {
        $chart = DB::table('analisis_pemda')
                ->select('analisis_pemda.id as id', 
                    'ref_kemungkinan.nilai as kemungkinan',
                    'ref_dampak.nilai as dampak',
                    'analisis_pemda.tingkat_risiko as tingkat_risiko',
                    'tbl_baganrisiko.nama_risiko as nama_risiko', 'sasaran_pemda.nama_sasaran as nama_sasaran')

                ->join('ref_kemungkinan', 'ref_kemungkinan.id', 'analisis_pemda.kemungkinan_id')
                ->join('ref_dampak', 'ref_dampak.id', 'analisis_pemda.dampak_id')
                ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', 'identifikasi_pemda.id')
                ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', 'tbl_baganrisiko.id')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
                ->orderBy('analisis_pemda.tingkat_risiko', 'desc')
                ->limit(10)
                ->get();

        $dt = DB::table('analisis_pemda')
                ->select('analisis_pemda.id as id','sasaran_pemda.nama_sasaran as nama_sasaran',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_pemda.tingkat_risiko')

                ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', '=', 'identifikasi_pemda.id')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
                 ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_pemda.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_pemda.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_pemda.sisa_risiko','Ada')
                 ->orderBy('analisis_pemda.tingkat_risiko', 'desc')
                 ->get();

        return view('userpemda1.analisispemda1.googlechartpemda', compact('chart', 'dt'));
      }

      public function CetakAnalisis()
      {
        $dt = DB::table('analisis_pemda')
                  ->select('analisis_pemda.id as id',
                    'sasaran_pemda.nama_sasaran as nama_sasaran',
                   'tbl_baganrisiko.nama_risiko as nama_risiko',
                   'ref_kemungkinan.nama_kemungkinan as kemungkinan',
                    'ref_dampak.nama_dampak as dampak', 'analisis_pemda.tingkat_risiko')
                  ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', '=', 'identifikasi_pemda.id')
                  ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
                   ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
                   ->join('ref_kemungkinan', 'analisis_pemda.kemungkinan_id', '=', 'ref_kemungkinan.id')
                   ->join('ref_dampak', 'analisis_pemda.dampak_id', '=', 'ref_dampak.id')
                   ->orderBy('analisis_pemda.id', 'asc')
                   ->get();

        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('userpemda1.analisispemda1.cetak',  compact('dt', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('analisis_pemda.pdf', array('Attachment' => false));
        exit(0);
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
        $srt = new AnalisisPemda();
        $srt->identifikasi_id = $request['identifikasi_id'];
        $srt->kemungkinan_id = $request['kemungkinan_id'];
        $srt->dampak_id = $request['dampak_id'];
        $srt->tingkat_risiko = $request['tingkat_risiko'];
        $srt->save();
        return redirect()->route('transaksipemda');
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
        $this->data['analisis'] = AnalisisPemda::find($id);
        return view('userpemda1.analisispemda1.edit', $this->data);
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
        $srt = AnalisisPemda::find($id);
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->update();
//      return view('useropd1.analisisopd1.index');
      return redirect()->route('transaksipemda');
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
        $a = AnalisisPemda::find($id);
        $a->delete();
        return redirect()->route('transaksipemda');
    }
}
