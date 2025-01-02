<?php
namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Robot as Model;
use App\Models\Master\UserRobot;
use App\Models\Master\User;

class Robots extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('robots.name', 'LIKE', "%{$value}%")
                        ->orWhere('robots.description', 'LIKE', "%{$value}%")
                        ->orWhere('robots.workflow_id', 'LIKE', "%{$value}%");
                });
            });
        });
        
        if(session()->get('client_id') > 0){
            $user_id = session()->get('user_id');
            $query = QueryBuilder::for(Model::class)
                ->join('user_robots as ur', 'ur.robot_id', '=', 'robots.id')
                ->where('ur.user_id', $user_id)
                ->where('ur.status', 1)
                ->whereNot('robots.id', 90)
                ->whereNot('robots.id', 92)
                ->whereNot('robots.id', 93)
                ->whereNot('robots.id', 94)
                ->whereNot('robots.id', 96)
                ->whereNot('robots.id', 97)
                ->defaultSort('robots.name')
                ->allowedSorts(['robots.name', 'robots.description', 'robots.workflow_id'])
                ->allowedFilters(['robots.name','robots.description', 'robots.workflow_id', 'status', $globalSearch]);
        }else{
            $query = QueryBuilder::for(Model::class)
                ->whereNot('robots.id', 90)
                ->whereNot('robots.id', 92)
                ->whereNot('robots.id', 93)
                ->whereNot('robots.id', 94)
                ->whereNot('robots.id', 96)
                ->whereNot('robots.id', 97)
                ->defaultSort('robots.name')
                ->allowedSorts(['robots.name', 'robots.description', 'robots.workflow_id'])
                ->allowedFilters(['robots.name','robots.description', 'robots.workflow_id', 'status', $globalSearch]);
        }
        
    
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
            ->withGlobalSearch(columns: ['id', 'name', 'workflow_id', 'description'])
            ->column('number', 'No.')
            ->column('name', sortable: false)
            ->column('description', sortable: false)
            // ->column('workflow_id', sortable: true)
            ->column('status', sortable: false)
            ->column('log') // This will handle pagination for Splade
            ->column('action')
            ->selectFilter(
                key: 'status',
                options: [
                   '1' => 'Aktif',
                   '2' => 'Proses',
                   '0' => 'Tidak Aktif'
                ],
                label: 'Status',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Status'
            );
    }
}
