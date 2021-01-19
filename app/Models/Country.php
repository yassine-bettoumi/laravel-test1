<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public function companies(){
        return $this->hasMany('Company::class','country_id','id'); // i usualy don't write id and country because they already exist in new laravel version id i wrote them just to show you 
    }
    
}
