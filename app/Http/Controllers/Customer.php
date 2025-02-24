<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
// use Yajra\DataTables\Facades\DataTables;
class Customer extends Controller
{


    public static function new_customer_number()
{
    // Replace 'User' with your actual model name
    $last = CustomerModel::orderBy('id', 'desc')->pluck('cu_number')->first();

    $new_customer_number = '';

    if ($last && preg_match('/^Cu-(\d+)$/', $last, $matches)) {
        // Extract the numeric part and increment
        $new_number = (int) $matches[1] + 1;
        $new_customer_number = 'Cu-' . $new_number;
    } else {
        // Default starting number
        $new_customer_number = 'Cu-1';
    }

    return $new_customer_number;
}



    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
{
    try {
        $query = CustomerModel::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }

        $customers = $query->orderBy('id', 'desc')
                           ->paginate(config('pagination.per_page', 10));

        if ($customers->isEmpty()) {
            throw new \Exception("مشتری وجود ندارد!");
        }

        return view('customer.index', ['customers' => $customers]);

    } catch (\Throwable $e) {
        Log::error('Error fetching customer: ', ['exception' => $e->getMessage()]);
        return view('customer.index', ['error' => $e->getMessage()]);
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('customer.create');
    }


    public function store(StoreCustomerRequest $request)
    {
        $photoPath = null;

        try {
            DB::beginTransaction();

            $customer_number = $this->new_customer_number(); // Ensure this method exists

            // Handle the photo upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $photoPath = $request->file('image')->store('uploads/customers', 'public');
            }

            // Create the customer
            $customer = CustomerModel::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email,
                'image' => $photoPath,
                'dob' => $request->dob,
                'tazId' => $request->tazId,
                'passId' => $request->passId,
                'address' => $request->address,
                'desc' => $request->desc,
                'type' => 'customer',
                'user_id' => Auth::user()->id,
                'role' => 'customer',
                'cu_number' => $customer_number,
            ]);

            DB::commit();

            return response()->json([
                'customer' => $customer,
                'msg' => 'مشتری با موفقیت ذخیره شد',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            if (!empty($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            Log::error('Customer store error', ['error' => $e->getMessage()]);

            return response()->json([
                'msg' => 'مشتری ذخیره نشد: ' . $e->getMessage(),
                'type' => 'error',
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

         $customer = CustomerModel::findOrFail($id);
         return view('customer.show', ['customer'=>$customer]);


        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    // public function getCustomerBalance($customerId) {
    //     $transactions = Transaction::with('eq_currency')
    //         ->where('ref_id', $customerId)->where('transaction_type','rasid_bord')->orWhere('transaction_type','order')
    //         ->get();
    //     $balances = [];

    //     foreach ($transactions as $transaction) {
    //         $currencyName = $transaction->eq_currency->name; // Assuming 'name' is the field in the 'currency' table
    //         // $amount = $transaction->amount;
    //         $amount = $transaction->amount_equal;
    //         $type = $transaction->rasid_bord; // 'credit' or 'debit'

    //         if (!isset($balances[$currencyName])) {
    //             $balances[$currencyName] = [
    //                 'rasid' => 0,
    //                 'bord' => 0,
    //                 'balance' => 0,
    //             ];
    //         }

    //         if ($type === 'rasid') {
    //             $balances[$currencyName]['rasid'] += $amount;
    //         } elseif ($type === 'bord') {
    //             $balances[$currencyName]['bord'] += $amount;
    //         }

    //         // Calculate balance
    //         $balances[$currencyName]['balance'] = $balances[$currencyName]['rasid'] - $balances[$currencyName]['bord'];
    //     }

    //     ///return response()->json($balances);
    //     return $balances;
    // }


    public function getCustomerBalance($customerId) {
        $transactions = Transaction::with('eq_currency')
            ->where('ref_id', $customerId)
            ->whereIn('transaction_type', ['rasid_bord', 'order'])
            ->get();
    
        $balances = [];
    
        foreach ($transactions as $transaction) {
            $currencyName = $transaction->eq_currency->name;
            $amount = $transaction->amount_equal;
            $type = $transaction->rasid_bord; // 'rasid' or 'bord'
    
            if (!isset($balances[$currencyName])) {
                $balances[$currencyName] = [
                    'rasid' => 0,
                    'bord' => 0,
                    'balance' => 0,
                ];
            }
    
            if ($type === 'rasid') {
                $balances[$currencyName]['rasid'] += $amount;
            } elseif ($type === 'bord') {
                $balances[$currencyName]['bord'] += $amount;
            }
    
            // Calculate balance
            $balances[$currencyName]['balance'] = $balances[$currencyName]['rasid'] - $balances[$currencyName]['bord'];
        }
    
        return response()->json($balances);
    }
    
    public function filterCustomerExport(Request $request) {

        try {
            $limit = $request->has('limit') ? $request->limit : 10;
            $id = $request->id;
            $typeOfExchange = $request->transaction_type;
            $rasid_bord = $request->rasid_bord;
            $currency = $request->currency;

            $customerExportFilter = Transaction::where('status', '1')->where('ref_id',$id)->orderBy('id', 'desc');

            if ($typeOfExchange!='all') {

                $customerExportFilter->where('transaction_type', $typeOfExchange);
            }
            if ($rasid_bord!='all') {

                $customerExportFilter->where('rasid_bord', $rasid_bord);
            }


            if ($currency) {
                $customerExportFilter->where('currency',  $currency);
            }

            $result = $customerExportFilter->with(['financeAccount','customer','tr_currency','bank_account'])->paginate($limit);

            $totalPages = $result->lastPage();
            return view('customer.export_transactions',['customerExportFilter' => $result,'total_pages' => $totalPages]);

        } catch (Throwable $e) {
            return view('customer.export_transactions',['error' => $e->getMessage()], 500);
        }
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerModel $customerModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerModel $customerModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */



    public function destroy($id)
{
    try {
        $customer = CustomerModel::findOrFail($id);
        $customer->update(['status'=>0]); // Delete the customer
        $customer->save();
        return response()->json(
            ['msg' => 'مشتری با موفقیت حذف شد', 'type' => 'success']
        );

    } catch (Throwable $e) {
        return response()->json(
            ['msg' => 'مشتری با موفقیت حذف نشد', 'type' => 'error']
        );
    }
}



}
