<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use ProtoneMedia\Splade\SpladeTable;

use ProtoneMedia\Splade\Facades\Splade;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SampleController extends Controller
{
    public function __invoke(Request $request)
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });

        $users = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email', 'status', $globalSearch])
            ->paginate()
            ->withQueryString();

        $startingNumber = ($users->currentPage() - 1) * $users->perPage() + 1;

        // Iterate over the collection and add auto-incrementing numbers
        $processedUsers = $users->map(function ($user) use (&$startingNumber) {
            $user->setAttribute('number', $startingNumber++);
            return $user;
        });

        return view('user.index', [
            'users' => SpladeTable::for($users)
                ->defaultSort('name')
                ->withGlobalSearch() 
                ->column('number', 'No.')
                ->column('name', sortable: true, searchable: true, canBeHidden: false)
                ->column('email', sortable: true, searchable: true)
                ->column('nik')
                ->column('nomor_handphone')
                ->column('created_at')
                ->column('action', alignment: 'right')
                ->selectFilter('status', [
                    '1' => 'Active',
                    '0' => 'Not Active'
                ])
        ]);
    }

    public function edit(User $user){
        return view('user.edit', [
            'user' => $user,
            'list_status' => [100, 200]
        ]);
    }

    public function update(Request $request, User $user){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        $user->update($data);

        Splade::toast('User updated!')->rightBottom()->autoDismiss(5);
        return redirect()->route('sample');
    }

}
