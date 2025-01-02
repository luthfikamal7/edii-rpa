<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Master\Client as Model;

class Clients extends AbstractTable
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
                        ->orWhere('address', 'LIKE', "%{$value}%")
                        ->orWhere('phone_number', 'LIKE', "%{$value}%")
                        ->orWhere('pic', 'LIKE', "%{$value}%")
                        ->orWhere('phone_number_pic', 'LIKE', "%{$value}%")
                        ->orWhere('website', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'description', 'address', 'phone_number', 'pic', 'phone_number_pic', 'website'])
            ->allowedFilters(['name', 'description', 'address', 'phone_number', 'pic', 'phone_number_pic', 'website', 'status', $globalSearch]);
    
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
            ->column('address', sortable: true)
            ->column('phone_number', sortable: true)
            ->column('pic', sortable: true)
            ->column('phone_number_pic', sortable: true)
            ->column('website', sortable: true)
            ->column('action'); // This will handle pagination for Splade
    }
}
