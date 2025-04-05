<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Form extends Model
{
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
}
