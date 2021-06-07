<?php

namespace App\Models;

use App\Traits\HashID;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HashID;
    use UuidTrait;

    public $table = 'products';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['uuid', 'name', 'description'];
    
    static $rules = [
        'name' => 'required'
    ];

    /**
     * Relaption
     *
     * @return User
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
