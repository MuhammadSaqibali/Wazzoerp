<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\ProductServiceCategory;
use App\add__Expense;
use App\BankAccount;
use App\Vender;
use DB;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;

class addExpense extends Controller
{
    public function addExpense()
    {
        $category = ProductServiceCategory::all();
        $bank=BankAccount::all();
        $data = compact( 'category','bank');
        return view('addExpense.add_expense')->with($data);
    }
    public function insert(Request $request)
    {
        $stu = new add__Expense();
        $stu->date = $request['date'];
        $stu->m_name = $request['merchant'];

        $file = $request->file('attachment');
        $extension = $file->getClientOriginalExtension();
        $filename = time(). "." . $extension;
        $file->move('uploads/expense/',$filename);
        $stu->attachment = $filename;

        // filename= $request->file('attachment')->store('uploads/expense/');
        
        $stu->c_id = $request['category'];
        $stu->amount = $request['amount'];
        $stu->currency = $request['currency'];
        // if(empty($request['mile'])){
        //     $stu->mile = '0'; 
        // }else{
            $stu->mile = $request['mile'];
        // }
        // if(empty($request['milesamount'])){
        //     $stu->m_amount='0';
        // }else{
            $stu->m_amount = $request['milesamount'];
        // }
        // if(empty($request['milesamount'])){
        //     $stu->totalm_amount='0';
        // }else{
            $stu->totalm_amount = $request['total'];
        // }        
        $stu->totalexp = $request['total']+$request['amount'];
        $stu->payment_mode = $request['payment'];
        $stu->paid_through = $request['paid'];
        $stu->description = $request['description'];
        $stu->save();
        if($stu){
        $id  =  DB::getPdo()->lastInsertId();  
        $stu1 = new Transaction();

        $stu1->date = $request['date'];
        $stu1->payment_id = $request['currency'];
        $stu1->user_type = $id;
        $stu1->created_by = \Auth::user()->creatorId();
        $stu1->account = '5';
        $category_name = ProductServiceCategory::all();
        foreach ($category_name as $row) {
            if($request['category'] == $row->id){
                $stu1->category = $row['name'];
            }
        }    
        $stu1->description = $request['description'];
        $stu1->amount = $request['total']+$request['amount'];
        if($request['payment']==1){
            $stu1->type = 'Cash';
        }elseif($request['payment']==2){
            $stu1->type = 'Credit Card';
        }elseif($request['payment']==3){
            $stu1->type = 'Debit Card';
        }
        $stu1->save();
        
        return redirect('expense')->with('success', 'Bill Added successfully.');
    }    
 }
    public function show()
    {
        $vender = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $vender->prepend('All', '');
        $bills = add__Expense::all();
        $category = ProductServiceCategory::all();
        $bank=BankAccount::all();
        $data = compact('bills', 'category','bank');
        return view('addExpense.expense')->with($data);
    }
    public function receipt($id)
    {
      $user = add__Expense::find($id);
      $category = ProductServiceCategory::find($user->c_id);
      $time=explode(" ",$user->created_at);
      $data = compact('user','category','time');
         

        return view('addExpense.Receipt')->with($data);
    }
    public function filter(Request $request)
    {
         $start_date = $request['startdate']; 
        $end_date = $request['enddate']; 
        $vender = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $vender->prepend('All', '');
        $bills = add__Expense::select('*')
                      ->where('date','>=',$start_date)
                      ->where('date','<=',$end_date)
                      ->get()->all(); // all() function fetch all data from database
        $category = ProductServiceCategory::all();
        $bank=BankAccount::all();
        $data = compact('bills', 'category','bank');
        return view('addExpense.expense')->with($data);
    }
    public function edit_expence(Request $request){
        $id=$request->ide;
        $stu=add__Expense::find($id);
        $category = ProductServiceCategory::all();
        $stu->date = $request['date'];
        $stu->m_name = $request['merchant'];

        if(!empty($request->file('attachment'))){
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). "." . $extension;
            $file->move('uploads/expense/',$filename);
            $stu->attachment = $filename;
        }else{
            $stu->attachment = $stu->attachment;
        }    
        $stu->c_id = $request['category'];
        $stu->amount = $request['amount'];
        $stu->currency = $request['currency'];
        if(empty($request['mile'])){
            $stu->mile = 0; 
        }else{
            $stu->mile = $request['mile'];
        }
        if(empty($request['milesamount'])){
            $stu->m_amount=0;
        }else{
            $stu->m_amount = $request['milesamount'];
        }
        if(empty($request['milesamount'])){
            $stu->totalm_amount=0;
        }else{
            $stu->totalm_amount = $request['total'];
        }  
        $stu->totalexp = $request['total']+$request['amount'];
        $stu->payment_mode = $request['payment'];
        $stu->paid_through = $request['paid'];
        $stu->description = $request['description'];
        $stu->save();
        if($stu){   
            $stu1 = Transaction::where('user_type', $id)->first();
        $stu1->date = $request['date'];
        $stu1->payment_id = $request['currency'];
        $stu1->user_type = $id;
        $stu1->created_by = \Auth::user()->creatorId();
        $stu1->account = '5';
        $category_name = ProductServiceCategory::all();
        foreach ($category_name as $row) {
            if($request['category'] == $row->id){
                $stu1->category = $row['name'];
            }
        } 
            $stu1->description = $request['description'];
            $stu1->amount = $request['total']+$request['amount'];
            if($request['payment']==1){
                $stu1->type = 'Cash';
            }elseif($request['payment']==2){
                $stu1->type = 'Credit Card';
            }elseif($request['payment']==3){
                $stu1->type = 'Debit Card';
            }
            $stu1->save();
         return redirect('expense');
        }
    }
        public function destroy(Request $request)
    {
             $id=$request['ide12'];
             $stu1 = Transaction::where('user_type', $id)->delete();
             $stu=add__Expense::find($id);
             $stu->delete();

        return redirect()->back()->with('success', 'Bill deleted successfully.');
    }
        
}

