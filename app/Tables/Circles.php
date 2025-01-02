<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Circle\Circle as Model;

class Circles extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%")
                        ->orWhere('instagram', 'LIKE', "%{$value}%")
                        ->orWhere('linkedin', 'LIKE', "%{$value}%")
                        ->orWhere('youtube', 'LIKE', "%{$value}%")
                        ->orWhere('facebook', 'LIKE', "%{$value}%")
                        ->orWhere('website', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'description', 'instagram', 'linkedin', 'youtube', 'facebook', 'website'])
            ->allowedFilters(['name', 'description', 'instagram', 'linkedin', 'youtube', 'facebook', 'website', 'status', $globalSearch]);
    
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
            ->withGlobalSearch(columns: ['id', 'name'])
            ->column('number', 'No.')
            ->column('name', sortable: true)
            ->column('description', sortable: true)
            ->column('instagram', sortable: true)
            ->column('linkedin', sortable: true)
            ->column('youtube', sortable: true)
            ->column('facebook', sortable: true)
            ->column('website', sortable: true)
            ->column('action'); // This will handle pagination for Splade
    }
}
