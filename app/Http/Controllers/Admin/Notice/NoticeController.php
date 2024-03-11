<?php

namespace App\Http\Controllers\Admin\Notice;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NoticeController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function NoticeIndex()
    {
        if (is_null($this->user) || !$this->user->can('notice.index')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notices = Notice::all();
        return view('admin.notice.notice_index',compact('notices'));
    }
    public function NoticeEdit($id)
    {
        if (is_null($this->user) || !$this->user->can('notice.edit')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notice = Notice::findOrFail($id);
        return view('admin.notice.edit_notice',compact('notice'));
    }
    public function NoticeSave(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('notice.add')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notice = new Notice();
        $notice->heading = $request->heading;
        $notice->details = $request->details;
        $notice->save();
        $notification = array(
            'message' => 'Notice Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function NoticeUpdate(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);
        $notice->heading = $request->heading;
        $notice->details = $request->details;
        $notice->update();
        $notification = array(
            'message' => 'Notice Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('notice.index')->with($notification);
    }
    public function NoticeDelete($id){
        if (is_null($this->user) || !$this->user->can('notice.delete')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notice = Notice::findOrFail($id);
        $notice->delete();
        $notification = array(
            'message' => 'Notice Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
