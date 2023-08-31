<?php

namespace App\Http\Controllers;

use App\Models\GetLoan;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function user(){
        $users = GetLoan::with('payments')->where('lender_id',Auth::user()->id)->get();
        foreach($users as $user){
            $id = $user['id'];
            $payments = Payment::with('stats')->where('get_loan_id',$id)->get();
            if($payments->count() > 0){
                $user_id = $user['user_id'];
                $payer = User::find($user_id);
                return view('monthly_invoices.user',[
                    'payments' => $payments,
                    'payer' => $payer,
                    'users' => $users,
                    'type' => 'user'
                ]);
            }
        }
        abort(404);
    }


    public function borrow(){
        $users = GetLoan::with('payments')->where('user_id',Auth::user()->id)->get();
        foreach($users as $user){
            $id = $user['id'];
            $payments = Payment::with('stats')->where('get_loan_id',$id)->get();
            if($payments->count() > 0){
                $user_id = $user['user_id'];
                $payer = User::find($user_id);
                return view('monthly_invoices.user',[
                    'payments' => $payments,
                    'payer' => $payer,
                    'users' => $users,
                    'type' => 'borrower'
                ]);
            }
        }
        abort(404);
    }

    public function search(Request $request){
        $users = GetLoan::with('payments')->where('user_id',Auth::user()->id)->get();
        foreach($users as $user){
            $id = $user['id'];
            $payments = Payment::with('stats')->where('get_loan_id',$request['search_user'])->get();
            if($payments->count() > 0){
                $user_id = $user['user_id'];
                $payer = User::find($user_id);
                return view('monthly_invoices.user',[
                    'payments' => $payments,
                    'payer' => $payer,
                    'users' => $users,
                    'type' => 'borrower'
                ]);
            }
        }
        abort(404);
    }
}
