<?php

namespace App\Http\Controllers\ohtm_uquv_bulimi;

use App\Http\Controllers\Controller;
use App\Models\Harbiy_unvon;
use App\Models\Jurnal;
use App\Models\QaytaTopshirish;
use App\Models\QaytaTopshirishBaho;
use App\Models\Tinglovchi;
use App\Models\Uqituvchi;
use App\Models\Videmost;
use App\Models\VidemostBaho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QaytaTopshirishController extends Controller
{
    public function index($videmost_id){
        $videmost=QaytaTopshirish::leftJoin('videmosts','qayta_topshirishes.videmost_id','=','videmosts.id')
            ->leftJoin('jurnals', 'videmosts.jurnal_id','=','jurnals.id')
            ->leftJoin('yakuniys','jurnals.id','=','yakuniys.jurnal_id')
            ->leftJoin('fanlars', 'jurnals.fanlar_id', '=','fanlars.id')
            ->leftJoin('guruhs', 'jurnals.guruh_id', '=','guruhs.id')
            ->leftJoin('uquv_yili_ohtms', 'jurnals.uquv_yili_ohtm_id', '=','uquv_yili_ohtms.id')
            ->leftJoin('uqituvchis','qayta_topshirishes.kaf_bosh_id','=','uqituvchis.id')
            ->leftJoin('tinglovchis','qayta_topshirishes.tinglovchi_id','=','tinglovchis.id')
            ->leftJoin('harbiy_unvons','qayta_topshirishes.kaf_bosh_unvon_id','=','harbiy_unvons.id')
            ->where('uquv_yili_ohtms.ohtm_id', auth()->user()->ohtm_id)
//            ->where('fan_uqituvchis.uqituvchi_id', auth()->user()->uqituvchi->id)
            ->select('videmosts.id',
                'qayta_topshirishes.sana as sana',
                'qayta_topshirishes.nomer as nomer',
                'harbiy_unvons.nomi as harbiy_unvon_nomi',
                'qayta_topshirishes.nazorat_oluvchi',
                'uqituvchis.fio as kafedra_boshliq',
                'tinglovchis.fio as tinglovchi',
                'qayta_topshirishes.muddati'
            )
            ->distinct()
            ->get();


        $joriy_uqituvchi=Videmost::leftJoin('uqituvchis','videmosts.joriy_uqituvchi_id','=','uqituvchis.id')
            ->leftJoin('harbiy_unvons','uqituvchis.harbiy_unvon_id','=','harbiy_unvons.id')
            ->where(['ohtm_id'=>auth()->user()->ohtm_id]) //'fakultet_kafedra_id'=>auth()->user()->uqituvchi->fakultet_kafedra_id
            ->select(
                'uqituvchis.fio as joriy_fio',
                'harbiy_unvons.qs_nomi as unvon_qs_nomi'
            )->get()->first();

        $oraliq_uqituvchi=Videmost::leftJoin('uqituvchis','videmosts.oraliq_uqituvchi_id','=','uqituvchis.id')
            ->leftJoin('harbiy_unvons','uqituvchis.harbiy_unvon_id','=','harbiy_unvons.id')
            ->where(['ohtm_id'=>auth()->user()->ohtm_id]) //'fakultet_kafedra_id'=>auth()->user()->uqituvchi->fakultet_kafedra_id
            ->select(
                'uqituvchis.fio as oraliq_fio',
                'harbiy_unvons.qs_nomi as unvon_qs_nomi'
            )->get()->first();

        $harbiy_unvon=Harbiy_unvon::all();

        $uqituvchi=Uqituvchi::where('uqituvchis.rahbar', true)->get();
        $tinglovchi = Tinglovchi::leftJoin('videmost_bahos','videmost_bahos.tinglovchi_id','=','tinglovchis.id')
            ->where(['tinglovchis.ohtm_id'=> auth()->user()->ohtm_id,'videmost_bahos.videmost_id'=>$videmost_id ])
            ->select(
                'tinglovchis.id',
                'tinglovchis.fio')
            ->get();

//        dd($tinglovchi);
        return view('ohtm_uquv_bulimi.qayta_topshirish',compact('videmost','harbiy_unvon' ,'oraliq_uqituvchi','joriy_uqituvchi' ,'uqituvchi','tinglovchi'));
    }

    public function create(Request $request, $videmost_id)
    {
        $request->validate([
            'sana' => 'required|date',
            'nomer' => 'required',
            'nazorat_oluvchi' => 'required',
            'kaf_bosh_unvon_id' => 'required|integer',
            'kaf_bosh_id' => 'required',
            'muddati' => 'required',
            'tinglovchi_id'=>'required',
        ], [
            'sana.required'=>'Sana kiritish majburiy!',
            'nomer.required' => 'Qaydnoma raqamini kiritish majburiy!',
            'nazorat_oluvchi.required' => 'Nazorat oluvchini kiritish majburiy!',
            'kaf_bosh_unvon_id.required' => 'Harbiy unvon nomini tanlang!',
            'kaf_bosh_id.required' => 'Kafedra boshlig\'ini kiritish majburiy!',
            'muddati.required' => 'Muddati kiritish majburiy!',
            'tinglovchi_id.required' => 'Tinglovchi tanlash majburiy!',
        ]);



        DB::transaction(function () use ( $request ,$videmost_id) {
            $fan = new QaytaTopshirish();
            $fan->sana = $request->sana;
            $fan->nomer = $request->nomer;
            $fan->nazorat_oluvchi = $request->nazorat_oluvchi;
            $fan->kaf_bosh_unvon_id = $request->kaf_bosh_unvon_id;
            $fan->kaf_bosh_id = $request->kaf_bosh_id;
            $fan->muddati = $request->muddati;
            $fan->videmost_id = $videmost_id ;
            $fan->tinglovchi_id =$request->tinglovchi_id ;
            $fan->save();
        });


        return redirect()->back()->withSuccess("Ma'lumot qo'shildi!");
    }

    public function edit(Request $request, $id){
        $request->validate([
            'sana' => 'required|date',
            'nomer' => 'required',
            'nazorat_oluvchi' => 'required',
            'kaf_bosh_unvon_id' => 'required|integer',
            'kaf_bosh_id' => 'required',
            'muddati' => 'required',
            'tinglovchi_id'=>'required',
        ], [
            'sana.required'=>'Sana kiritish majburiy!',
            'nomer.required' => 'Qaydnoma raqamini kiritish majburiy!',
            'nazorat_oluvchi.required' => 'Nazorat oluvchini kiritish majburiy!',
            'kaf_bosh_unvon_id.required' => 'Harbiy unvon nomini tanlang!',
            'kaf_bosh_id.required' => 'Kafedra boshlig\'ini kiritish majburiy!',
            'muddati.required' => 'Muddati kiritish majburiy!',
            'tinglovchi_id.required' => 'Tinglovchi tanlash majburiy!',
        ]);



        DB::transaction(function () use ( $request ,$id ) {
            $fan = QaytaTopshirish::findOrFail($id);
            $fan->sana = $request->sana;
            $fan->nomer = $request->nomer;
            $fan->nazorat_oluvchi = $request->nazorat_oluvchi;
            $fan->kaf_bosh_unvon_id = $request->kaf_bosh_unvon_id;
            $fan->kaf_bosh_id = $request->kaf_bosh_id;
            $fan->muddati = $request->muddati;
            $fan->tinglovchi_id =$request->tinglovchi_id ;
            $fan->save();
        });


        return redirect()->back()->withSuccess("Ma'lumot yangilandi!");
    }

    public function delete($id){
        $fan=QaytaTopshirish::find($id);
        $fan->delete();

        return redirect()->back()->withSuccess("Ma'lumot o'chirildi!");

    }
}
