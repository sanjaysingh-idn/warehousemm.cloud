<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Pcs;
use App\Models\Kain;
use App\Models\Bukutamu;
use App\Models\Supplier;
use App\Models\Dashboard;
use App\Models\PackingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Spatie\Backup\BackupDestination\BackupDestination;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index', [
            'title'             => 'Dashboard',
            'countKain'         => Kain::all()->count(),
            'countKainToday'    => Kain::whereDate('tgl_masuk', Carbon::today())->count(),
            'countPackingList'  => PackingList::whereDate('tanggal', Carbon::today())->count(),
            // 'countKainToday'    => Kain::all()->count(),
            // 'countPackingList'  => PackingList::all()->count(),
            'packingList'       => PackingList::latest()->take(4)->get(),
            'countSupplier'     => Supplier::all()->count(),
            'countBukutamu'     => Bukutamu::all()->count(),
            'countNullStatusPcs' => Pcs::whereNull('status')->count(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Dashboard $dashboard)
    {
        //
    }

    public function edit(Dashboard $dashboard)
    {
        //
    }


    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    public function destroy(Dashboard $dashboard)
    {
        //
    }

    public function backup(Request $request)
    {
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $backupFileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = storage_path('app/' . $backupFileName);

        $command = [
            'mysqldump',
            '-u' . $dbUser,
            '-p' . $dbPass,
            $dbName,
            '>',
            $backupFilePath
        ];

        $process = new Process($command);

        try {
            // Run the mysqldump command
            $process->mustRun(null, ['PATH' => '/usr/bin:/usr/sbin:/bin:/sbin']);

            // Download the backup file
            return response()->download($backupFilePath)->deleteFileAfterSend(true);
        } catch (ProcessFailedException $exception) {
            // Log detailed error information
            \Log::error('Error occurred during database backup: ' . $exception->getMessage());
            return response()->json(['error' => 'Database backup failed.'])->setStatusCode(500);
        }
    }
}
