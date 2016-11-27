<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bills';

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
    protected $fillable = ['consumer_id', 'generate_bill_id', 'user_id', 'amount'];


    protected $dates = ['deleted_at'];

    public function consumer(){
        return $this->belongsTo('App\Consumer');
    }
    public function generateBill(){
        return $this->belongsTo('App\Generate_bill');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function payment(){
        return $this->hasOne('App\Payment');
    }

}
