<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Region\City as Model;
use App\Models\Region\Province;

class Citys extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('cities.name', 'LIKE', "%{$value}%")
                        ->orWhere('b.name', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('cities.*', 'b.name as province')
            ->join('provinces as b', 'b.id', '=', 'cities.province_id')
            ->defaultSort('cities.name', 'b.name')
            ->allowedSorts(['cities.name', 'b.name'])
            ->allowedFilters(['cities.name', 'cities.province_id', 'province_id', $globalSearch]);
    
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
            ->withGlobalSearch(columns: ['name', 'province'])
            ->column('number', 'No.')
            ->column('province', sortable: true)
            ->column('name', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'province_id',
                options: Province::pluck('name', 'id')->toArray(),
                label: 'List Province',
                noFilterOption: true,
                noFilterOptionLabel: 'All Province'
            );
    }
}
