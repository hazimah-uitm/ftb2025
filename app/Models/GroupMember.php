<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class GroupMember extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected $fillable = [
        'registration_id',
        'name',
        'ic_no',
        'student_id',
        'peranan',
        'jantina',
        'saiz_baju',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
