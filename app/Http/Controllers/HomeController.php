<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel;
use App\Models\FinanceAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Services\TransactionTypeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $transactionTypeService;

    public function __construct(TransactionTypeService $transactionTypeService)
    {
        $this->transactionTypeService = $transactionTypeService;
    }




// public function index()
// {
//     $date = Jalalian::now();
//     $today_date = $date->getYear() . "/" . $date->getMonth() . "/" . $date->getDay();

//     // آخرین روز سال جاری در تقویم شمسی (۲۹ یا ۳۰ اسفند)
//     $isLeapYear = $date->isLeapYear(); // بررسی سال کبیسه
//     $endOfYearDay = $isLeapYear ? 30 : 29; // اگر کبیسه باشد، ۳۰ اسفند در نظر بگیر

//     // تاریخ آخرین روز سال جاری
//     $endOfYear = Jalalian::fromFormat('Y/m/d', $date->getYear() . "/12/" . $endOfYearDay);

//     // محاسبه تعداد روزهای باقی‌مانده بدون تبدیل به میلادی
//     $remainingDays =ceil($date->getTimestamp() <= $endOfYear->getTimestamp() 
//     ? ($endOfYear->getTimestamp() - $date->getTimestamp()) / 86400 
//     : 0);

//     try {
//         $customers = CustomerModel::where('status', 1)->count();
//         return response()->json($customers);
//         $allTransactions = Transaction::where('status', 1)->count();
//         $lastTransactions = Transaction::where('status', 1)
//             ->orderBy('created_at', 'desc')
//             ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account'])
//             ->take(10)->get();

//         $todayTransactions = Transaction::where('status', 1)
//             ->whereDate('date', $today_date)
//             ->count();

//         $allbanks = FinanceAccount::where('status', '1')
//             ->where('account', 'bank')
//             ->with(['finance_currency'])
//             ->count();


//         return view('home', [
//             'customers' => $customers,
//             'allTransactions' => $allTransactions,
//             'todayTransactions' => $todayTransactions,
//             'lastTransactions' => $lastTransactions,
//             'today_date' => $today_date,
//             'allbanks' => $allbanks,
//             'remainingDays' => $remainingDays
//         ]);

//     } catch (\Exception $e) {
//         Log::error('Error fetching home: ', ['exception' => $e->getMessage()]);

//         return view('home', ['error' => "خطائی در شبکه رخ داده است", 'status' => false]);
//     }
// }

public function index()
{
    $date = Jalalian::now();
    $today_date = $date->getYear() . "/" . $date->getMonth() . "/" . $date->getDay();

    // آخرین روز سال جاری در تقویم شمسی (۲۹ یا ۳۰ اسفند)
    $isLeapYear = $date->isLeapYear();
    $endOfYearDay = $isLeapYear ? 30 : 29;

    // تاریخ آخرین روز سال جاری
    $endOfYear = new Jalalian($date->getYear(), 12, $endOfYearDay);

    // محاسبه تعداد روزهای باقی‌مانده
    $remainingDays = ceil($date->getTimestamp() <= $endOfYear->getTimestamp() 
        ? ($endOfYear->getTimestamp() - $date->getTimestamp()) / 86400 
        : 0);

    try {
        $customers = CustomerModel::where('status', 1)->count();
        $allTransactions = Transaction::where('status', 1)->count();
        $lastTransactions = Transaction::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->with(['financeAccount', 'customer', 'tr_currency', 'eq_currency', 'bank_account'])
            ->take(10)->get();

        $todayTransactions = Transaction::where('status', 1)
            ->whereDate('date', $today_date)
            ->count();

        $allbanks = FinanceAccount::where('status', '1')
            ->where('account', 'bank')
            ->with(['finance_currency'])
            ->count();

        return view('home', [
            'customers' => $customers,
            'allTransactions' => $allTransactions,
            'todayTransactions' => $todayTransactions,
            'lastTransactions' => $lastTransactions,
            'today_date' => $today_date,
            'allbanks' => $allbanks,
            'remainingDays' => $remainingDays
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error fetching home: ', ['exception' => $e->getMessage()]);
        return view('home', ['error' => "خطائی در شبکه رخ داده است", 'status' => false]);
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
