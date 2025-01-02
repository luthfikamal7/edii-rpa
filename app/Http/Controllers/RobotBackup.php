<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Robot as Model;
use App\Models\RobotLog;
use App\Models\RobotLogDetail;
use App\Tables\Robots as Table;
use App\Tables\RobotLogs as TableLog;
// use App\Models\Openrpa;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use Carbon\Carbon;

class Robot extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $links = "robot";
    public $title = "Robot";

    public function __invoke(Request $request)
    {   
        // $get = Openrpa::where('_type', 'workflow')->get();
        // foreach($get as $q){
        //     if(!isset($q->status)){
        //         $cek = Model::where('workflow_id', $q->_id)->count();
        //         if($cek == 0){
        //             $robot = new Model([
        //                 'name' => $q->name,
        //                 'description' => $q->_type,
        //                 'workflow_id' => $q->_id,
        //                 'status' => 1
        //             ]);
        //             if ($robot->save()) {
        //                 $openrpa = Openrpa::where('_type', 'workflow')->where('_id', $q->_id)->whereNot('_id', '6634b9b6a752787b8f3d01bb')->first();
        //                 // Pastikan objek $openrpa tidak null sebelum mengakses properti status
        //                 if ($openrpa) {
        //                     $openrpa->refresh();
        //                     $openrpa->status = 'ditarik';
        //                     $openrpa->save();
        //                 } else {
        
        //                 }
        //             }
        //         }
                
        //     }
        // }
        return view('robot.index', [
            'robot' => Table::class,
            'links' => '#',
            'title' => $this->title,
        ]);
    }

    public function log($robot_id)
    {   
        $globalSearch = AllowedFilter::callback('global', function($query, $value){
            $query->where(function ($query) use ($value){
                Collection::wrap($value)->each(function ($value) use ($query){
                    $query
                        ->orWhere('robots.name', 'LIKE', "%{$value}%")
                        ->orWhere('robot_logs.start_date', 'LIKE', "%{$value}%")
                        ->orWhere('robot_logs.end_date', 'LIKE', "%{$value}%");
                });
            });
        });

        $robotLogs = QueryBuilder::for(RobotLog::class)
            ->select('robot_logs.*', 'robots.name')
            ->join('robots', 'robots.id', '=', 'robot_logs.robot_id')
            ->where('robots.id', $robot_id)
            ->orderBy('robot_logs.created_at', 'desc')
            ->allowedSorts(['robots.name', 'robot_logs.start_date', 'robot_logs.end_date'])
            ->allowedFilters(['robots.name','robot_logs.start_date', 'robot_logs.end_date', $globalSearch])
            ->paginate()
            ->withQueryString();

        $startingNumber = ($robotLogs->currentPage() - 1) * $robotLogs->perPage() + 1;

        // Iterate over the collection and add auto-incrementing numbers
        $processed = $robotLogs->map(function ($robotLog) use (&$startingNumber) {
            $robotLog->setAttribute('number', $startingNumber++);
            return $robotLog;
        });

        return view('robot.log', [
            'links' => $this->links,
            'title' => $this->title,
            'robot' => SpladeTable::for($robotLogs)
                ->withGlobalSearch() 
                ->column('number', 'No.')
                ->column('name', sortable: true)
                ->column('start_date', sortable: true)
                ->column('end_date', sortable: true)
                ->column('duration', sortable: true),
        ]);
    }


    public function add(){
        return view('robot.add', [
            'list_status' => [
                '1' => 'Aktif',
                '0' => 'Tidak Aktif'
            ],
            'title' => $this->title,
            'links' => $this->links
        ]);
    }

    public function save(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'workflow_id' => ['required', 'string'],
            'status' => ['required'],
        ]);

        Model::create($data);

        Splade::toast('Robot Saved!')->rightBottom()->autoDismiss(5);
        return to_route('robot');
    }

    public function play(Model $robot){
        $cekRobot = Model::where('id', '!=', $robot->id)->where('status', 2)->count();
        return view('robot.play', [
            'robot' => $robot,
            'cekRobot' => $cekRobot,
            'title' => $this->title,
            'links' => $this->links
        ]);
    }

    public function cek($workflow_id){
        $get = Model::where('workflow_id', $workflow_id)->first();
        if (!$get) {
            return response()->json([
                'message' => 'Workflow ID tidak ditemukan.',
                'success' => false,
                'workflow_id' => $workflow_id
            ], 404);
        }else{
            $log = RobotLog::where('robot_id', $get->id)->orderBy('created_at', 'desc')->first();
            if($log->status == 1){
                $detailLog = RobotLogDetail::where('robot_log_id', $log->id)
                                ->where('status_error', 1)
                                ->get(['title']);
                return response()->json([
                    'success' => true,
                    'start_date' => $log->start_date,
                    'end_date' => $log->end_date,
                    'status' => $get->status,
                    'array_error' => $detailLog->pluck('title')
                ]);
            }else if($log->status == 3){
                return response()->json([
                    'success' => true,
                    'message' => $log->message,
                    'status' => $log->status
                ]);
            }
            
        }
    }

    public function api($workflow_id){
        date_default_timezone_set('Asia/Jakarta');

        $get = Model::where('workflow_id', $workflow_id)->first();
        if (!$get) {
            return response()->json([
                'message' => 'Workflow ID tidak ditemukan.',
                'success' => false,
                'workflow_id' => $workflow_id
            ], 404);
        }else{
            Model::where('workflow_id', $workflow_id)->update([
                'status' => 1 // Status 2 sedang berjalan
            ]);

            RobotLog::where('robot_id', $get->id)->update([
                'end_date' => date('Y-m-d H:i:s'),
                'status' => 1 // Status 1 yang berarti 'berhasil'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Status robot berhasil diubah menjadi tersedia kembali untuk dijalankan',
                'status' => $get->status
            ]);
        }
    }

    public function message(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $get = Model::where('workflow_id', $request->query('workflow_id'))->first();
        if (!$get) {
            return response()->json([
                'message' => 'Workflow ID tidak ditemukan.',
                'success' => false,
                'workflow_id' => $request->query('workflow_id')
            ], 404);
        }else{
            
            if($request->query('continue') != null){
                $getRobotLog = RobotLog::where('robot_id', $get->id)->where('status', 0)->first();
                if($getRobotLog != null){
                    $robot_log_id = $getRobotLog->id;
                    $proses = RobotLogDetail::insert([
                        'robot_id' => $get->id,
                        'robot_log_id' => $getRobotLog->id,
                        'start_date' => date('Y-m-d H:i:s'),
                        'title' => $request->query('msg'),
                        'nomor' => 0,
                        'status' => 1,
                        'status_error' => 1
                    ]);
                }
            }else{
                RobotLog::where('robot_id', $get->id)->update([
                    'message' => $request->query('msg'),
                    'end_date' => date('Y-m-d H:i:s'),
                    'status' => 3 // 3 = error
                ]);

                Model::where('workflow_id', $request->query('workflow_id'))->update([
                    'status' => 1
                ]);    
            }
            

            return response()->json([
                'success' => true,
                'message' => $request->query('msg')
            ]);
        }
    }

    public function logDetail(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $get = Model::where('workflow_id', $request->query('workflow_id'))->first();
        if (!$get) {
            return response()->json([
                'message' => 'Workflow ID tidak ditemukan.',
                'success' => false,
                'workflow_id' => $request->query('workflow_id')
            ], 404);
        }else{
            $getLog = RobotLog::where('robot_id', $get->id)->where('status', 0);
            if($getLog->count() > 0){
                $getLog = $getLog->first();
                $robot_log_id = $getLog->id;
                RobotLogDetail::insert([
                    'robot_id' => $get->id,
                    'robot_log_id' => $robot_log_id,
                    'start_date' => date('Y-m-d H:i:s'),
                    'title' => $request->query('title'),
                    'nomor' => $request->query('nomor'),
                    'status' => $request->query('status'),
                ]);

                if($request->query('status') == 2){
                    RobotLog::where('robot_id', $get->id)->update([
                        'end_date' => date('Y-m-d H:i:s'),
                        'status' => 1 // Status 1 yang berarti 'berhasil'
                    ]);

                    Model::where('workflow_id', $request->query('workflow_id'))->update([
                        'status' => 1 // Status 2 sedang berjalan
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => $request->query('title')
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => ""
                ]);
            }
            
        }
    }

    public function run($workflow_id){
        set_time_limit(0);
        date_default_timezone_set('Asia/Jakarta');
          // Mencari record RobotLog berdasarkan workflow_id
          $get = Model::where('workflow_id', $workflow_id)->first();
          if (!$get) {
              return response()->json([
                  'success' => false,
                  'message' => 'Workflow ID tidak ditemukan.',
                  'workflow_id' => $workflow_id
              ], 404);
          }
  
          $robot_id = $get->id;
          

            // Mendapatkan bulan dan tahun saat ini
            $currentMonth = Carbon::now()->format('Ym');

            // Mencari log terakhir untuk menentukan nomor berikutnya
            $lastLog = RobotLog::where('code', 'like', 'RB' . $currentMonth . '%')
                            ->orderBy('id', 'desc')
                            ->first();

            if ($lastLog) {
                // Jika ada log terakhir, ambil nomor dari kode terakhir
                preg_match('/RB(\d+)/', $lastLog->code, $matches);
                $lastNumber = intval($matches[1]);
                $nextNumber = $lastNumber + 1;
            } else {
                // Jika tidak ada log sebelumnya dalam bulan ini, mulai dari 1
                $nextNumber = 1;
            }

            // Format nomor dengan padding nol di depan jika diperlukan
            $nextNumberFormatted = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

            // Membuat kode baru dengan format RBYYYYMMxxxxx
            $newCode = 'RB' . $currentMonth . $nextNumberFormatted;
            $newCodeShortened = 'RB' . $currentMonth . substr($nextNumberFormatted, -5);


          // Insert ke tabel robot_logs
          $log = new RobotLog([
              'robot_id' => $robot_id,
              'code' => $newCodeShortened,
              'start_date' => date('Y-m-d H:i:s'),
              'status' => 0 // Status awal adalah 0 yang berarti 'dimulai'
          ]);

          
          
          
          if ($log->save()) {
                Model::where('workflow_id', $workflow_id)->update([
                    'status' => 2 // Status 2 sedang berjalan
                ]);
              // Simulasikan operasi robot
              // Pada kasus nyata, Anda mungkin memanggil fungsi atau service yang melakukan operasi ini
              $result = true; // Misal hasil dari operasi robot
              $psCommand = '"Start-Process -FilePath \"C:\\Program Files\\OpenRPA\\OpenRPA.exe\" -ArgumentList \"-workflowid '.$workflow_id.'\""';
              // Define timeout in seconds
              $max_execution_time = 60000000000; // Example: 60 seconds
      
              // Open a process to execute the PowerShell command
              $descriptorspec = [
                  0 => ["pipe", "r"],  // stdin
                  1 => ["pipe", "w"],  // stdout
                  2 => ["pipe", "w"]   // stderr
              ];
      
              // Catat waktu mulai
              $start_time = microtime(true);
      
              $process = proc_open(
                  "powershell.exe -ExecutionPolicy Bypass -Command {$psCommand}",
                  $descriptorspec,
                  $pipes,
                  null,
                  null,
                  ['bypass_shell' => true] // Ensure that the command is executed in a shell
              );
      
              if (is_resource($process)) {
                  fclose($pipes[0]);  // Close stdin
      
                  // Wait for the process to finish or timeout
                  $process_running = true;
      
                  while ($process_running && (microtime(true) - $start_time) < $max_execution_time) {
                      // Check if the process is still running
                      $status = proc_get_status($process);
                      $process_running = $status['running'];
      
                      // Wait for a short time before checking again
                      usleep(10000); // Sleep for 10 milliseconds
                  }
      
                  // Wait for the process to finish
                  $exit_code = proc_close($process);
      
                  // Catat waktu selesai
                  $end_time = microtime(true);
      
                  // Menghitung durasi eksekusi
                  $execution_time = $end_time - $start_time;
      
                  // Check the exit code to determine the result
                  if ($exit_code === 0) {
                    // $log->update([
                    //     'end_date' => date('Y-m-d H:i:s'),
                    //     'status' => 1 // Status 1 yang berarti 'berhasil'
                    // ]);
    
                    return response()->json([
                        'success' => true,
                        'message' => 'Robot berhasil dijalankan!',
                        'workflow_id' => $workflow_id,
                        'log_id' => $log->id
                    ]);
                    //   echo "Process completed successfully in {$execution_time} seconds.\n";
                  } else {
                    // $log->update([
                    //     'end_date' => date('Y-m-d H:i:s'),
                    //     'status' => 1 // Status 1 yang berarti 'berhasil'
                    // ]);
    
                    return response()->json([
                        'success' => true,
                        'message' => 'Robot berhasil dijalankan!',
                        'workflow_id' => $workflow_id,
                        'log_id' => $log->id
                    ]);
                    //   echo "Process completed with exit code: $exit_code in {$execution_time} seconds.\n";
                    
                  }
              } else {
                // $log->update(['end_date' => date('Y-m-d H:i:s')]);
  
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal',
                    'workflow_id' => $workflow_id,
                    'log_id' => $log->id
                ], 400);
              }
            //   $psCommand = 'Start-Process -FilePath "C:\\Program Files\\OpenRPA\\OpenRPA.exe" -ArgumentList "-workflowid '.$workflow_id.' "';
            
          } else {
             
          }
    }

    public function edit(Model $robot){
        return view('robot.edit', [
            'robot' => $robot,
            'list_status' => [
                '1' => 'Aktif',
                '0' => 'Tidak Aktif'
            ],
            'title' => $this->title,
            'links' => $this->links
        ]);
    }

    public function update(Request $request, Model $robot){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            // 'workflow_id' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $robot->update($data);

        Splade::toast('Robot Updated!')->rightBottom()->autoDismiss(5);
        return redirect()->route('robot');
    }

    public function delete(Model $robot){
        $robot->delete();

        Splade::toast('Robot Deleted!')->rightBottom()->autoDismiss(5);
        return redirect()->route('robot');
    }
    

    public function getLogDetail($workflow_id)
    {
        $get = Model::where('workflow_id', $workflow_id)->first();
        if (!$get) {
            return response()->json([
                'message' => 'Workflow ID tidak ditemukan.',
                'success' => false,
                'workflow_id' => $workflow_id
            ], 404);
        }else{
            $robot = RobotLog::where('robot_id', $get->id)->where('status', 0)->first();

            $logs = RobotLogDetail::join('robot_logs as rl', 'rl.id', '=', 'robot_log_details.robot_log_id')->where('rl.robot_id', $get->id)->where('rl.status', 0)->select('robot_log_details.*')->get();
            // $logs = RobotLogDetail::join('robot_logs as rl', 'rl.id', '=', 'robot_log_details.robot_log_id')->where('rl.robot_id', $get->id)->select('robot_log_details.*')->get();
            $formattedLogs = $logs->map(function ($log) {
                return [
                    'waktu_selesai' => $log->start_date,
                    'nomor' => $log->nomor,
                    'title' => $log->title,
                    'status_error' => $log->status_error,
                ];
            });
            
            $return['start_date'] = $robot->start_date;
            $return['data'] = $formattedLogs;
            return response()->json($return);
        }

        // Format data untuk dikirim balik ke jQuery Ajax
        
    }
}
