<?php

namespace App\Traits\ModelTraits;

trait OrderByScopes
{
    public function scopeOrderAsc($query, $field, $sort = 'ASC')
    {
        return $query->orderby($field, $sort);
    }

    public function scopeOrderDesc($query, $field, $sort = 'DESC')
    {
        return $query->orderby($field, $sort);
    }
}