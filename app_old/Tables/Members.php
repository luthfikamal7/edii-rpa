<?php

namespace App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Member as Model;

use App\Models\Region\Province;
use App\Models\Circle\Circle;
use App\Models\Circle\CirclePosition as Position;
use App\Models\Master\Education;
use Illuminate\Support\Facades\Session;


class Members extends AbstractTable
{
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('members.code', 'LIKE', "%{$value}%")
                        ->orWhere('circles.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.status_member', 'LIKE', "%{$value}%")
                        ->orWhere('positions.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.gender', 'LIKE', "%{$value}%")
                        ->orWhere('members.birthday', 'LIKE', "%{$value}%")
                        ->orWhere('members.age', 'LIKE', "%{$value}%")
                        ->orWhere('members.register', 'LIKE', "%{$value}%")
                        ->orWhere('members.age_internal', 'LIKE', "%{$value}%")
                        ->orWhere('members.status', 'LIKE', "%{$value}%")
                        ->orWhere('educations.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.institution', 'LIKE', "%{$value}%")
                        ->orWhere('members.segmen', 'LIKE', "%{$value}%")
                        ->orWhere('works.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.detail_work', 'LIKE', "%{$value}%")
                        ->orWhere('campus.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.profession', 'LIKE', "%{$value}%")
                        ->orWhere('members.detail_profession', 'LIKE', "%{$value}%")
                        ->orWhere('members.income', 'LIKE', "%{$value}%")
                        ->orWhere('provinces.name', 'LIKE', "%{$value}%")
                        ->orWhere('cities.name', 'LIKE', "%{$value}%")
                        ->orWhere('subdistricts.name', 'LIKE', "%{$value}%")
                        ->orWhere('villages.name', 'LIKE', "%{$value}%")
                        ->orWhere('members.detail_village', 'LIKE', "%{$value}%");
                });
            });
        });
    
        $query = QueryBuilder::for(Model::class)
            ->select('members.*', 'circles.name as circle', 'pc.name as province_circle', 'positions.name as position', 'educations.name as education', 'works.name as work', 'campus.name as campus', 'members.profession', 'provinces.name as province', 'cities.name as city', 'subdistricts.name as subdistrict', 'villages.name as village')
            ->leftJoin('circles', 'circles.id', '=', 'members.circle_id')
            ->leftJoin('provinces as pc', 'pc.id', '=', 'members.province_circle_id')
            ->leftJoin('circle_positions as positions', 'positions.id', '=', 'members.position_id')
            ->leftJoin('educations', 'educations.id', '=', 'members.education_id')
            ->leftJoin('works', 'works.id', '=', 'members.work_id')
            ->leftJoin('campus', 'campus.id', '=', 'members.campus_id')
            // ->leftJoin('professions', 'professions.id', '=', 'members.profession_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'members.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'members.city_id')
            ->leftJoin('subdistricts', 'subdistricts.id', '=', 'members.subdistrict_id')
            ->leftJoin('villages', 'villages.id', '=', 'members.village_id');
        if(session()->get('circle_id') > 0){
            $query->where('members.circle_id', session()->get('circle_id'));
        }
        $query->defaultSort('circles.name')
            ->defaultSort('-members.created_at')
            ->allowedSorts(['members.code', 'circles.name', 'pc.name', 'members.status_member', 'positions.name', 'members.name', 'members.gender', 'members.birthday', 'members.age', 'members.register', 'members.age_internal', 'members.status', 'educations.name', 'members.institution', 'members.segmen', 'works.name', 'members.detail_work', 'campus.name', 'members.profession', 'members.detail_profession', 'members.income', 'provinces.name', 'cities.name', 'subdistricts.name', 'villages.name', 'members.detail_village'])
            ->allowedFilters(['members.code', 'circles.name', 'pc.name', 'members.status_member', 'positions.name', 'members.name', 'members.gender', 'members.birthday', 'members.age', 'members.register', 'members.age_internal', 'members.status', 'educations.name', 'members.institution', 'members.segmen', 'works.name', 'members.detail_work', 'campus.name', 'members.profession', 'members.detail_profession', 'members.income', 'provinces.name', 'cities.name', 'subdistricts.name', 'villages.name', 'members.detail_village', 'circle_id', 'gender', 'education_id', 'segmen', $globalSearch]);
    
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
            ->column('code', sortable: true, canBeHidden: false)
            ->column('province_circle', sortable: true, canBeHidden: false)
            ->column('circle', sortable: true, canBeHidden: false)
            ->column('status_member', sortable: true, canBeHidden: false)
            ->column('position', sortable: true, canBeHidden: false)
            ->column('name', sortable: true, canBeHidden: false)
            ->column('gender', sortable: true, canBeHidden: false)
            ->column('birthday', sortable: true, canBeHidden: false)
            ->column('age', sortable: true, canBeHidden: false)
            ->column('register', sortable: true, canBeHidden: false)
            ->column('age_internal', sortable: true, canBeHidden: false)
            ->column('status', sortable: true)
            ->column('education', sortable: true)
            ->column('institution', sortable: true)
            ->column('segmen', sortable: true)
            ->column('work', sortable: true)
            ->column('detail_work', sortable: true)
            ->column('campus', sortable: true)
            ->column('profession', sortable: true)
            ->column('detail_profession', sortable: true)
            ->column('income', sortable: true)
            ->column('province', sortable: true)
            ->column('city', sortable: true)
            ->column('subdistrict', sortable: true)
            ->column('village', sortable: true)
            ->column('detail_village', sortable: true)
            ->column('created_at', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'circle_id',
                options: Circle::pluck('name', 'id')->toArray(),
                label: 'Circle',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Circle'
            )
            ->selectFilter(
                key: 'gender',
                options: [
                   'L' => 'Laki-laki',
                   'P' => 'Perempuan'
                ],
                label: 'Jenis Kelamin',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Jenis Kelamin'
            )
            ->selectFilter(
                key: 'segmen',
                options: [
                   'M' => 'Mahasiswa',
                   'P' => 'Pelajar',
                   'U' => 'Umum'
                ],
                label: 'Segmen',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Segmen'
            )
            ->selectFilter(
                key: 'education_id',
                options: Education::pluck('name', 'id')->toArray(),
                label: 'Pendidikan',
                noFilterOption: true,
                noFilterOptionLabel: 'Pilih Pendidikan'
            ); // This will handle pagination for Splade
    }
}
