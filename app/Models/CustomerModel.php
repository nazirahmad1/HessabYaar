<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'customer';
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'dob',
        'tazId',
        'passId',
        'cu_number',
        'phone',
        'image',
        'address',
        'type',
        'desc',
        'status',
        'user_id',
        'role',
        'created_at',
         'updated_at',

        ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function expenses()
    {
        return $this->hasMany(IncomeExp::class);
    }

    public function getCustomerBalance($customerId)
    {
        $transactions = Transaction::with('eq_currency')
            ->where('ref_id', $customerId)->where('transaction_type', 'rasid_bord')->orWhere('transaction_type', 'order')
            ->get();
        $balances = [];

        foreach ($transactions as $transaction) {
            $currencyName = $transaction->eq_currency->name; // Assuming 'name' is the field in the 'currency' table
            $amount = $transaction->amount_equal;
            $type = $transaction->rasid_bord;

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

            $balances[$currencyName]['balance'] = $balances[$currencyName]['rasid'] - $balances[$currencyName]['bord'];
        }

        return $balances;
    }
}
