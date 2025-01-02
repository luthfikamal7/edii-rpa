<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Master\User as Model;
use App\Models\Master\Client;
use Illuminate\Support\Facades\Session;


class Users extends AbstractTable
{
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('clients.name', 'LIKE', "%{$value}%")
                        ->orWhere('users.role', 'LIKE', "%{$value}%")
                        ->orWhere('users.name', 'LIKE', "%{$value}%")
                        ->orWhere('users.email', 'LIKE', "%{$value}%")
                        ->orWhere('users.phone_number', 'LIKE', "%{$value}%")
                        ->orWhere('users.start_active', 'LIKE', "%{$value}%")
                        ->orWhere('users.end_active', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('users.*', 'clients.name as client')
            ->leftJoin('clients', 'clients.id', '=', 'users.client_id');
      
        if(session()->get('client_id') > 0){
            $query->where('users.client_id', session()->get('client_id'));
        }
        $query->defaultSort('client')
            ->defaultSort('-users.created_at')
            ->allowedSorts(['client', 'role', 'name', 'email', 'phone_number', 'start_active', 'end_active','created_at'])
            ->allowedFilters(['client', 'role', 'name', 'email', 'phone_number', 'start_active', 'end_active','created_at', 'client_id', $globalSearch]);
    
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
            ->column('client', sortable: true, canBeHidden: false)
            ->column('role', sortable: true, canBeHidden: false)
            ->column('name', sortable: true, canBeHidden: false)
            ->column('email', sortable: true, canBeHidden: false)
            ->column('phone_number', sortable: true, canBeHidden: false)
            ->column('start_active', sortable: true, canBeHidden: false)
            ->column('end_active', sortable: true, canBeHidden: false)
            // ->column('status', sortable: true, canBeHidden: false)
            ->column('created_at', sortable: true)
            ->column('action');
        if(session()->get('client_id') == 0){
            $table->selectFilter(
                key: 'client_id',
                options: Client::pluck('name', 'id')->toArray(),
                label: 'Client',
                noFilterOption: true,
                noFilterOptionLabel: 'Filter by Client'
            ); 
        }
            
    }
}
