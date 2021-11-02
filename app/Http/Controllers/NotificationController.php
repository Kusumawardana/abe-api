<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\Notification;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class NotificationController extends BaseController
{
    public function index($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $notifications = Notification::whereIn('id_user', [$id, null])->latest()->paginate();
            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $notifications,
            ];
            return $data;
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => '',
            ];
            return $data;
        }
    }

    public function show($notificationId, $id)
    {
        $validation = auth::where('id_user', $id)->count();
        $notification = Notification::find($notificationId);

        if ($validation >= 1) {
            $data = [
                'status' => 'Success',
                'message' => 'Data Berhasil Diubah',
                'data' => $notification,
            ];
            return $data;
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => '',
            ];
            return $data;
        }
    }

    // public function update(Notification $notification, $id)
    // {
    //     $validation = auth::where('id_user', $id)->count();

    //     if ($validation >= 1) {
    //         $notification->update(['dibaca' => 1]);
    //         $data = [
    //             'status' => 'Success',
    //             'message' => 'Data Berhasil Diubah',
    //             'data' => '',
    //         ];
    //         return $data;
    //     } else {
    //         $data = [
    //             'status' => 'Error',
    //             'message' => 'Akun Belum Login',
    //             'data' => '',
    //         ];
    //         return $data;
    //     }
    // }
}
