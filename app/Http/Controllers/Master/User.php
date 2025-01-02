<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use App\Tables\Users as Table;

use App\Models\Master\Client;
use App\Models\Master\UserRobot;
use App\Models\Robot;
use App\Models\Master\User as Model;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $links = "master/user";
    public $title = "User";

    

    public function __invoke(Request $request)
    {
        return view('master.user.index', [
            'user' => Table::class,
            'links' => '#',
            'title' => $this->title,
        ]);
    }


    public function add(){
        
        if(session()->get('client_id') > 0){
            $list_client = Client::where('id', session()->get('client_id'))->get();
        }else{
            $list_client = Client::get();
        }
        return view('master.user.add', [
            'title' => $this->title,
            'list_client' => $list_client,
            'links' => $this->links
        ]);
    }

    public function save(Request $request){
        $data = $request->validate([
            'client_id' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
        ]);

        // Add to data array
        if(session()->get('client_id') > 0){
            $getUser = Model::where('client_id', session()->get('client_id'))->where('role', 'admin')->first();
            $data['client_id'] = session()->get('client_id');
            $data['start_active'] = $getUser->start_active;
            $data['end_active'] = $getUser->end_active;
            $data['role'] = "staff";
        }else{
            $data['start_active'] = $request->input('start_active');
            $data['end_active'] = $request->input('end_active');
            $data['role'] = "admin";
        }
        $data['status'] = 1;
        $data['password'] = Hash::make($request->input('password'));
        
        
        Model::create($data);

        Splade::toast('User Saved!')->rightBottom()->autoDismiss(5);
        return to_route('master.user');
    }

    public function edit(Model $user){
        if(session()->get('client_id') > 0){
            $list_client = Client::where('id', session()->get('client_id'))->get();
        }else{
            $list_client = Client::get();
        }
        return view('master.user.edit', [
            'user' => $user,
            'title' => $this->title,
            'client' => $list_client,
            'links' => $this->links
        ]);
    }

    public function update(Request $request, Model $user){
        $data = $request->validate([
            'client_id' => ['nullable'],
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
        ]);

        // Add to data array
        if(session()->get('client_id') > 0){
            $getUser = Model::where('client_id', session()->get('client_id'))->where('role', 'admin')->first();
            $data['start_active'] = $getUser->start_active;
            $data['end_active'] = $getUser->end_active;
        }else{
            if($request->input('client_id') > 0){
                $getUser = Model::where('client_id', $request->input('client_id'))->where('role', 'admin')->first();
                $data['start_active'] = $getUser->start_active;
                $data['end_active'] = $getUser->end_active;
            }else{
                $data['start_active'] = "";
                $data['end_active'] = "";
            }
            
        }
        $user->update($data);

        Splade::toast('User Updated!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.user');
    }

    public function delete(Model $user){
        $user->delete();

        Splade::toast('User Deleted!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.user');
    }

    public function reset(Model $user){
        $data['password'] = Hash::make('pelindo2024');
        $user->update($data);
        Splade::toast('Password User berhasil direset!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.user');
    }
    
    public function access(Model $user){
        if(session()->get('client_id') > 0){
            $list_client = Client::where('id', session()->get('client_id'))->get();
        }else{
            $list_client = Client::get();
        }

        $robot = Robot::leftJoin('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->where('ur.user_id', $user->id)->whereIn('robots.id', [91, 95, 103])->select('robots.*', 'ur.user_id', 'ur.status as status_robot');
        if($robot->count() == 0){
            $robot = Robot::leftJoin('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->whereIn('robots.id', [91, 95, 103])->select('robots.*', 'ur.user_id', 'ur.status as status_robot');
        }
        return view('master.user.access', [
            'user' => $user,
            'robot' => $robot->get(),
            'title' => $this->title,
            'list_client' => $list_client,
            'links' => $this->links
        ]);
    }
 
    public function updateStatus(Request $request){
        $user_id = $request->input('user_id');
        $robot_id = $request->input('robot_id');
        $status = $request->input('status');
        UserRobot::where('user_id', $user_id)->delete();
        
        for ($i = 0; $i < count($robot_id); $i++) {
            $data['robot_id'] = $robot_id[$i];
            $data['user_id'] = $user_id;
            $data['status'] = $status[$i];
            UserRobot::create($data);
        }

        Splade::toast('User Robot Saved!')->rightBottom()->autoDismiss(5);
        return redirect()->route('master.user');
    }
}
