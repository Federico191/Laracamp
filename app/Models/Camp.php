<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'camps';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'title','price'
    ];

    public function getIsRegisteredAttribute() {
        if (!Auth::check()) {
            return false;
        }

        return Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists();
    }

    public function Checkout(): HasMany {
        return $this->hasMany(Checkout::class,'camp_id','id');
    }
}
