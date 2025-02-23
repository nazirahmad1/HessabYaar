<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCurrencyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CurrencyController extends Controller
{


    public function index(Request $request)
    {
        try {
            // Paginate currency
            $query = Currency::query(); // Default 10 per page


            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('sign', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%");
            }


            $currencies = $query->orderBy('id', 'desc')
            ->paginate(config('pagination.per_page', 10));
                
            // return response()->json($currencies);
            // Check if there are no currn$currency
            if ($currencies->isEmpty()) {
                throw new \Exception("واحد پولی  وجود ندارد!");
            }
    
            // Return view with currn$currency
            return view('currency.index', ['currencies' => $currencies]);
    
        } catch (\Throwable $e) {
            Log::error('Error fetching currency: ', ['exception' => $e->getMessage()]);
            // Return view with error message
            return view('currency.index', ['error' => $e->getMessage()]);
        }
    }
    
    
    
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            try {
                // Paginate customers
                $currencies = Currency::paginate(config('pagination.per_page', 10)); // Default 10 per page
        
                // Check if there are no customers
                if ($currencies->isEmpty()) {
                    throw new \Exception("واحد پولی وجود ندارد!");
                }
        
                // Return view with customers
                return view('currency.create', ['currencies' => $currencies]);
        
            } catch (\Throwable $e) {
                // Return view with error message
                return view('currency.create', ['error' => $e->getMessage()]);
            }
            
        }
    
    
       public function store(StoreCurrencyRequest $request)
    {
        try {
            DB::beginTransaction();
    
            // Create the customer
            $customer = Currency::create([
                'name' => $request->name,
                'sign' => $request->sign,
            
            ]);
    
            DB::commit();
    
            // Redirect with a success message
            return response()->json([
                'msg' => 'واحد پولی با موفقیت ذخیره شد',
                'type' => 'success',
            ]);
    
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error storing currency: ', ['exception' => $e->getMessage()]);
            return response()->json([
                'msg' => 'واحد پولی با موفقیت ذخیره نشد: ' . $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }
    
    

     public function updateCurrency(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required',
             'sign' => 'required',
             'id' => 'required',
 
         ],
         [
             'name.required' =>'نام ضروری است',
             'sign.required'=>'نشان واحد ضروری است',
 
         ]
     
     );
 
         if(!$validator->passes()){
             return response()->json([
                 'status'=>false,
                 'error'=>$validator->errors()->toArray(),
             ]);
         }
        
         $currency_value = [
             'name'=> $request->name,
             'sign'=> $request->sign,
         ];
         $currency_update = Currency::where('id',$request->id)->update($currency_value);
         if($currency_update){
             $output_data = Currency::where('id',$request->id)->first();
             return  response()->json([
                 'status'=>true,
                 'new_data'=>$output_data,
                 'message'=>'اطلاعات موفقانه آپدیت شد.',
             ]);
 
         }else{
    
             return  response()->json([
                 'status'=>false,
                 'message'=>'عملیات انجام نشد',
             ]);
         }
     }
    public function destroy(Request $request,$id)
    {
        $currency = Currency::findOrFail($id);
        $currency->update(['status'=>0]);
        return response()->json(['message' => 'Currency deleted successfully', 'data' => $currency], 204);
    }


}
