<?php

namespace App\Http\Controllers;

use App\Models\CreateLoan;
use App\Models\GetLoan;
use App\Models\Interest;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserDetail;
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
            $attributes['lender_id'] = $request['lender_id'];
            $attributes['create_loan_id'] = $request['create_loan_id'];

            $attributes['status'] = 1;
            $step1 = 2/100;
            $step2 = $step1 * $attributes['amount'];
            $step3 = $step2 * $attributes['month'];
            $step4 = $step3 + $attributes['amount'];
            $step5 = $step4 / $attributes['month'];


            $attributes['monthly_payment'] = ceil($step5);
            $attributes['date_released'] = Carbon::now()->format('F d,Y');

            $datas = [];
            for($i = 1; $i<=$attributes['month']; $i++){
               $datas[$i] = Carbon::now()->addDays(30 * $i)->format('F d, Y');
            }

            $user = User::with('detail')->find(Auth::user()->id);

            return view('request.request_data',[
                'attributes' => $attributes,
                'datas' => $datas,
                'user' => $user
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
        
        $randomNumber = random_int(10000000, 99999999);
   

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
        $attributes['reference'] = $randomNumber;


         GetLoan::create($attributes);

        return redirect('/home')->with('message','Get Loan Successfully');

    }


    public function show_request($id){


        $get = GetLoan::find($id);

        $user = User::with('detail')->find($get->user_id);

        $step1 = 2/100;
        $step2 = $step1 * $get->amount;
        $step3 = $step2 * $get->month;
        $step4 = $step3 + $get->amount;
        $step5 = $step4 / $get->month;

        $get['monthly_payment'] = ceil($step5);
        
        $get['date_released'] = $get->created_at->format('F d,Y');
        
        $datas = [];
        for($i = 1; $i<=$get->month; $i++){
           $datas[$i] = $get->created_at->addDays(30 * $i)->format('F d,Y');
        }

        return view('request.approve_data',[
            'get' => $get,
            'datas' => $datas,
            'user' => $user
        ]);

   }

   
   public function approve($id, Request $request){
        $get = GetLoan::find($id);
        for($i = 1; $i<=$request['month']; $i++){
            Payment::create([
                'get_loan_id' => $id,
                'month' => $get->created_at->addDays(30 * $i)->format('F d,Y'),
                'monthly_payment' => $request['monthly_payment'],
                'status' => 6
            ]);
         }
        $update = GetLoan::find($id);

         $update->update([
            'status' => '2'
        ]);

         return redirect('/request/loan')->with('message','Successfully Approved');
    }

    
}
