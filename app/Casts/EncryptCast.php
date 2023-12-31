<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class EncryptCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return Crypt::decryptString($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        return Crypt::encryptString($value);
    }
}
