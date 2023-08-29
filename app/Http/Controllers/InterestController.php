<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    
    public function create($id){
        $interests = Interest::where('create_loan_id', $id)->get();

        return view('interest.create',[
            'id' => $id,
            'interests' => $interests
        ]);
    }

    public function store(Request $request,$id){

    $attributes = $request->validate([
        'month' => 'required',
        'interest' => 'required',
    ]);
    $attributes['create_loan_id'] = $id;

    Interest::create($attributes);
    // return back();
    return redirect('create/interest/'.$id);
    }


}
