<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DataGridScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): Builder
    {
        $sort = request()->query('sort');
        $filter = request()->query('filter');
        if($filter) {
            foreach($filter as $fn){
                if($fn['value']) {
                    $fn['value'] = $fn['type'] == "like" ? '%'.$fn['value'].'%' : $fn['value'];
                    $builder->where($fn['field'], $fn['type'], $fn['value']);
                }
            }
        }
        if($sort) {
            foreach($sort as $fn){
                $builder->orderBy($fn['field'], $fn['dir']);
            }
        } else {
            $builder->latest('updated_at');
        }
        return $builder;
    }
}
