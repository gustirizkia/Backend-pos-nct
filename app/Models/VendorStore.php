<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorStore extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'uuid', 'uuid_vendor', 'status'];

    public function admin(){

        return $this->hasMany(AdminStore::class, 'store_uuid', 'uuid');
    }

}
