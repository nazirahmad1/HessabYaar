<?php



use App\Http\Controllers\Controller;
use App\Http\Controllers\MyTransactionController;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerModel;
use App\Models\ExchangeModel;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $transaction = Transaction::where('status',1)->where('transaction_type','exchange')
            ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction','user'])
            ->orderBy('id','desc')->paginate($limit);

            if ($transaction->isEmpty()) {
                return response()->json([]);
            }
            $total_pages = $transaction->lastPage();

            return response()->json(['transactions'=>$transaction,'total_pages'=>$transaction]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBuyTransaction(Request $request){
        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $transaction = Transaction::where('status', 1)->where('transaction_type','exchange')->where('rasid_bord','rasid')
            ->whereNotNull('or_tra')  // Add this condition to filter by non-null or_tra
            ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction','user'])
            ->orderBy('id','desc')->paginate($limit);
            // for getting transaction in select input
            $currency = Currency::where('status',1)->get();
            $customer = CustomerModel::where('status',1)->Where('role','customer')->get();
            
            if ($transaction->isEmpty() && $customer->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
            $total_pages = $transaction->lastPage();
            return response()->json(['transactions'=>$transaction,'total_pages'=>$transaction,'customers'=>$customer,'currencies' => $currency]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getSaleTransaction(Request $request){
        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $transaction = Transaction::where('status', 1)->where('transaction_type','exchange')->where('rasid_bord','bord')
            ->whereNotNull('or_tra')  // Add this condition to filter by non-null or_tra
            ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction','user'])
            ->orderBy('id','desc')->paginate($limit);
            $currency = Currency::where('status',1)->get();
            $customer = CustomerModel::where('status',1)->Where('role','customer')->get();
            if ($transaction->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
            $total_pages = $transaction->lastPage();
            return response()->json(['transactions'=>$transaction,'customers'=>$customer,'currencies' => $currency,'total_pages'=>$total_pages]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getTransfer(Request $request)
    {
        try {
            $limit = $request->has('limit') ? $request->limit : 10;

            $transaction = Transaction::where('transaction_type','transfer')
                ->orWhere('transaction_type','commission')->where('status', 1)
            ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction','user'])
            ->orderBy('id','desc')->paginate($limit);
            $currency = Currency::where('status', '=', '1')->get();
            if ($transaction->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
            $total_pages = $transaction->lastPage();

            return response()->json(['transactions'=>$transaction,'currencies' => $currency,'total_pages'=>$total_pages]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // for generating hawal id 
    public static function new_check_number()
    {
        $last = Transaction::orderBy('id','desc')->pluck('check_number')->first();
        
        $new_check_number='';
        if($last){
            $number = explode("-",$last);
            $new_number  = $number[1]+1;
            $new_check_number = 'Check-no-'.$new_number;
        }else{
            $new_check_number = 'Check-no-1';
        }

        return $new_check_number;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $check_number = $this->new_check_number();
        $validator =Validator::make($request->all(),[
            'transaction_type'=>'exchange',
            'rasid_amount'=>'required',
            'currency'=>'required',
            'amount_equal'=>'nullable',
            'currency_equal'=>'nullable',
            'currency_rate'=>'required',
            // 'ref_id'=>"required|max:20",
            'ref_tra'=>'nullable',
            'rasid_bank_acount_id'=>'required',
            'bord_bank_acount_id'=>'required',
            'desc'=>'nullable',
            'status'=>'',

        ]);
        
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else{
        
            DB::beginTransaction();
            try{
                ////transaction chek number generate
                $check_number = MyTransactionController::new_check_number();

                $transaction_values = [
                    'rasid_bord'=> 'rasid',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->rasid_amount,
                    'currency'=>$request->currency,
                    'finance_acount_id'=>25,
                    'bank_acount_id'=>$request->rasid_bank_acount_id,
                    'amount_equal'=>$request->amount,
                    'currency_equal'=>$request->currency,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number,
                    
                ];
             
                $transaction_id = Transaction::insertGetId($transaction_values);
                $check_number2 = MyTransactionController::new_check_number();
                $transaction_values2 = [
                    'rasid_bord'=> 'bord',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->amount_equal,
                    'currency'=>$request->currency_equal,
                    'finance_acount_id'=>25,
                    'bank_acount_id'=>$request->bord_bank_acount_id,
                    'amount_equal'=>$request->amount_equal,
                    'currency_equal'=>$request->currency_equal,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number2,
                    
                ];
                $transaction_id2 = Transaction::insertGetId($transaction_values2);

                if($transaction_id && $transaction_id2 ){

                    $update_values1 = [
                        'ref_tra'=>$transaction_id2,
                    ];
                    $update_values2 = [
                        'ref_tra'=>$transaction_id,
                    ];
                    Transaction::where('id',$transaction_id)->update($update_values1);
                    Transaction::where('id',$transaction_id2)->update($update_values2);

                    $update_values = ['transaction_id'=>$transaction_id,];
                    $update_values2 = ['transaction_id2'=>$transaction_id2,];
                 
                    $output_data = Transaction::where('id',$transaction_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                    $output_data2 = Transaction::where('id',$transaction_id2)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();

                    DB::commit();
                    return  response()->json([
                        'status'=>true,
                        'new_data1'=>$output_data,
                        'new_data2'=>$output_data2,
                        'message'=>'عملیات انجام شد',
                    ]);

                }else{
                    DB::rollback();
                    return  response()->json([
                        'status'=>false,
                        'message'=>'عملیات انجام نشد',
                    ]);
                }

            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }

        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $transaction = Transaction::where('status', 1)->where('id',$id)->where('rasid_bord','rasid')->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->get();;

            if ($transaction->isEmpty()) {
                return response()->json(['error' => 'Transaction not found'], 404);
            }
            return response()->json($transaction);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function buyStoreExchange(Request $request)
    { 
        if($request->rasid_bank_acount_id != $request->bord_bank_acount_id){
        $check_number = $this->new_check_number();
        $validator =Validator::make($request->all(),[
            'transaction_type'=>'exchange',
            'bord_amount'=>'required',
            'bord_currency'=>'required',
            'amount_equal'=>'nullable',
            'currency_equal'=>'nullable',
            'currency_rate'=>'required',
            'ref_tra'=>'nullable',
            'bord_bank_acount_id'=>'required',
            'rasid_bank_acount_id'=>'required',
            'desc'=>'nullable',
            'status'=>'',
            'ref_id'=>'required'
        ]);
        
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else{
        
            DB::beginTransaction();
            try{
                ////transaction chek number generate
                $check_number = MyTransactionController::new_check_number();

                $transaction_values = [
                    'rasid_bord'=> 'rasid',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->rasid_amount,
                    'currency'=>$request->rasid_currency,
                    'finance_acount_id'=>25,
                    'or_tra'=>1,
                    'bank_acount_id'=>$request->rasid_bank_acount_id,
                    'amount_equal'=>$request->bord_amount,
                    'currency_equal'=>$request->bord_currency,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number,
                    "ref_id"=> $request->ref_id,
                ];
             
                $transaction_id = Transaction::insertGetId($transaction_values);
                $check_number2 = MyTransactionController::new_check_number();
                $transaction_values2 = [
                    'rasid_bord'=> 'bord',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->bord_amount,
                    'currency'=>$request->bord_currency,
                    'finance_acount_id'=>25,
                    'bank_acount_id'=>$request->bord_bank_acount_id,
                    'amount_equal'=>$request->rasid_amount,
                    'currency_equal'=>$request->rasid_currency,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number2,
                    "ref_id"=> $request->ref_id,
                ];
                
            
                $transaction_id2 = Transaction::insertGetId($transaction_values2);

                if($transaction_id && $transaction_id2 ){

                    $update_values1 = [
                        'ref_tra'=>$transaction_id2,
                    ];
                    $update_values2 = [
                        'ref_tra'=>$transaction_id,
                    ];
                    Transaction::where('id',$transaction_id)->update($update_values1);
                    Transaction::where('id',$transaction_id2)->update($update_values2);

                    $update_values = ['transaction_id'=>$transaction_id,];
                    $update_values2 = ['transaction_id2'=>$transaction_id2,];
                    $exchange = ExchangeModel::create([
                        'cu_id'=>$request->ref_id,
                        'type'=>'buy',
                        'amount'=>$request->rasid_amount,
                        'rate'=>$request->currency_rate,
                        'amount_equal'=>$request->bord_amount,
                        'tra_rasid'=>$transaction_id,
                        'tra_bord'=>$transaction_id2,
                    ]); 

                    $output_data = Transaction::where('id',$transaction_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                    $output_data2 = Transaction::where('id',$transaction_id2)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();

                    DB::commit();
                    return  response()->json([
                        'status'=>true,
                        'new_data1'=>$output_data,
                        'new_data2'=>$output_data2,
                        'message'=>'عملیات انجام شد',
                    ]);

                }else{
                    DB::rollback();
                    return  response()->json([
                        'status'=>false,
                        'message'=>'عملیات انجام نشد',
                    ]);
                }

            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }

        }
       }else{
        return response()->json([
            'status'=>false,
            'message'=>'واحدات هم نوع خرید و فروش نمیشوند!'
        ]);
       }
    }
    public function getExchangeforEdit(Request $request)
    {
        try {
            $tr_type = $request->rasid_bord;
            $id = $request->id;
            
            if ($tr_type === 'rasid') {
                $rasid_transaction = Transaction::where('status', 1)
                    ->where('id', $id)
                    ->where('transaction_type', 'exchange')
                    ->where('rasid_bord', 'rasid')
                    ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])
                    ->firstOrFail();
                
                $bord_transaction = Transaction::where('status', 1)
                    ->where('id', $rasid_transaction->ref_tra)
                    ->where('transaction_type', 'exchange')
                    ->where('rasid_bord', 'bord')
                    ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])
                    ->firstOrFail();
                
                return response()->json(['bord' => $bord_transaction, 'rasid' => $rasid_transaction]);
            } elseif ($tr_type === 'bord') {
                $bord_transaction = Transaction::where('status', 1)
                    ->where('id', $id)
                    ->where('transaction_type', 'exchange')
                    ->where('rasid_bord', 'bord')
                    ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])
                    ->firstOrFail();
                
                $rasid_transaction = Transaction::where('status', 1)
                    ->where('id', $bord_transaction->ref_tra)
                    ->where('transaction_type', 'exchange')
                    ->where('rasid_bord', 'rasid')
                    ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])
                    ->firstOrFail();
                
                return response()->json(['bord' => $bord_transaction, 'rasid' => $rasid_transaction]);
            } else {
                return response()->json(['message' => 'Invalid transaction type']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    
    

  
    public function updateBuyExchangeTransaction(Request $request)
    { 
        $validator =Validator::make($request->all(),[
            'rasid_id'=>'required',
            'rasid_amount'=>'required',
            'rasid_currency'=>'required',
            'rasid_bank_acount_id'=>'required',

            'bord_id'=>'required',
            'bord_amount'=>'required',
            'bord_currency'=>'required',
            'bord_bank_acount_id'=>'required',
           
            'desc'=>'nullable',
            'date'=>'required',
            'currency_rate'=>'required',
        ]);
        
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else {
            
            $tr_bordv = [
                'amount'=>$request->rasid_amount,
                'currency'=>$request->rasid_currency,
                'bank_acount_id'=>$request->rasid_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date,
                'user_id'=>Auth::user()->id,
                'currency_rate'=>$request->currency_rate,
                "ref_id" => $request->ref_id,
            ];
            
            $tr_rasidv = [
                'amount'=>$request->bord_amount,
                'currency'=>$request->bord_currency,
                'bank_acount_id'=>$request->bord_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date,
                'user_id'=>Auth::user()->id,
                'currency_rate'=>$request->currency_rate,
                "ref_id" => $request->ref_id,
            ];

            // dd("$tr_rasidv",$tr_rasidv);
            DB::beginTransaction();
            try{
                
               $tr_rasid= Transaction::where('id',$request->rasid_id)->update($tr_rasidv);
               $tr_bord= Transaction::where('id',$request->bord_id)->update($tr_bordv);


               if($tr_rasid && $tr_bord){

                $output_data = Transaction::where('id', $request->rasid_id)->with(['financeAccount', 'customer_exchange', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])->first();                $output_data2 = Transaction::where('id',$request->bord_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                $output_data2 = Transaction::where('id', $request->bord_id)->with(['financeAccount', 'customer_exchange', 'tr_currency', 'eq_currency', 'bank_account', 'referencedTransaction', 'user'])->first();
                $exchange = ExchangeModel::where('status', 1)->where('tra_rasid', $request->rasid_id)->where('tra_bord', $request->bord_id)->update([
                    'cu_id' => $request->ref_id,
                    'amount' => $request->rasid_amount,
                    'rate' => $request->currency_rate,
                    'amount_equal' => $request->bord_amount,
                ]);
                DB::commit();
                return  response()->json([
                    'status'=>true,
                    'rasid'=>$output_data,
                    'bord'=>$output_data2,
                    'message'=>'عملیات انجام شد',
                ]);

               }else{
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>'عملیات انجام نشد',
                ]);
            }
            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }
            
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function deleteBuyExchange(Request $request)
    {
                    $id=$request->id;
                    $exchange_tr1= Transaction::where('status', '=', '1')->where('transaction_type','exchange')->where('id',$request->id)->first();
                    $exchange_tr2= Transaction::where('status', '=', '1')->where('transaction_type','exchange')->where('ref_tra',$request->id)->first();
                   
                    $exchange_tr1->update(['status'=>0]);
                    $exchange_tr2->update(['status'=>0]);
                    $exchange_tr1->save();
                    $exchange_tr2->save();
                   $output_data = Transaction::where('id',$request->id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->get();
                   $output_data2 = Transaction::where('id',$request->ref_tra)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->get();
                    

                return  response()->json([
                            'status'=>true,
                            'rasid'=>$output_data,
                            'bord'=>$output_data2,
                            'message'=>'عملیات انجام شد',
                        ],204);

            
        
    }

    public function getBuySearchTransaction(Request $request) {
        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $searchTerm = $request->input('query');
    
            $transaction = Transaction::query()
                ->where('status', 1)
                ->where('rasid_bord', 'rasid') // Assuming 'rasid_bord' is correct
                ->where(function ($query) {
                    $query->where('transaction_type', 'exchange');
                });
    
            if ($searchTerm) {
                $transaction->where(function ($query) use ($searchTerm) {
                    $query->whereHas('customer', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    })->orWhereHas('financeAccount', function ($query) use ($searchTerm) {
                        $query->where('account_name', 'like', '%' . $searchTerm . '%');
                    })->orWhereHas('tr_currency', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    })->orWhere('id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('rasid_bord', 'like', '%' . $searchTerm . '%')
                        ->orWhere('transaction_type', 'like', '%' . $searchTerm . '%')
                        ->orWhere('check_number', 'like', '%' . $searchTerm . '%')
                        ->orWhere('amount', 'like', '%' . $searchTerm . '%')
                        ->orWhere('amount_equal', 'like', '%' . $searchTerm . '%')
                        ->orWhere('currency', 'like', '%' . $searchTerm . '%')
                        ->orWhere('currency_equal', 'like', '%' . $searchTerm . '%')
                        ->orWhere('currency_rate', 'like', '%' . $searchTerm . '%')
                        // ->orWhere('finance_account_id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('desc', 'like', '%' . $searchTerm . '%');
                });
            }
    
            $transactions = $transaction->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account'])
                ->orderBy('id', 'desc')
                ->paginate($limit);
    
            $currency = Currency::where('status', 1)->get();
            $customer = CustomerModel::where('status',1)->Where('role','customer')->get();
            if ($transactions->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
    
            $total_pages = $transactions->lastPage();
            return response()->json(['transactions'=>$transactions,'total_pages'=>$total_pages,'customers'=>$customer,'currencies' => $currency]);
    
            // return response()->json(['transactions' => $transactions, 'currencies' => $currency, 'total_pages' => $total_pages]);
    
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    
    


    public function getSaleSearchTransaction(Request $request) {
        
        try {
            $searchTerm = $request->input('query');
    
            $transaction = Transaction::query()->where('status', '=', '1')->where('rasid_bord','bord')->where
            (function ($query) {
                $query->where('transaction_type', 'exchange');
            });
    
            if ($searchTerm) {
                $transaction->where(function ($query) use ($searchTerm) {
                    $query->whereHas('customer', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('financeAccount', function ($query) use ($searchTerm) {
                        $query->where('account_name', 'like', '%' . $searchTerm . '%');
                    
                    })
                    ->orWhereHas('tr_currency','eq_currency', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhere('id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('rasid_bord', 'like', '%' . $searchTerm . '%')
                    ->orWhere('transaction_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('check_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('amount_equal', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency_equal', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency_rate', 'like', '%' . $searchTerm . '%')
                    ->orWhere('finance_acount_id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('desc', 'like', '%' . $searchTerm . '%');
                });
            }
    
            $transactions = $transaction->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                ->orderBy('id', 'desc')
                ->get();
    
            if ($transactions->isEmpty()) {
                return response()->json([]);
            }
    
            return response()->json($transactions);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function saleStoreExchange(Request $request)
    { 

        if($request->rasid_bank_acount_id != $request->bord_bank_acount_id){
        $check_number = $this->new_check_number();
        $validator =Validator::make($request->all(),[
            'transaction_type'=>'exchange',
            'bord_amount'=>'required',
            'bord_currency'=>'required',
            'amount_equal'=>'nullable',
            'currency_equal'=>'nullable',
            'currency_rate'=>'required',
            'ref_tra'=>'nullable',
            'bord_bank_acount_id'=>'required',
            'rasid_bank_acount_id'=>'required',
            'desc'=>'nullable',
            'ref_id'=>'required'

        ]);
        
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else{
        
            DB::beginTransaction();
            try{
                ////transaction chek number generate
                $check_number = MyTransactionController::new_check_number();

                $transaction_values = [
                    'rasid_bord'=> 'bord',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->bord_amount,
                    'currency'=>$request->bord_currency,
                    'finance_acount_id'=>25,
                    'or_tra'=>1,
                    'bank_acount_id'=>$request->bord_bank_acount_id,
                    'amount_equal'=>$request->rasid_amount,
                    'currency_equal'=>$request->rasid_currency,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number,
                    "ref_id"=> $request->ref_id,
                    
                ];
             
                $transaction_id = Transaction::insertGetId($transaction_values);
                $check_number2 = MyTransactionController::new_check_number();
                $transaction_values2 = [
                    'rasid_bord'=> 'rasid',
                    'transaction_type'=>'exchange',
                    'amount'=>$request->rasid_amount,
                    'currency'=>$request->rasid_currency,
                    'finance_acount_id'=>25,
                    'bank_acount_id'=>$request->rasid_bank_acount_id,
                    'amount_equal'=>$request->bord_amount,
                    'currency_equal'=>$request->bord_currency,
                    'currency_rate'=>$request->currency_rate,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number2,
                    "ref_id"=> $request->ref_id,
                ];
                
                $transaction_id2 = Transaction::insertGetId($transaction_values2);

                if($transaction_id && $transaction_id2 ){

                    $update_values1 = [
                        'ref_tra'=>$transaction_id2,
                    ];
                    $update_values2 = [
                        'ref_tra'=>$transaction_id,
                    ];
                    Transaction::where('id',$transaction_id)->update($update_values1);
                    Transaction::where('id',$transaction_id2)->update($update_values2);

                    $update_values = ['transaction_id'=>$transaction_id,];
                    $update_values2 = ['transaction_id2'=>$transaction_id2,];
                 
                    $output_data = Transaction::where('id',$transaction_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user','referencedTransaction','user'])->first();
                    $output_data2 = Transaction::where('id',$transaction_id2)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                    $exchange = ExchangeModel::create([
                        'cu_id'=>$request->ref_id,
                        'type'=>'sale',
                        'amount'=>$request->bord_amount,
                        'rate'=>$request->currency_rate,
                        'amount_equal'=>$request->rasid_amount,
                        'tra_rasid'=>$transaction_id,
                        'tra_bord'=>$transaction_id2,
                    ]); 
                    DB::commit();
                    return  response()->json([
                        'status'=>true,
                        'new_data1'=>$output_data,
                        'new_data2'=>$output_data2,
                        'message'=>'عملیات انجام شد',
                    ]);

                }else{
                    DB::rollback();
                    return  response()->json([
                        'status'=>false,
                        'message'=>'عملیات انجام نشد',
                    ]);
                }

            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }

        }
    }else{
        return response()->json([
            'status'=>false,
            'message'=>'واحدات هم نوع خرید و فروش نمیشوند!'
        ]);
    }
    }

    public function getExchangeSaleforEdit(Request $request)
    {
        $tr_type=$request->rasid_bord;
        $id=$request->id;
            try {
                if($tr_type ==='rasid'){
                    $rasid_transaction = Transaction::where('status', '=', '1')->where('id',$id)->where('transaction_type','exchange')
                    ->where('rasid_bord','rasid')
                    ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction'])->first();
           
                    $bord_transaction = Transaction::where('status', '=', '1')->where('id',$rasid_transaction->ref_tra)->where('transaction_type','exchange')
                    ->where('rasid_bord','bord')
                    ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction'])->first();
           

                    return response()->json(['bord'=>$bord_transaction,'rasid'=>$rasid_transaction]);
               }
               else if($tr_type ==='bord'){
                   $bord_transaction = Transaction::where('status', '=', '1')->where('id',$id)->where('transaction_type','exchange')
                   ->where('rasid_bord','bord')
                   ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction'])->first();
                   $rasid_transaction = Transaction::where('status', '=', '1')->where('id',$bord_transaction->ref_tra)->where('transaction_type','exchange')
                   ->where('rasid_bord','rasid')
                   ->with(['financeAccount','customer','tr_currency','eq_currency','bank_account','referencedTransaction'])->first();
                   return response()->json(['bord'=>$bord_transaction,'rasid'=>$rasid_transaction]);
               }
            } catch (Throwable $e) {
                return response()->json(['message'=>$e->getMessage()]);
            }
         
    }


    public function updateSaleExchange(Request $request){
        $validator =Validator::make($request->all(),[
            'rasid_id'=>'required',
            'rasid_amount'=>'required',
            'rasid_currency'=>'required',
            'rasid_bank_acount_id'=>'required',

            'bord_id'=>'required',
            'bord_amount'=>'required',
            'bord_currency'=>'required',
            'bord_bank_acount_id'=>'required',
           
            'desc'=>'nullable',
            'date'=>'required',
            'currency_rate'=>'required',
        ]);
        
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else {
            
            $tr_bordv = [
                'amount'=>$request->bord_amount,
                'currency'=>$request->bord_currency,
                'bank_acount_id'=>$request->bord_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date,
                'user_id'=>Auth::user()->id,
                'currency_rate'=>$request->currency_rate,
            ];
            
            $tr_rasidv = [
                'amount'=>$request->rasid_amount,
                'currency'=>$request->rasid_currency,
                'bank_acount_id'=>$request->rasid_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date,
                'user_id'=>Auth::user()->id,
                'currency_rate'=>$request->currency_rate,
            ];

            // dd("$tr_rasidv",$tr_rasidv);
            DB::beginTransaction();
            try{
                
               $tr_rasid= Transaction::where('id',$request->rasid_id)->update($tr_rasidv);
               $tr_bord= Transaction::where('id',$request->bord_id)->update($tr_bordv);


               if($tr_rasid && $tr_bord){

                $output_data = Transaction::where('id',$request->rasid_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                $output_data2 = Transaction::where('id',$request->bord_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                DB::commit();
                return  response()->json([
                    'status'=>true,
                    'rasid'=>$output_data,
                    'bord'=>$output_data2,
                    'message'=>'عملیات انجام شد',
                ]);

               }else{
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>'عملیات انجام نشد',
                ]);
            }
            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }
            
        }
    }
    public function deleteSaleExchange(Request $request)
    {
                    $id=$request->id;
                    $exchange_tr1= Transaction::where('status',1)->where('transaction_type','exchange')->where('id',$request->id)->first();
                    $exchange_tr2= Transaction::where('status',1)->where('transaction_type','exchange')->where('ref_tra',$request->id)->first();
                   
                    $exchange_tr1->update(['status'=>0]);
                    $exchange_tr2->update(['status'=>0]);
                    $exchange_tr1->save();
                    $exchange_tr2->save();
                   $output_data = Transaction::where('id',$request->id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->get();
                   $output_data2 = Transaction::where('id',$request->ref_tra)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->get();
                    

                return  response()->json([
                            'status'=>true,
                            'rasid'=>$output_data,
                            'bord'=>$output_data2,
                            'message'=>'عملیات انجام شد',
                        ],204);

            
        
    }



    public function storeTranferTransactions(Request $request){
        // if($request->source_bank_acount_id != $request->destination_bank_acount_id){
       
        $check_number = $this->new_check_number();
        $validator =Validator::make($request->all(),[
            'transfer_amount'=>'required',
            'currency'=>'required|exists:currency,id',
            'source_bank_acount_id'=>'required|exists:finance_account,id',
            'destination_bank_acount_id'=>'required|exists:finance_account,id',
            // commission
            'commission_bank_acount_id'=>'nullable|exists:finance_account,id',
            // 
            "commission"=>"nullable",
            "commission_amount"=>"nullable",
            "commission_currency"=>'nullable',
            "date"=>'required',
            'desc'=>'nullable'
        ]);
        // dd($request->all());
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else{
        
            DB::beginTransaction();
            try{
                ////transaction chek number generate
                $check_number = MyTransactionController::new_check_number();

                $source_transaction_values = [
                    'rasid_bord'=> 'bord',
                    'transaction_type'=>'transfer',
                    'amount'=>$request->transfer_amount,
                    'currency'=>$request->currency,
                    'finance_acount_id'=>26,
                    'or_tra'=>1,
                    'bank_acount_id'=>$request->source_bank_acount_id,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number,
                    
                ];
             
                $source_transaction_id= Transaction::insertGetId($source_transaction_values);

                $check_number2 = MyTransactionController::new_check_number();

                $destination_transaction_values = [
                    'rasid_bord'=> 'rasid',
                    'transaction_type'=>'transfer',
                    'amount'=>$request->transfer_amount,
                    'currency'=>$request->currency,
                    'finance_acount_id'=>26,
                    'bank_acount_id'=>$request->destination_bank_acount_id,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                    'user_id'=>Auth::user()->id,
                    'check_number'=>$check_number2,
                    
                ];

                $destination_tansaction_id = Transaction::insertGetId($destination_transaction_values);

                $output_data3=[];
                $commission_transaction=0;
                if($request->commission==="darad"){
                    $check_number3 = MyTransactionController::new_check_number();
                    $commission_transaction_values = [
                        'rasid_bord'=> 'bord',
                        'transaction_type'=>'commission',
                        'amount'=>$request->commission_amount,
                        'currency'=>$request->commission_currency,
                        'finance_acount_id'=>26,
                        'bank_acount_id'=>$request->commission_bank_acount_id,
                        'desc'=>$request->desc,
                        'date'=>$request->date,
                        'user_id'=>Auth::user()->id,
                        'check_number'=>$check_number3,
                        
                    ];
                    $commission_transaction = Transaction::insertGetId($commission_transaction_values);
                    $output_data3 = Transaction::where('id',$commission_transaction)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();

                }
               
                if($source_transaction_id && $destination_tansaction_id ){

                    $update_values1 = [
                        'ref_tra'=>$destination_tansaction_id,
                    ];
                    $update_values2 = [
                        'ref_tra'=>$source_transaction_id,
                    ];
                    

                    if($commission_transaction>0){
                        // for comision 
                        Transaction::where('id',$commission_transaction)->update($update_values1);
                    }
                    Transaction::where('id',$source_transaction_id)->update($update_values1);
                    Transaction::where('id',$destination_tansaction_id)->update($update_values2);

                 
                 
                    $output_data = Transaction::where('id',$source_transaction_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                    $output_data2 = Transaction::where('id',$destination_tansaction_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();

                      
                  
                        DB::commit();
                        return  response()->json([
                            'status'=>true,
                            'new_data1'=>$output_data,
                            'new_data2'=>$output_data2,
                            'new_data3'=>$output_data3,
                            'message'=>'عملیات انجام شد',
                        ]);
                    

                }else{
                    DB::rollback();
                    return  response()->json([
                        'status'=>false,
                        'message'=>'عملیات انجام نشد',
                    ]);
                }

            }catch(Throwable $e){
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }

        }
    // }
        // else{
        //     return response()->json([
        //         'status'=>false,
        //         'message'=>'واحدات هم نوع انتقال داده نمیشوند!'
        //     ]);
        //    }
    }


    public function getTransferforEdit(Request $request)
    {
        $tr_type = $request->rasid_bord;
        $id = $request->id;  
        try {
            if ($tr_type === 'rasid') {
                $rasid_transfer = Transaction::where('status', '=', '1')
                    ->where('id', $id)
                    ->where(function ($query) {
                        $query->where('transaction_type', 'transfer')
                              ->orWhere('transaction_type', 'commission');
                    })
                    ->where('rasid_bord', 'rasid')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                $bord_transfer = Transaction::where('status', '=', '1')
                    ->where('id', $rasid_transfer->ref_tra)
                    ->where('transaction_type', 'transfer')
                    ->where('rasid_bord', 'bord')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                $commission_transafer = Transaction::where('status', '=', '1')
                    ->where('id', $rasid_transfer->ref_tra)
                    ->where(function ($query) {
                        $query->where('transaction_type', 'commission')
                              ->orWhere('transaction_type', 'commission');
                    })
                    ->where('rasid_bord', 'bord')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                return response()->json(['bord' => $bord_transfer, 'rasid' => $rasid_transfer, 'commissiom' => $commission_transafer]);
            } else if ($tr_type === 'bord') {
                $bord_transaction = Transaction::where('status', '=', '1')
                    ->where('id', $id)
                    ->where(function ($query) {
                        $query->where('transaction_type', 'transfer')
                              ->orWhere('transaction_type', 'commission');
                    })
                    ->where('rasid_bord', 'bord')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                $rasid_transfer = Transaction::where('status', '=', '1')
                    ->where('id', $bord_transaction->ref_tra)
                    ->where(function ($query) {
                        $query->where('transaction_type', 'transfer')
                              ->orWhere('transaction_type', 'commission');
                    })
                    ->where('rasid_bord', 'rasid')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                $commission_transfer = Transaction::where('status', '=', '1')
                    ->where('id', $bord_transaction->ref_tra)
                    ->where(function ($query) {
                        $query->where('transaction_type', 'transfer')
                              ->orWhere('transaction_type', 'commission');
                    })
                    ->where('rasid_bord', 'rasid')
                    ->with(['financeAccount', 'customer', 'tr_currency','eq_currency', 'bank_account'])
                    ->first();
    
                return response()->json(['bord' => $bord_transaction, 'rasid' => $rasid_transfer, 'commission' => $commission_transfer]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    



    public function updateTransferTransaction(Request $request){
        $validator =Validator::make($request->all(),[
            'transfer_amount'=>'required',
            'currency'=>'required|exists:currency,id',
            'source_bank_acount_id'=>'required|exists:finance_account,id',
            'destination_bank_acount_id'=>'required|exists:finance_account,id',
            // commission
            'commission_bank_acount_id'=>'nullable|exists:finance_account,id',
            // 
            "commission"=>"nullable",
            "commission_amount"=>"nullable",
            "commission_currency"=>'nullable',
            "date"=>'required',
            'desc'=>'nullable'
        ]);
        // dd($request->all());
        if(!$validator->passes()){
            return response()->json([
                'status'=>false,
                'error'=>$validator->errors()->toArray(),
            ]);
        }else{
        
            DB::beginTransaction();
          
            try {
               
            $source_transaction_values = [
                'rasid_bord'=> 'bord',
                'transaction_type'=>'transfer',
                'amount'=>$request->transfer_amount,
                'currency'=>$request->currency,
                'finance_acount_id'=>26,
                'bank_acount_id'=>$request->source_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date
            ];
         
            $destination_transaction_values = [
                'rasid_bord'=> 'rasid',
                'transaction_type'=>'transfer',
                'amount'=>$request->transfer_amount,
                'currency'=>$request->currency,
                'finance_acount_id'=>26,
                'bank_acount_id'=>$request->destination_bank_acount_id,
                'desc'=>$request->desc,
                'date'=>$request->date,  
            ];

            $output_data3=[];
            $commission_id=$request->commmission_id;
            if($request->commission==='darad'){
                $commission_transaction_values = [
                    'rasid_bord'=> 'bord',
                    'transaction_type'=>'commission',
                    'amount'=>$request->commission_amount,
                    'currency'=>$request->commission_currency,
                    'finance_acount_id'=>26,
                    'bank_acount_id'=>$request->commission_bank_acount_id,
                    'desc'=>$request->desc,
                    'date'=>$request->date,
                ];
                $tr_commission= Transaction::where('id',$commission_id)->update($commission_transaction_values);
                $output_data3 = Transaction::where('id',$commission_id)->
                with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                
            }
           
          
            $tr_rasid= Transaction::where('id',$request->rasid_id)->update($source_transaction_values);
            $tr_bord= Transaction::where('id',$request->bord_id)->update($destination_transaction_values);
          
        
           
            if($tr_rasid && $tr_bord){

                $output_data = Transaction::where('id',$request->rasid_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                $output_data2 = Transaction::where('id',$request->bord_id)->with(['financeAccount','customer_exchange','tr_currency','eq_currency','bank_account','referencedTransaction','user'])->first();
                DB::commit();
                return  response()->json([
                    'status'=>true,
                    'rasid'=>$output_data,
                    'bord'=>$output_data2,
                    'commission'=>$output_data3,
                    'message'=>'عملیات انجام شد',
                ]);
                }else{
                        DB::rollback();
                        return  response()->json([
                            'status'=>false,
                            'message'=>'عملیات انجام نشد',
                        ]);
                
                }
            } catch (Throwable $e) {
                DB::rollback();
                return  response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage(),
                ]);
            }
                    

            

        }
    
    }


    
    public function deleteTransfer(Request $request)
    {
                        try {
                            $rasid_id = $request->rasid_id;
                            $bord_id = $request->bord_id;
                            $commission_id = $request->commission_id;
        
                            $transfer_tr1= Transaction::where('status', '=', '1')->where('transaction_type','transfer')->where('id',$rasid_id)->first();
                            $transfer_tr2= Transaction::where('status', '=', '1')->where('transaction_type','transfer')->where('ref_tra',$bord_id)->first();
                            $transfer_tr3 = null;
                            if ($commission_id) {
                                $transfer_tr3 = Transaction::where('status', '=', '1')->where('transaction_type', 'commission')->where('id', $commission_id)->first();
                            }
        
                            $transfer_tr1->update(['status'=>0]);
                            $transfer_tr2->update(['status'=>0]);
                            $transfer_tr3->update(['status'=>0]);
                            $transfer_tr1->save();
                            $transfer_tr2->save();
                            $transfer_tr3->save();
                    
                            DB::commit();
                            return response()->json([
                                            'status' => true,
                                            'message' => 'عملیات انجام شد',
                                        ], 204);
                        } catch (Throwable $e) {
                            DB::rollback();
                            return response()->json([
                                'status' => false,
                                'message' => $e->getMessage(),
                            ]);
                        }

            

                        

        
    }


    public function searchTransfers(Request $request){

        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $searchTerm = $request->input('query');
    
            $transfer = Transaction::query()->where('status', 1)->where(function ($query) {
                $query->where('transaction_type', 'transfer')
                      ->orWhere('transaction_type', 'commission');
            });
    
            if ($searchTerm) {
                $transfer->where(function ($query) use ($searchTerm) {
                    $query->whereHas('financeAccount', function ($query) use ($searchTerm) {
                        $query->where('account_name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('tr_currency', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhere('id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('rasid_bord', 'like', '%' . $searchTerm . '%')
                    ->orWhere('transaction_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('check_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('amount_equal', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency_equal', 'like', '%' . $searchTerm . '%')
                    ->orWhere('currency_rate', 'like', '%' . $searchTerm . '%')
                    // ->orWhere('finance_account_id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('desc', 'like', '%' . $searchTerm . '%');
                });
            }
    
            $transfers = $transfer->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account'])
                ->orderBy('id', 'desc')->paginate($limit);
               
            $currency = Currency::where('status', 1)->get();
          
            $total_pages = $transfers->lastPage();
            if ($transfers->isEmpty() && $currency->isEmpty()) {
                return response()->json([]);
            }
    
            return response()->json(["transfers"=>$transfers,'currencies' => $currency,'total_pages'=>$total_pages]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    
    }
    


    public function getExchanges(Request $request)
    {
        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $exchanges = ExchangeModel::where('status', '1')->orderBy('id','desc')->paginate($limit);

            if ($exchanges->isEmpty()) {
                return response()->json([]);
            }
            $total_pages = $exchanges->lastPage();

            return response()->json(['exchanges'=>$exchanges,'total_pages'=>$total_pages]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
