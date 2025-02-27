<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FinanceAccountController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\RasidBordController;
use App\Http\Controllers\MyReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('index');


    Route::get('/customer', [Customer::class, 'index'])->name('customer.index'); // Assign 'customer.index'
    // Route::get('/customer/create', [Customer::class, 'create'])->name('customer.create'); // Assign 'customer.create'
    Route::post('/customer/store', [Customer::class, 'store'])->name('customer.store');
      // select transaction that the ref_id equal to customer id
      Route::get('/customer/profile/{id}',[MyTransactionController::class,'getCustomerInfo'])->name('customer.show');
      Route::delete('/customer/{id}', [Customer::class, 'destroy'])->name('customer.destroy');
      Route::get('/customers/search', [Customer::class, 'search'])->name('customer.search');

      // for exporting each
      Route::get('/customer/{id}/export',[Customer::class,'getCustomerInfo']);
    
    
    
    Route::get('currency', [CurrencyController::class, 'index'])->name('currency.index'); // Assign 'customer.create'
    // Route::get('currency/create', [CurrencyController::class, 'create'])->name('currency.create'); // Assign 'customer.create'
    Route::post('currency/store', [CurrencyController::class, 'store'])->name('currency.store');
    
    
    Route::get('finance_accounts', [FinanceAccountController::class, 'index'])->name('finance_accounts.index'); // Assign 'customer.create'
    Route::get('finance_accounts/create', [FinanceAccountController::class, 'create'])->name('finance_accounts.create'); // Assign 'customer.create'
    Route::post('/finance_accounts/store', [FinanceAccountController::class, 'store'])->name('finance_accounts.store');
    
    
    
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/finance_acc_with_currency/{id}', [ExpenseController::class, 'getFinanceAccountByCurrencyId'])->name('getFinanceAccountByCurrencyId'); // Assign 'customer.create'
    Route::get('/account', [ExpenseController::class, 'account.details'])->name('account.details'); // Assign 'customer.create'
    Route::get('expense/create', [ExpenseController::class, 'create'])->name('expense.create'); // Assign 'customer.create'
    Route::post('expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    
    
    
    Route::get('rasid_bord', [RasidBordController::class, 'index'])->name('rasid_bord.index'); // Assign 'customer.create'
    Route::get('rasid_bord/create', [RasidBordController::class, 'create'])->name('rasid_bord.create'); // Assign 'customer.create'
    Route::post('rasid_bord/store', [RasidBordController::class, 'store'])->name('rasid_bord.store');
    Route::post('rasid_bord/{id}', [RasidBordController::class, 'destroy'])->name('rasid_bord.destroy');
    Route::get('/getbanksbycurrencyid/{id}', [RasidBordController::class, 'getBanksByCurrency']);
    
    
    // banks report
    // Route::get('banksreport', [MyReportController::class, 'getBankBalance'])->name('reports.index');
    Route::get('banksreport', [MyReportController::class, 'getBankBalance'])->name('banksreport.index');
    // Route::get('/bankdetails/{id}',[MyReportController::class, 'getBanksTransaction'])->name('reports.bankdetails');
    Route::get('/bankdetails/{id}', [MyReportController::class, 'getBanksTransaction'])->name('reports.bankdetails');
    Route::get('/reportcharts', [MyReportController::class, 'showcharts'])->name('reports.reportcharts');

    Route::get('/alltransactions',[MyTransactionController::class,'getalltransactions'])->name('reports.alltransactions');
    Route::get('/rooznamcha',[MyTransactionController::class, 'getrooznamchah'])->name('reports.rooznamchah');


    //  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('destroy');
     Route::post('destroy', [AuthenticatedSessionController::class, 'destroy'])->name('destroy');
     Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    //  Route::get('/profile', function(){
    //     return "Hi there";
    //  });
});

require __DIR__.'/auth.php';
