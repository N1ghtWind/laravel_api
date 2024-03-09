<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public static $types = ['I', 'B', 'S'];

    protected $fillable = [
        'name',
        'type',
        'email',
        'address',
        'city',
        'phone',
        'country',
        'zip',
    ];

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

}
