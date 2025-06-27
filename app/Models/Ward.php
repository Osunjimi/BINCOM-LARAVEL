<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'ward';
    protected $primaryKey = 'uniqueid'; 
    public $timestamps = false; 

    public function pollingUnits()
    {
        return $this->hasMany(PollingUnit::class, 'uniquewardid', 'uniqueid');
    }
}
