<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acls extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'acls';
    protected $primaryKey   = 'id';
    
    // public $timestamps = false;

    protected $fillable = [
        'group_id','module_id', 'read','create','update','update','delete','approve'
    ];

    public function module(){

        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
