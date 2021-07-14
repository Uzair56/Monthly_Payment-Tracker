<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StorePaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
       $payments = Payment::where('status',0)->with('users')->get();
       return view('admin.home',compact('payments'));
    }
    public function clearedPayments(){
        $payments = Payment::where('status',1)->with('users')->get();
        return view('admin.cleared-payments',compact('payments'));
    }
  public function addPayment()
  {

    try {
        $users = User::where('id','<>',1)->orderBy('id','DESC')->get();
       return view('admin.add-payment', compact('users'));
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
    }
  }
  public function addUser(StoreUserRequest $request)
  {
      try {
          DB::beginTransaction();
          $data = $request->validated();
          $user = new User;
          $user->create($data);
          DB::commit();
          return redirect()->back()->with('success','User Created'); 
      } catch (\Throwable $th) {
          dd($th->getMessage());
      }
  }
    public function store(StorePaymentRequest $request)
    {
        try {
            DB::beginTransaction();   
            $data = $request->validated();
            $payment = new Payment;
            $payment->create($data);
            DB::commit();
            return redirect('/home')->with('success', 'Payment Created.');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/home')->with('error', $th->getMessage());
        }
    }
    public function edit($id){
        try {
            $payment = Payment::findOrFail($id);
            $users = User::where('id','<>',1)->orderBy('id','DESC')->get();
            return view('admin.edit-payment',compact('users','payment'));
        } catch (\Throwable $th) {
            $th->getMessage();
            dd($th->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $payment = Payment::findOrFail($id);
            $data = $request->all();
            $payment->update($data);
            DB::commit();
            return redirect('/home')->with('success', 'Payment Updated');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect('/home')->with('error', $th->getMessage());
        }
    }
    public function destroy($id) 
    { 
        try {   
            $id = decrypt($id); 
            DB::beginTransaction();
            Payment::findOrFail($id)->delete();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Payment has been deleted']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    } 

    public function clear($id) 
    { 
        try {   
            $id = decrypt($id); 
            DB::beginTransaction();
            $payment = Payment::findOrFail($id);
            $payment->status= 1;
            $payment->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Payment has been cleared!']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    } 
}
