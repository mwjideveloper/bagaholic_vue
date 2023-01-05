<?php

namespace App\Traits\ModelTraits;

trait CatalogScopes
{
    public function scopeCatalogStatusSearchable($query, $field, $array = ['APPROVED', 'FOR PROCESSING'] )
    {
        return $query->whereIn($field, $array);
    }
}