<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\Capacity;
use Spatie\Activitylog\Models\Activity;

class LogServisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::paginate(10);
        return view('pages/kepalatoko/log-servis', compact('activities'));
    }

    public function destroy($model)
    {
        Activity::where('subject_type', $model)->truncate();

        toast('Semua log aktivitas servis berhasil dihapus.', 'success');

        return redirect()->route('log-servis');
    }
}
