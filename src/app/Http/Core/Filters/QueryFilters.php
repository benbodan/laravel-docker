<?php
namespace App\Http\Core\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Query\JoinClause;

abstract class QueryFilters
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder|JoinClause $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->builder;
    }
    /**
     * Get all request filters data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }
}
