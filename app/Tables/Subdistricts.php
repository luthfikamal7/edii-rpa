<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Region\Subdistrict as Model;
use App\Models\Region\City;

class Subdistricts extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('subdistricts.name', 'LIKE', "%{$value}%")
                        ->orWhere('b.name', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('subdistricts.*', 'b.name as city')
            ->join('cities as b', 'b.id', '=', 'subdistricts.city_id')
            ->defaultSort('subdistricts.name', 'b.name')
            ->allowedSorts(['subdistricts.name', 'b.name'])
            ->allowedFilters(['subdistricts.name', 'subdistricts.city_id', 'city_id', $globalSearch]);
    
        $paginator = $query->paginate();
        $paginator->appends(request()->query());
    
        $startingNumber = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
    
        // Iterate over the collection and add auto-incrementing numbers
        $processed = $paginator->getCollection()->map(function ($campus) use (&$startingNumber) {
            $campus->setAttribute('number', $startingNumber++);
            return $campus;
        });
    
        // Call configure method with the query builder instance

        return $paginator;
    }

    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name', 'city'])
            ->column('number', 'No.')
            ->column('city', sortable: true)
            ->column('name', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'city_id',
                options: City::pluck('name', 'id')->toArray(),
                label: 'List City',
                noFilterOption: true,
                noFilterOptionLabel: 'All City'
            );
    }
}
