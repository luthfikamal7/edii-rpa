<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Tables\Summarys as Table;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

class Summary extends Controller
{
    public $links = "report/summary";
    public $title = "Reporting Summary";

    public function __invoke(Request $request)
    {
        return view('report.summary', [
            'robot' => Table::class,
            'links' => '#',
            'title' => $this->title,
        ]);
    }
}
