<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Tables\Logs as Table;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

class Log extends Controller
{
    public $links = "report/log";
    public $title = "Reporting Log";

    public function __invoke(Request $request)
    {
        return view('report.log', [
            'robot' => Table::class,
            'links' => '#',
            'title' => $this->title,
        ]);
    }
}
