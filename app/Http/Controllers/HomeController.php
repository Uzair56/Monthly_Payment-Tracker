<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.home');
    }
    public function getPayments(){
        try {
            $users = Payment::where('id','<>',1)->orderBy('id','DESC')->get();
           return view('admin.home', compact('users'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
//   public function addPayment()
//   {
//     return view('admin.add-payment');
//   }
//     public function store(Request $request)
//     {
//         try {
//             DB::beginTransaction();   
//             $data = $request->all();
//             $user = new User;
//             $user->create($data);
//             DB::commit();
//             return redirect('/payments')->with('success', 'Payment Created.');

//         } catch (\Throwable $th) {
//             DB::rollback();
//             return redirect('/payments')->with('error', $th->getMessage());
//         }
//     }
//     public function edit($id){
//         try {
//             $user = User::findOrFail($id);
//             return view('admin.edit-payment',compact('user'));
//         } catch (\Throwable $th) {
//             $th->getMessage();
//             dd($th->getMessage());
//         }
//     }
//     public function update(Request $request, $id)
//     {
//         try {
//             DB::beginTransaction();
//             $user = User::findOrFail($id);
//             $data = $request->all();
//             $user->update($data);
//             DB::commit();
//             return redirect('/payments')->with('success', 'Payment Updated');

//         } catch (\Throwable $th) {
//             //throw $th;
//             DB::rollBack();
//             return redirect('/payments')->with('error', $th->getMessage());
//         }
//     }
//     public function destroy($id) 
//     { 
//         try {   
//             $id = decrypt($id); 
//             DB::beginTransaction();
//             User::findOrFail($id)->delete();
//             DB::commit();
//             return response()->json(['status' => true, 'msg' => 'Payment has been deleted']);

//         } catch (\Exception $e) {
//             DB::rollback();
//             return response()->json(['status' => false, 'msg' => $e->getMessage()]);
//         }
//     } 

//     public function clear($id) 
//     { 
//         try {   
//             $id = decrypt($id); 
//             DB::beginTransaction();
//             $user = User::findOrFail($id);
//             $user->status= 1;
//             $user->save();
//             DB::commit();
//             return response()->json(['status' => true, 'msg' => 'Payment has been cleared!']);

//         } catch (\Exception $e) {
//             DB::rollback();
//             return response()->json(['status' => false, 'msg' => $e->getMessage()]);
//         }
//     } 
}
