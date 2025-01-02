<?php
namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Content\Article as Model;



class Articles extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%")
                        ->orWhere('image', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->defaultSort('title')
            ->allowedSorts(['title', 'description', 'image'])
            ->allowedFilters(['title','description', 'image', 'status', $globalSearch]);
    
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
            ->withGlobalSearch(columns: ['id', 'title', 'image', 'description'])
            ->column('number', 'No.')
            ->column('title', sortable: true)
            ->column('description', sortable: true)
            ->column('image', sortable: true)
            ->column('status', sortable: true)
            ->column('action'); // This will handle pagination for Splade
    }
}
