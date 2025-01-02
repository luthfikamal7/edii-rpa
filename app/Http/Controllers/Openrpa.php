<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Openrpa as Model;
use App\Models\Robot;
use Illuminate\Http\Request;


class Openrpa extends Controller
{
    public function __invoke(Request $request)
    {
        $get = Model::where('_type', 'workflow')->get();
        $model = Model::where('_type', 'workflow')->where('_id', '2e0cb09e-596b-47c6-b39d-35b97456833b')->first();

        if ($model) {
            // Jika dokumen ditemukan, tambahkan field status ke dalam dokumen tersebut
            $model->status = 'active'; // Misalnya, Anda ingin menambahkan status 'active'

            // Simpan perubahan
            $model->save();
        } else {
            // Jika dokumen tidak ditemukan, mungkin ada tindakan yang ingin Anda lakukan di sini
        }
        foreach($get as $q){
            // $log = new Robot([
            //     'name' => $robot_id,
            //     'description' => $robot_id,
            //     'start_date' => date('Y-m-d H:i:s'),
            //     'status' => 0 // Status awal adalah 0 yang berarti 'dimulai'
            // ]);
        }
    }
}
