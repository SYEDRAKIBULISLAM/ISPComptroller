<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

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
    protected $fillable = ['consumer_id', 'bill_id', 'amount', 'due', 'discount', 'user_id', 'date'];

    protected $dates = ['deleted_at'];

    public function consumer(){
        return $this->belongsTo('App\Consumer');
    }
    public function bill(){
        return $this->belongsTo('App\Bill');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
