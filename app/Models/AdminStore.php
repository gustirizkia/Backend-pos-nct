<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStore extends Model
{
    use HasFactory;

    protected $fillable = ['user_uuid', 'store_uuid'];

    public function store(){
        return $this->belongsTo(VendorStore::class, 'store_uuid', 'uuid');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
