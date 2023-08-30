<?php

namespace App\Http\Controllers;

use App\Models\CreateLoan;
use App\Models\GetLoan;
use App\Models\Interest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function show($id){
        $loan = CreateLoan::find($id);
        $interests = Interest::where('create_loan_id',$id)->get();
        return view('loan.get',
        [
            'loan' => $loan,
            'interests' => $interests
        ]);
    }

    public function get(Request $request){

        if ($request['min'] >= $request['amount']) {
            return back()->with('message', 'Please input the value greater than or equal to '.$request['min']);
        } else if ($request['amount'] > $request['max']) {
            return back()->with('message', 'Please input the value less than or equal to '.$request['max']);
        } else {

            $attributes = $request->validate([
                'amount' => 'required',
                'purpose' => 'required'

            ]);

            $mi = $request['month_interest'];
            $attributes['month'] = $mi[0].$mi[1];
            $attributes['interest'] = $mi[2];
            $attributes['user_id'] = Auth::user()->id;
            $attributes['lender_id'] =$request['lender_id'];
            $attributes['create_loan_id'] = $request['create_loan_id'];

            $attributes['status'] = 1;
            $datas = [];
            for($i = 1; $i<=24; $i++){
               $datas[$i] = Carbon::now()->addDays(30 * $i)->format('F d,Y');
            }

            return view('request.request_data',[
                'attributes' => $attributes,
                'datas' => $datas
            ]);

            // GetLoan::create($attributes);
            // return redirect('create/loan');
        }
    }

    public function list(){
        // $gets = GetLoan::where('user_id',Auth::user()->id)->get();

        // $users = User::with('getloans')->where('id',Auth::user()->id)->get();
        $gets = GetLoan::with('users')->with('stats')->where('lender_id','!=',Auth::user()->id)->get();

        return view('loan.loan_list',compact('gets'));
    }
    

    public function request(){
        // $gets = GetLoan::where('user_id',Auth::user()->id)->get();

        // $users = User::with('getloans')->where('id',Auth::user()->id)->get();
        $gets = GetLoan::with('requests')->with('stats')->where('lender_id',Auth::user()->id)->get();

        return view('request.index',compact('gets'));
    }

    public function request_data($id){
         $datas = [];
         for($i = 1; $i<=24; $i++){
            $datas[$i] = Carbon::now()->addDays(30 * $i)->format('F d,Y');
         }
        return view('request.request_data',[
            'datas' => $datas
        ]);
    }

    public function storegetloan(Request $request){
        
        $attributes = $request->validate([
            'amount' => 'required',
            'purpose' => 'required',
            'month' => 'required',
            'interest' => 'required',
            'user_id' => 'required',
            'lender_id' => 'required',
            'create_loan_id' => 'required',
            'status' => 'required',

        ]);
         GetLoan::create($attributes);

        return redirect('/home');

    }
    

    
}
