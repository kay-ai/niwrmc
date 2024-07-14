<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;

    public function license_sub_category(){
        return $this->belongsTo(LicenseSubCategory::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
