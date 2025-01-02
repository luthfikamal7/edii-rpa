<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Region\Village as Model;
use App\Models\Region\Subdistrict;

class Villages extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('villages.name', 'LIKE', "%{$value}%")
                        ->orWhere('b.name', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('villages.*', 'b.name as subdistrict')
            ->join('subdistricts as b', 'b.id', '=', 'villages.subdistrict_id')
            ->defaultSort('villages.name', 'b.name')
            ->allowedSorts(['villages.name', 'b.name'])
            ->allowedFilters(['villages.name', 'villages.subdistrict_id', 'subdistrict_id', $globalSearch]);
    
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
            ->withGlobalSearch(columns: ['name', 'subdistrict'])
            ->column('number', 'No.')
            ->column('subdistrict', sortable: true)
            ->column('name', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'subdistrict_id',
                options: Subdistrict::pluck('name', 'id')->toArray(),
                label: 'List Subdistrict',
                noFilterOption: true,
                noFilterOptionLabel: 'All Subdistrict'
            );
    }
}
