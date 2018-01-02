<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\adminpemda\OPD;

class AppCtrl extends Controller
{
    //

	public function getIndex()
    {   
        if(Auth::user()->hasRole('Admin Pemda')) {
            return view('home.adminpemda');
        }

        if (Auth::user()->hasRole('User Pemda 1')) {

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

                return view('home.userpemda1', compact('chart', 'dt'));
            }

            if (Auth::user()->hasRole('User Pemda 2')) {

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


                return view('home.userpemda2', compact('chart', 'dt'));
            }

            if (Auth::user()->hasRole('Admin OPD')) {

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

            $dt = DB::table('analisis_opd')
                ->select('analisis_opd.id as id','sasaran_opd.nama_sasaran as nama_sasaran',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_opd.tingkat_risiko')

                ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_opd.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_opd.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_opd.sisa_risiko','Ada')
                 ->orderBy('analisis_opd.tingkat_risiko', 'desc')
                 ->get();

            $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
                return view('home.adminopd', compact('chart', 'dt', 'nama_opd'));
            }

            if (Auth::user()->hasRole('User OPD 1')) {

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

            $dt = DB::table('analisis_opd')
                ->select('analisis_opd.id as id','sasaran_opd.nama_sasaran as nama_sasaran',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_opd.tingkat_risiko')

                ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_opd.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_opd.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_opd.sisa_risiko','Ada')
                 ->orderBy('analisis_opd.tingkat_risiko', 'desc')
                 ->get();

            $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
                return view('home.useropd1', compact('chart', 'dt', 'nama_opd'));
            }

            if (Auth::user()->hasRole('User OPD 2')) {

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

            $dt = DB::table('analisis_opd')
                ->select('analisis_opd.id as id','sasaran_opd.nama_sasaran as nama_sasaran',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_opd.tingkat_risiko')

                ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_opd.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_opd.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_opd.sisa_risiko','Ada')
                 ->orderBy('analisis_opd.tingkat_risiko', 'desc')
                 ->get();

            $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();

                return view('home.useropd2', compact('chart', 'dt', 'nama_opd'));
            }

            if (Auth::user()->hasRole('User OPD Kegiatan 1')) {

                $chart = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id','kegiatan_opd.nama_kegiatan as nama_kegiatan',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan',
                  'ref_dampak.id as dampak', 'analisis_kegiatan.tingkat_risiko')
                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', '=', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_kegiatan.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_kegiatan.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_kegiatan.sisa_risiko','Ada')
                 ->orderBy('analisis_kegiatan.tingkat_risiko', 'desc')
                 ->limit(10)
                 ->get();

                $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
                return view('home.useropdkegiatan1', compact('chart', 'dt', 'nama_opd'));
            }

            if (Auth::user()->hasRole('User OPD Kegiatan 2')) {

                $chart = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id','kegiatan_opd.nama_kegiatan as nama_kegiatan',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan',
                  'ref_dampak.id as dampak', 'analisis_kegiatan.tingkat_risiko')
                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', '=', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_kegiatan.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_kegiatan.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_kegiatan.sisa_risiko','Ada')
                 ->orderBy('analisis_kegiatan.tingkat_risiko', 'desc')
                 ->limit(10)
                 ->get();

                $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
                return view('home.useropdkegiatan2', compact('chart', 'dt', 'nama_opd'));
            }
    }

}
