<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    // guarded
    protected $guarded = [];

    /**
     * Relation User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Sort Order
     */
    public function scopeSortOrder($query)
    {
        return $query->orderBy('sort', 'asc')->oldest();
    }

    /**
     * Mine Scope
     */
    public function scopeMine($query)
    {
        return $query->where(['user_id' => Auth::id()]);
    }

    /**
     * CreatedAt In Today Scope
     */
    public function scopeCreatedAtInToday($query)
    {
        return $query->whereDate('created_at', '>=', Carbon::today()->startOfDay())
            ->whereDate('created_at', '<=', Carbon::today()->endOfDay());
    }

}
