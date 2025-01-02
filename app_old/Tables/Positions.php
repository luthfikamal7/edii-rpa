<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Circle\CirclePosition as Model;
use App\Models\Circle\Circle;

class Positions extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('circle_positions.name', 'LIKE', "%{$value}%")
                        ->orWhere('circle_positions.description', 'LIKE', "%{$value}%")
                        ->orWhere('b.name', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('circle_positions.*', 'b.name as circle')
            ->join('circles as b', 'b.id', '=', 'circle_positions.circle_id')
            ->defaultSort('b.name', 'circle_positions.name')
            ->allowedSorts(['circle_positions.name', 'circle_positions.description', 'b.name'])
            ->allowedFilters(['circle_positions.name', 'circle_positions.description', 'circle_positions.circle_id', 'circle_id', $globalSearch]);
    
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
            ->withGlobalSearch(columns: ['name', 'description', 'circle'])
            ->column('number', 'No.')
            ->column('circle', sortable: true)
            ->column('name', sortable: true)
            ->column('description', sortable: true)
            ->column('status')
            ->column('action')
            ->selectFilter(
                key: 'circle_id',
                options: Circle::pluck('name', 'id')->toArray(),
                label: 'List Circle',
                noFilterOption: true,
                noFilterOptionLabel: 'All Circle'
            );
    }
}
