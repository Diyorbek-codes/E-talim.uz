<?php

namespace App\Http\Controllers\ohtm_uqituvchi;

use App\Http\Controllers\Controller;
use App\Models\Fakultet_kafedra;
use App\Models\Harbiy_unvon;
use App\Models\Ilmiy_daraja;
use App\Models\Ilmiy_unvon;
use App\Models\Ohtm;
use App\Models\Permission;
use App\Models\Til;
use App\Models\Uqituvchi;
use App\Models\Uqituvchi_holat;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParolYangilashController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        return view('ohtm_uqituvchi.parolni_yangilash', compact('userId'));
    }

//    public function changePassword(Request $request, $userId)
//    {
//        $request->validate([
//            'new_password' => 'required|min:3',
//        ]);
//
//        $user = User::findOrFail($userId);
//        $user->password = Hash::make($request->new_password);
//        $user->save();
//
//        return redirect()->back()->with('success', 'Parol muvaffaqiyatli o‘zgartirildi!');
//    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:3|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Eski parol noto‘g‘ri!']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Yangi parol eski parol bilan bir xil bo‘lishi mumkin emas!']);
        }

        if ($request->new_password != $request->new_password_confirmation) {
            return back()->withErrors(['new_password_confirmation' => 'Yangi parol va uni tasdiqlanishi bir xil bo‘ishi kerak !']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();
        session()->flush();
        return redirect('/login')->with('success', 'Parol muvaffaqiyatli o‘zgartirildi. Iltimos, qayta login qiling.');

    }
}
