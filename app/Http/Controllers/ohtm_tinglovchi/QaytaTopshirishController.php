<?php

namespace App\Http\Controllers\ohtm_tinglovchi;

use App\Http\Controllers\Controller;
use App\Models\Baho;
use App\Models\Dars_kun;
use App\Models\Jurnal;
use App\Models\Mavzu;
use App\Models\Tinglovchi;
use Illuminate\Http\Request;

class QaytaTopshirishController extends Controller
{
    public function index($jurnal_id){

        $jurnal = Jurnal::where('id', $jurnal_id)->first();
        $mavzus = Mavzu::where(['jurnal_id'=>$jurnal_id, 'used'=>(bool)false])->get();

        $tinglovchis = Tinglovchi::where('guruh_id', $jurnal->guruh_id)->get();
        $dars_kuns = Dars_kun::with('get_baho_only')->where('jurnal_id', $jurnal_id)
            ->where('nazorat_turi_id',5)->get();
        $bahos = Baho::orderBy('id')->get();
        $baho_array = $bahos->keyBy('id')->toArray();


        return view('ohtm_tinglovchi.qayta_topshirish', compact('jurnal', 'mavzus', 'dars_kuns', 'tinglovchis', 'bahos', 'baho_array'));
    }
}
