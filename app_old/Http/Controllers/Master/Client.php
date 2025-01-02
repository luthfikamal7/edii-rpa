<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Client as Model;
use App\Tables\Clients as Table;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

class Client extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $links = "master/client";
    public $title = "Data Client";

    public function __invoke(Request $request)
    {
        return view('master.client.index', [
            'client' => Table::class,
            'links' => '#',
            'title' => $this->title,
        ]);
    }


    public function add(){
        return view('master.client.add', [
            'title' => $this->title,
            'links' => $this->links
        ]);
    }

    public function save(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'address' => ['nullable'],
            'phone_number' => ['nullable'],
            'pic' => ['nullable'],
            'phone_number_pic' => ['nullable'],
            'website' => ['nullable'],
        ]);

        Model::create($data);

        Splade::toast('Client Saved!')->rightBottom()->autoDismiss(5);
        return to_route('master.client');
    }

    public function edit(Model $client){
        return view('master.client.edit', [
            'client' => $client,
            'title' => $this->title,
            'links' => $this->links
        ]);
    }

    public function update(Request $request, Model $client){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'address' => ['nullable'],
            'phone_number' => ['nullable'],
            'pic' => ['nullable'],
            'phone_number_pic' => ['nullable'],
            'website' => ['nullable'],
        ]);

        $client->update($data);

        Splade::toast('Client Updated!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.client');
    }

    public function delete(Model $client){
        $client->delete();

        Splade::toast('Client Deleted!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.client');
    }
}
