<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','total_loan','repaid_amount'];

    public function transactions():HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
