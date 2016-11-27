<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Consumer extends Model
{
    use SoftDeletes, Sortable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consumers';

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
    protected $fillable = ['name', 'email', 'phone', 'occupation', 'father_name', 'mother_name', 'present_address', 'permanent_address', 'img_name', 'NID', 'package_id', 'amount', 'IP', 'start_date', 'end_date', 'user_id'];


    public function package(){
        return $this->belongsTo('App\Package');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function bill(){
        return $this->hasMany('App\Bill');
    }
    public function payment(){
        return $this->hasMany('App\Payment');
    }

    public $sortable = ['id',
        'name',
        'amount',
        'IP',
        'start_date',
        'package_id'];

    protected $dates = ['deleted_at'];
}
