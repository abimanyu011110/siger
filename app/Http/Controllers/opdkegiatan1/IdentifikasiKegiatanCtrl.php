<?php

namespace App\Http\Controllers\opdkegiatan1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\opdkegiatan1\reqIdentifikasiKegiatan;
use App\Models\opdkegiatan1\IdentifikasiKegiatan;
use App\Models\adminpemda\Kategori;
use App\Models\adminpemda\Baganrisiko;
use App\Models\adminpemda\Proses;
use App\Models\adminopd\SasaranOPD;
use App\Models\adminopd\KegiatanOPD;
use App\Models\adminopd\ProgramOPD;
use App\Models\adminpemda\Pemda;
use App\Models\adminpemda\OPD;
use DB;
use Auth;
use PDF;


class IdentifikasiKegiatanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $identifikasikegiatan = DB::table('identifikasi_kegiatan')
                ->select('identifikasi_kegiatan.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'program_opd.nama_program as nama_program', 'kegiatan_opd.nama_kegiatan as nama_kegiatan', 'identifikasi_kegiatan.periode as periode', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'kegiatan_opd.jabatan as pemilik_risiko','identifikasi_kegiatan.uraian as uraian', 'identifikasi_kegiatan.sumber_risiko as sumber_risiko', 'identifikasi_kegiatan.kontrol as kontrol', 'identifikasi_kegiatan.penyebab as penyebab', 'identifikasi_kegiatan.dampak as dampak', 'identifikasi_kegiatan.pengendalian as pengendalian', 'identifikasi_kegiatan.sisa_risiko as sisa_risiko')

                ->join('sasaran_opd', 'identifikasi_kegiatan.sasaran_id', '=', 'sasaran_opd.id')
                ->join('program_opd', 'identifikasi_kegiatan.program_id', '=', 'program_opd.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('opdkegiatan1.identifikasikegiatan1.index', compact('identifikasikegiatan', 'nama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['sasaran'] = DB::table('sasaran_opd')
                ->where('sasaran_opd.opd_id', Auth::user()->opd_id)
                ->get()
                ->pluck('nama_sasaran', 'id');
        $this->data['proses'] = Proses::pluck('nama_proses', 'id');
        $this->data['periode'] = ['Semester 1', 'Semester 2'];
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['C', 'U'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        $this->data['nama'] = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        return view('opdkegiatan1.identifikasikegiatan1.create', $this->data);
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
        $a = new IdentifikasiKegiatan();
        $a->opd_id = Auth::user()->opd_id;
        $a->sasaran_id = $request->sasaran_id;
        $a->program_id = $request->program_id;
        $a->kegiatan_id = $request->kegiatan_id;
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
            return redirect()->route('identifikasikegiatan1.index');
        };
        
    }

    public function pilihProgram($id) 
    {  
        $program = DB::table('program_opd')
                ->where('sasaran_id', $id)
                ->get()
                ->pluck('nama_program', 'id');
        return json_encode($program);
    }

    public function pilihKegiatan($idk) 
    {  
        $kegiatan = KegiatanOPD::select('nama_kegiatan', 'id')
                ->where('program_id', $idk)
                ->get()
                ->pluck('nama_kegiatan', 'id');
        return json_encode($kegiatan);
    }

    public function pilihPemilik($id) 
    {  
        $pemilik = DB::table('kegiatan_opd')
                ->where('id', $id)
                ->get()
                ->pluck('jabatan', 'id');
        return json_encode($pemilik);
    }

    public function pilihRisiko($id) 
    {  
        $risiko = DB::table('tbl_baganrisiko')
                ->where('proses_id', $id)
                ->get()
                ->pluck('nama_risiko', 'id');
        return json_encode($risiko);
    }

    public function Cetak()
    {
        $identifikasikegiatan = DB::table('identifikasi_kegiatan')
                ->select('identifikasi_kegiatan.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'program_opd.nama_program as nama_program', 'kegiatan_opd.nama_kegiatan as nama_kegiatan', 'identifikasi_kegiatan.periode as periode', 'tbl_proses.nama_proses as nama_proses', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'kegiatan_opd.jabatan as pemilik_risiko','identifikasi_kegiatan.uraian as uraian', 'identifikasi_kegiatan.sumber_risiko as sumber_risiko', 'identifikasi_kegiatan.kontrol as kontrol', 'identifikasi_kegiatan.penyebab as penyebab', 'identifikasi_kegiatan.dampak as dampak', 'identifikasi_kegiatan.pengendalian as pengendalian', 'identifikasi_kegiatan.sisa_risiko as sisa_risiko')

                ->join('sasaran_opd', 'identifikasi_kegiatan.sasaran_id', '=', 'sasaran_opd.id')
                ->join('program_opd', 'identifikasi_kegiatan.program_id', '=', 'program_opd.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->join('tbl_proses', 'identifikasi_kegiatan.proses_id', 'tbl_proses.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->orderBy('kegiatan_opd.nama_kegiatan')
                ->get();

        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('opdkegiatan1.identifikasikegiatan1.cetak',  compact('identifikasikegiatan', 'nama', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape'); 
        return $pdf->stream();
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
        $this->data['proses'] = Proses::pluck('nama_proses', 'id');
        $this->data['program'] = ProgramOPD::pluck('nama_program','id');
        $this->data['kegiatan'] = KegiatanOPD::pluck('nama_kegiatan','id');
        $this->data['risiko'] = Baganrisiko::pluck('nama_risiko', 'id');
        $this->data['sumber_risiko'] = ['Internal', 'Eksternal', 'Lainnya'];
        $this->data['kontrol'] = ['C', 'U'];
        $this->data['sisa_risiko'] = ['Ada', 'Tidak Ada'];
        $this->data['identifikasi'] = IdentifikasiKegiatan::find($id);
        return view('opdkegiatan1.identifikasikegiatan1.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqIdentifikasiKegiatan $request, $id)
    {
        //
        $input = $request->all();
        $identifikasi = IdentifikasiKegiatan::find($id);
        if ($identifikasi->update($input)) {
            return redirect()->route('identifikasikegiatan1.index');
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
        $identifikasi = IdentifikasiKegiatan::find($id);
        $identifikasi->delete();
        return redirect()->route('identifikasikegiatan1.index');
    }
}
