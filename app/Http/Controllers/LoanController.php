<?php

namespace App\Http\Controllers;

use App\Models\CreateLoan;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{

    public function index(){
        $users = User::with('loans')->with('interests')->where('id','!=',Auth::user()->id)->get();
        // dd(compact('users'));
        // $users = CreateLoan::with('user')->where('user_id','!=',Auth::user()->id)->get();
        return view('home.index',compact('users'));
     }
 


    public function create(){
        $user = CreateLoan::orderBy('id', 'desc')->first();
        $id = $user->id + 1;
        $count = Interest::where('create_loan_id', $id)->count();
        if($count > 0){
            $interests = Interest::where('create_loan_id', $id)->get();
            return view('loan.create',[
                'loan' => $id,
                'interests' => $interests,
                'count' => $count
            ]);
        }
        return view('loan.create',[
            'loan' => $id,
            'count' => $count
        ]);

    }


    public function store(Request $request){
        $attributes = $request->validate([
            'min_amount' => 'required',
            'max_amount' => 'required',
            'description' => 'required',
        ]);
        $attributes['user_id'] = Auth::user()->id;
        CreateLoan::create($attributes);
        return back();
    }
}
