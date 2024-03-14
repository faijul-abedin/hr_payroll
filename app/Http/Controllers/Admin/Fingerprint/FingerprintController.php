<?php

namespace App\Http\Controllers\Admin\Fingerprint;

use App\Http\Controllers\Controller;
use App\Models\attendance as ModelsAttendance;
use App\Models\Setup;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\Helper\Attendance;
use Rats\Zkteco\Lib\ZKTeco;

class FingerprintController extends Controller
{
    public function setupIndex()
    {
        $setup = Setup::first();
        return view('admin.fingerprint.setup', compact('setup'));
    }

    public function setupUpdate(Request $request)
    {
        $setup = Setup::find($request->id);
        $setup->dns = $request->dns;
        $setup->port = $request->port;
        $setup->update();

        $zk = new ZKTeco($setup->dns, $setup->port);
        if ($zk->connect()){
            $zk->testVoice(); 
        }

        $notification = array(
            'message' => 'Setup Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function zktecoIndex()
    {   $setup = Setup::first();
        $zk = new ZKTeco($setup->dns, $setup->port);
        if ($zk->connect()){
            $attendance = $zk->getAttendance();
            // $zk->testVoice(); 
            dd($zk->version(), $zk->getUser(), $attendance);
            return view('zkteco::app',compact('attendance'));
        }
    }

    public function inoutIndex()
    {
        // $zk = new ZKTeco('192.168.0.194', 4370);
        $setup = Setup::first();
        $zk = new ZKTeco($setup->dns, $setup->port);
        if ($zk->connect()){
            $attendances = $zk->getAttendance();
            return view('admin.fingerprint.attendance',compact('attendances'));
        }
    }

    public function getAttendance()
    {
        $setup = Setup::first();
        $zk = new ZKTeco($setup->dns, $setup->port);

        if ($zk->connect()){
        $attendances = $zk->getAttendance(); 
        // $attendanceCount = count($attendances);
        // dd($attendanceCount);

        foreach ($attendances as $entry) {
            $attendance = new ModelsAttendance();
            $attendance->employee_id = $entry['id'];
            $attendance->uid = $entry['uid'];
            $attendance->state = $entry['state'];
            $attendance->timestamp = $entry['timestamp'];
            $attendance->type = $entry['type'];
            $attendance->is_present = 1;
            $attendance->is_late = 0;
            $attendance->save();
        }
        
        $zk->clearAttendance(); 
        $zk->disconnect();

        $notification = array(
            'message' => 'Attendance Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }
    }
}
