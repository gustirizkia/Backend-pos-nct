<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function store(){
        return $this->hasMany(VendorStore::class, 'uuid_vendor', 'uuid');
    }
}
