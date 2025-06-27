<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    use HasFactory;

    protected $table = 'lga';
    protected $primaryKey = 'uniqueid';
    public $timestamps = false;

    public function pollingUnits()
    {
        return $this->hasMany(PollingUnit::class, 'lga_id', 'lga_id');
    }
}