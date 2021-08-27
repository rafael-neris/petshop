<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model{
    //protected $table = "pets";

    protected $fillable = ['name','age','species','breed','owner_id'];

    // public $timestamps = false;

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

}