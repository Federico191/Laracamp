<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use SoftDeletes;

    protected $table = 'checkouts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable =
        ['user_id','camp_id','card_number','expired','cvc','is_paid'];

    public function setExpiredAttributes($value) {
         $this->attributes['expired'] = date('Y-m-t', strtotime($value));
    }

    public function Camp(): BelongsTo {
        return $this->belongsTo(Camp::class,'camp_id','id');
    }
}
