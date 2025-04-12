<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{

    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'service_submission_date',
        'customer_name',
        'address_line_1',
        'address_city',
        'address_country',
        'electronic_account_name',
        'type',
        'agreed_to_terms',
        'phone_number',
        'amount_previously_paid',
        'electronic_signature',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
