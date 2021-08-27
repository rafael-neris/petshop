<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model{
    //protected $table = "owners";

    protected $fillable = ['name','cellphone'];

    // public $timestamps = false;

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}