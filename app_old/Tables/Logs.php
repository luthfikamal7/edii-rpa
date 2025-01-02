<?php
namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\RobotLogDetail as Model;
use App\Models\RobotLog;
use App\Models\Robot;
use App\Models\Master\UserRobot;
use App\Models\Master\User;

class Logs extends AbstractTable
{
    // Constructor and authorize method are kept as it is

    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('r.name', 'LIKE', "%{$value}%")
                        ->orWhere('rl.start_date', 'LIKE', "%{$value}%")
                        ->orWhere('rl.end_date', 'LIKE', "%{$value}%")
                        ->orWhere('robot_log_details.start_date', 'LIKE', "%{$value}%")
                        ->orWhere('robot_log_details.title', 'LIKE', "%{$value}%")
                        ->orWhere('robot_log_details.nomor', 'LIKE', "%{$value}%")
                        ->orWhere('rl.code', 'LIKE', "%{$value}%");
                });
            });
        });
        
        if(session()->get('client_id') > 0){
            $user_id = session()->get('user_id');
            $query = QueryBuilder::for(Model::class)
                ->select('robot_log_details.*', 'rl.code', 'r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.start_date as dimulai')
                ->join('robot_logs as rl', 'rl.id', '=', 'robot_log_details.robot_log_id')
                ->join('robots as r', 'r.id', '=', 'rl.robot_id')
                ->join('user_robots as ur', 'ur.robot_id', '=', 'r.id')
                ->where('ur.user_id', $user_id)
                ->where('ur.status', 1)
                ->whereNot('r.id', 85)
                ->whereNot('r.id', 86)
                ->defaultSort('rl.code')
                // ->defaultSort('robot_log_details.nomor')
                ->allowedSorts(['r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.title', 'robot_log_details.nomor'])
                ->allowedFilters(['r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.title', 'robot_log_details.nomor', 'status_error', $globalSearch]);
        }else{
            $query = QueryBuilder::for(Model::class)
                ->select('robot_log_details.*', 'rl.code', 'r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.start_date as dimulai')
                ->join('robot_logs as rl', 'rl.id', '=', 'robot_log_details.robot_log_id')
                ->join('robots as r', 'r.id', '=', 'rl.robot_id')
                ->whereNot('r.id', 85)
                ->whereNot('r.id', 86)
                ->defaultSort('-rl.code')
                ->allowedSorts(['r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.title', 'robot_log_details.nomor'])
                ->allowedFilters(['r.name', 'rl.start_date', 'rl.end_date', 'robot_log_details.title', 'robot_log_details.nomor', 'status_error', $globalSearch]);
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
            ->withGlobalSearch(columns: ['id', 'name', 'start_date', 'end_date', 'dimulai', 'nomor', 'title'])
            ->column('number', 'No.')
            ->column('code', sortable: false)
            ->column('name', sortable: false)
            ->column('start_date', sortable: false)
            ->column('end_date', sortable: false)
            ->column('duration', sortable: false)
            ->column('nomor', sortable: false)
            ->column('title', sortable: false)
            ->column('dimulai', sortable: false)
            ->column('status_error', sortable: false, hidden: true)
            ->selectFilter(
                key: 'status_error',
                options: [
                   '0' => 'Berhasil',
                   '1' => 'Error'
                ],
                label: 'Status Error',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Status Error'
            );
    }
}
