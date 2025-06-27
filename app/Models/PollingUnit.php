<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;

    protected $table = 'polling_unit';
    protected $primaryKey = 'uniqueid';
    public $timestamps = false;

    public function lga()
    {
        return $this->belongsTo(LGA::class, 'lga_id', 'lga_id');
    }

    public function ward()
    {
       
        return $this->belongsTo(Ward::class, 'uniquewardid', 'uniqueid');
    }

    public function announcedResults()
    {
        return $this->hasMany(AnnouncedPuResult::class, 'polling_unit_uniqueid', 'uniqueid');
    }
}