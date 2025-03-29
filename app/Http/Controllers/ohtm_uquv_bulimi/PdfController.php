<?php

namespace App\Http\Controllers\ohtm_uquv_bulimi;

use App\Http\Controllers\Controller;

use App\Models\Jurnal;
use App\Models\Tinglovchi;
use App\Models\Videmost;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {


        $id=7;
        // Ma'lumotlarni tayyorlaymiz (misol uchun)
        $videmost = Videmost::leftJoin('videmost_bahos','videmosts.id','=','videmost_bahos.videmost_id')
            ->leftJoin('tinglovchis','videmost_bahos.tinglovchi_id','=','tinglovchis.id')
            ->leftJoin('jurnals','videmosts.jurnal_id','=','jurnals.id')
            ->leftJoin('uquv_yili_ohtms','uquv_yili_ohtms.id','=','jurnals.uquv_yili_ohtm_id')
            ->leftJoin('guruhs','guruhs.id','=','jurnals.guruh_id')
            ->leftJoin('kurs_bosqiches','kurs_bosqiches.id','=','guruhs.kurs_bosqiches_id')
            ->leftJoin('fanlars','fanlars.id','=','jurnals.fanlar_id')
            ->leftJoin('ohtms','fanlars.ohtm_id','=','ohtms.id')
            ->leftJoin('harbiy_unvons','videmosts.uquv_bulim_boshliq_unvon_id','=','harbiy_unvons.id')

            ->where(['videmosts.id'=> $id])
            ->select(
                'videmosts.id',
                'ohtms.nomi as ohtm_nomi',
                'videmosts.nomer',
                'uquv_yili_ohtms.nomi as uquv_yili_nomi',
                'kurs_bosqiches.nomi as kurs_nomi',
                'guruhs.nomi as guruh_nomi',
                'fanlars.nomi as fan_nomi',
                'videmosts.yakuniy_oluvchi',
                'videmosts.sana',
                'harbiy_unvons.nomi as harbiy_unvon_nomi',
                'videmosts.uquv_bulim_boshliq',
                'videmosts.xulosa',
                'videmosts.jami_tinglovchi',
                'videmosts.alo',
                'videmosts.yaxshi',
                'videmosts.faol',
                'videmosts.qoniqarli',
                'videmosts.qoniqarsiz',
                'videmosts.baholanmagan',
                'jurnals.id as jurnal_id'
            )
            ->first();
        $joriy_uqituvchi=Videmost::leftJoin('uqituvchis','videmosts.joriy_uqituvchi_id','=','uqituvchis.id')
            ->leftJoin('harbiy_unvons','uqituvchis.harbiy_unvon_id','=','harbiy_unvons.id')
            ->where(['ohtm_id'=>1,
//                'fakultet_kafedra_id'=>auth()->user()->uqituvchi->fakultet_kafedra_id,
                'videmosts.id'=>$id])
            ->select(
                'uqituvchis.fio as joriy_fio',
                'harbiy_unvons.qs_nomi as unvon_qs_nomi'
            )->first();
//        dd($joriy_uqituvchi);

        $oraliq_uqituvchi=Videmost::leftJoin('uqituvchis','videmosts.oraliq_uqituvchi_id','=','uqituvchis.id')
            ->leftJoin('harbiy_unvons','uqituvchis.harbiy_unvon_id','=','harbiy_unvons.id')
            ->where(['ohtm_id'=>1,
//                'fakultet_kafedra_id'=>auth()->user()->uqituvchi->fakultet_kafedra_id,
                'videmosts.id'=>$id])
            ->select(
                'uqituvchis.fio as oraliq_fio',
                'harbiy_unvons.qs_nomi as unvon_qs_nomi'
            )->get()->first();
        $jurnal = Jurnal::where('id', $videmost->jurnal_id)->first();
        $guruh_id = $jurnal->guruh_id;
//        dd($videmost);
        $kursants = Tinglovchi::with(['getVidemostBaho'=>function($query) use ($id){
            $query->where('videmost_id', $id);
        }, 'harbiy_unvon'])->where(['guruh_id'=>$guruh_id, 'ohtm_id'=>1])->get();
//        dd($kursants);

        $kursants = [
            ['unvon' => 'Leytenant', 'fio' => 'Aliyev Alisher', 'joriy' => 85, 'oraliq' => 90, 'yakuniy' => 88, 'umumiy' => 87, 'baho' => 'A\'lo'],
            ['unvon' => 'Serjant', 'fio' => 'Ismoilov Jamshid', 'joriy' => 70, 'oraliq' => 75, 'yakuniy' => 80, 'umumiy' => 75, 'baho' => 'Yaxshi'],
        ];

        // PDF tayyorlash
        $pdf = Pdf::loadView('ohtm_uquv_bulimi.videmost_baho', [
            'videmost' => $videmost,
            'joriy_uqituvchi' => $joriy_uqituvchi,
            'oraliq_uqituvchi' => $oraliq_uqituvchi,
            'kursants'=>$kursants
        ])
            ->setPaper('a4', 'portrait');

        return $pdf->download('videmost_baho.pdf');
    }
}
