<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markSingle($id){
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();
            return response()->json([
                'status' => trans('mark_single_read_success'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => trans('mark_single_read_fail'),
            ]);
        }
    }
    public function markAll(){
        try {
            $notification = auth()->user()->notifications();
            $notification->markAsRead();
            return response()->json([
                'status' => trans('message.mark_single_read_success'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => trans('message.mark_single_read_fail'),
            ]);
        }
    }
}
