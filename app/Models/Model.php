<?php
/**
 * Core Model for the system models
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as CoreModel;

/**
 * Class Model
 * @package App\Models
 */
abstract class Model extends CoreModel
{
    const SORT = null;
    const FIELDS = null;
    const SEARCH = null;

    /**
     * Is object deletable
     *
     * @return bool
     */
    public function getDeletableAttribute()
    {
        return true;
    }

    /**
     * Pagination scope
     *
     * @param Builder $query
     * @param $page
     * @param $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function scopeByPage(Builder $query, $page, $limit)
    {
        return $query->select( static::FIELDS )->offset( ($page - 1) * $limit)->limit($limit)->orderBy( static::SORT )->get();
    }

    /**
     * Uuid Scope
     *
     * @param Builder $query
     * @param $uuid
     * @return Builder
     */
    public function scopeUuid(Builder $query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    /**
     * Set the Search Scope
     *
     * @param Builder $query
     * @return $this|Builder
     */
    public function scopeSearch(Builder $query)
    {
        $search = app('request')->input('search', null);

        if($search && static::SEARCH)
        {
            $fields = static::SEARCH;
            return $query->where(function(Builder $query) use ($search, $fields){
                foreach ($fields as $field) {
                    $query = $query->orWhere( $field, "LIKE", "%{$search}%" );
                }
                return $query;
            });
        }

        return $query;
    }
}