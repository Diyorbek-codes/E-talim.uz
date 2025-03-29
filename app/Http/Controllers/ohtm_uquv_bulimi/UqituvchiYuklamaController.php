<?php

namespace App\Http\Controllers\ohtm_uquv_bulimi;

use App\Http\Controllers\Controller;
use App\Models\Fan_uqituvchi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UqituvchiYuklamaController extends Controller
{
    public function index($uqituvchi_id)
    {


        $fan_uqituvchis = Fan_uqituvchi::leftJoin('jurnals', 'jurnal_id', '=', 'jurnals.id')
            ->leftjoin('fanlars', 'jurnals.fanlar_id', '=', 'fanlars.id')
            ->with('getJurnal')->where('uqituvchi_id', $uqituvchi_id)
            ->where('fanlars.ohtm_id', auth()->user()->ohtm_id)
            ->distinct()
            ->get();


        foreach ($fan_uqituvchis as $jurnal) {
            $yuklama = 0;
            foreach ($jurnal->getJurnal->getMavzus as $mavzu) {
                if ($mavzu->used == true && $mavzu->uqituvchi_id == $uqituvchi_id) {
                    $yuklama += $mavzu->soat;
                }
            }
            $jurnal['getYuklama'] = $yuklama;

        }

        // dd($fan_uqituvchis);

        return view("ohtm_uquv_bulimi.uqituvchi_yuklama", compact('fan_uqituvchis'));

    }
}
