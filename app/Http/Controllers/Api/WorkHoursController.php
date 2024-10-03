<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WorkHoursRequest;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkHoursController extends Controller
{
    public function getTotalHours(WorkHoursRequest $request)
    {
        $to_date = Carbon::parse($request->to_date)->endOfDay();
        
        $totalHours = Attendance::where('user_id' , Auth::id())
        ->whereBetween('created_at' , [$request->from_date , $to_date])
        ->sum('work_hours');

        return response()->json(['total_hours'=>$totalHours]);
    }
}
