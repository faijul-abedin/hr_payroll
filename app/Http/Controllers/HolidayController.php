<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::all();

        return view('HR.index_holiday', compact('holidays'));
    }
    public function create()
    {
        //$holidays = Holiday::all();

        return view('HR.create_holiday');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'date' => 'required|date'
        ]);

        $holiday = new Holiday();
        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->save();

        // return response()->json($holiday, 201);

        $notification = array(
            'message' => "Holiday added successfully",
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $holiday = Holiday::where('id', $id)->first();
        return view('HR.edit_holiday', compact('holiday'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date'
        ]);
        $holiday = Holiday::where('id', $request->id)->first();
        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->save();

        $notification = array(
            'message' => "Holiday updated successfully",
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $holiday=Holiday::find($id);
        $holiday->delete();

        $notification = array(
            'message' => "Holiday deleted successfully",
            'alert-type' => 'warning'
         );
         return redirect()->back()->with($notification);
    }

    
}
