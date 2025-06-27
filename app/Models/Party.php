<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function announcedResults()
    {
        return $this->hasMany(AnnouncedPuResult::class, 'party_abbreviation', 'partyid');
    }
}