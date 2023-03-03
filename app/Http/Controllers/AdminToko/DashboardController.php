<?php

namespace App\Http\Controllers\AdminToko;

use Carbon\Carbon;
use App\Models\DataFeed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $servismasuk = ServiceTransaction::whereDay('created_at', '=', date("d", strtotime(now())))->count();
        $servisselesai = ServiceTransaction::whereDay('tgl_selesai', '=', date("d", strtotime(now())))->where('status_servis', 'Bisa Diambil')->count();
        $servisdiambil = ServiceTransaction::whereDay('tgl_ambil', '=', date("d", strtotime(now())))->where('status_servis', 'Sudah Diambil')->count();

        return view('pages/admintoko/dashboard', compact('servismasuk', 'servisselesai', 'servisdiambil'));
    }
}
