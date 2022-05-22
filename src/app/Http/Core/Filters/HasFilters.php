<?php
namespace App\Http\Core\Filters;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * Filter a result set.
     *
     * @param  Builder      $query
     * @param  QueryFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
