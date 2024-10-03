<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    private $date;
    
    public function __construct()
    {
        $this->date = date('Y-m-d h:i:s A');
    }
    
    public function checkIn()
    {
        $record = Attendance::where('user_id' , Auth::id())->whereNull('check_out')->latest()->first();

        if(!$record)
        {
            $record = Attendance::create([
                'check_in'=>$this->date,
                'user_id'=>Auth::id(),
            ]);
            
            return response()->json(['message'=>'Checked in successfully']);
        }

        return response()->json(['message'=>'You should not check in twice at the same time. go to check out first']);
    }
    
    public function checkOut()
    {
        $record = Attendance::where('user_id' , Auth::id())->whereNull('check_out')->first();
        
        $check_in = $record?->check_in;
        $check_out = $this->date;
        
        $hoursDifference = (Carbon::parse($check_in))->diffInHours($check_out);
        
        if($record)
        {
            $record->update([
                'check_out'=>$check_out,
                'work_hours'=>$hoursDifference,
            ]);
            
            return response()->json(['message'=>'Checked out successfully']);
        }
        
        return response()->json(['message'=>'You should not check out twice at the same time. go to check in first']);
    }
}
