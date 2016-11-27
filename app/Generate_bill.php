<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Generate_bill extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generate_bills';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'date', 'user_id'];


    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function bill(){
        return $this->hasMany('App\Bill');
    }
}
