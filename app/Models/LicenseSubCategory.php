<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseSubCategory extends Model
{
    use HasFactory;

    public function license_category(){
        return $this->belongsTo(LicenseCategory::class);
    }

    public function application_form(){
        return $this->hasMany(ApplicationForm::class);
    }
}
