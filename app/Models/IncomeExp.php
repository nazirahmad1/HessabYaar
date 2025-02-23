<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExp extends Model
{
    use HasFactory;

    protected $table = "income_expense";
    protected $fillable=[
        'id', 'type', 'amount', 'currency', 'amount_equal', 'currency_equal', 'date', 
        'transaction_id', 'finance_acount_id','bank_id', 'user_id', 'ref_type', 'state',
         'status', 'desc', 'created_at', 'updated_at'
    ];


    public function expense_currency()
    {
        return $this->belongsTo(Currency::class, 'currency','id');
    }
    public function inserted_by_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function expense_acount()
    {
        return $this->belongsTo(FinanceAccount::class,'finance_acount_id','id');
    }
    public function expense_bank()
    {
        return $this->belongsTo(FinanceAccount::class,'bank_id','id');
    }
    public function transaction()
    {
        return $this->belongsTo(IncomeExp::class,'bank_id','id');
    }
    public function customer()
    {
        return $this->belongsTo(CustomerModel::class,'ref_type');
    }

    public function customer_expense()
    {
        return $this->belongsTo(CustomerModel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
