<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Group extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'groups';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'name', 'deskripsi', 'is_active'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Group Pengguna");
    }
}
