<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Registration extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;


    protected $fillable = [
        'user_id',
        'group_name',
        'traditional_dance_name',
        'creative_dance_name',
        'koreografer_name',
        'assistant_koreografer_name',
        'address',
        'sinopsis_traditional',
        'sinopsis_creative',
        'fax_no',
        'doc_link',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function escortOfficers()
    {
        return $this->hasMany(EscortOfficer::class);
    }
}
