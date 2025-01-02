<?php
namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\RobotLog as Model;
use App\Models\Robot;
use App\Models\Master\UserRobot;
use App\Models\Master\User;

class Summarys extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('r.name', 'LIKE', "%{$value}%")
                        ->orWhere('robot_logs.start_date', 'LIKE', "%{$value}%")
                        ->orWhere('robot_logs.end_date', 'LIKE', "%{$value}%")
                        ->orWhere('robot_logs.message', 'LIKE', "%{$value}%");
                });
            });
        });
        
        if(session()->get('client_id') > 0){
            $user_id = session()->get('user_id');
            $query = QueryBuilder::for(Model::class)
                ->join('robots as r', 'r.id', '=', 'robot_logs.robot_id')
                ->join('user_robots as ur', 'ur.robot_id', '=', 'r.id')
                ->where('ur.user_id', $user_id)
                ->where('ur.status', 1)
                ->whereNot('r.id', 85)
                ->whereNot('r.id', 86)
                ->defaultSort('r.name')
                ->allowedSorts(['r.name', 'robot_logs.start_date', 'robot_logs.end_date', 'robot_logs.message'])
                ->allowedFilters(['r.name', 'robot_logs.start_date', 'robot_logs.end_date', 'robot_logs.message', $globalSearch]);
        }else{
            $query = QueryBuilder::for(Model::class)
                ->join('robots as r', 'r.id', '=', 'robot_logs.robot_id')
                ->whereNot('r.id', 85)
                ->whereNot('r.id', 86)
                ->defaultSort('r.name')
                ->allowedSorts(['r.name', 'robot_logs.start_date', 'robot_logs.end_date', 'robot_logs.message'])
                ->allowedFilters(['r.name','robot_logs.start_date', 'robot_logs.end_date', 'robot_logs.message', $globalSearch]);
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
            ->withGlobalSearch(columns: ['id', 'name', 'start_date', 'end_date', 'message'])
            ->column('number', 'No.')
            ->column('code', sortable: false)
            ->column('name', sortable: false)
            ->column('start_date', sortable: false)
            ->column('end_date', sortable: false)
            ->column('duration', sortable: false)
            ->column('message', sortable: false)
            ->column('action', sortable: false);
    }
}
