<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer_request extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consumer_requests';

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
    protected $fillable = ['consumer_id', 'note', 'date', 'user_id'];

    public function consumer(){
        return $this->belongsTo('App\Consumer');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
