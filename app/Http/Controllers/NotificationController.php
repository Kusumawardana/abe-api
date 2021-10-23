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
            $notifications = Notification::whereIn('id_user', [$id, null])->get();
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

    public function update(Notification $notification, $id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $notification->update(['dibaca' => 1]);
            $data = [
                'status' => 'Success',
                'message' => 'Data Berhasil Diubah',
                'data' => '',
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
}
