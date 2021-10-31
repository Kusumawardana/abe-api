<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\dibagikan;
use App\Models\flashcard;
use App\Models\Notification;
use App\Models\Pengguna;
use App\Services\SendOneSignalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class dibagikans extends BaseController
{
    public function create(Request $req)
    {
        $id_flashcard = $req->id_flashcard;
        $id_pengirim = $req->id_pengirim;
        $id_penerima = $req->id_penerima;

        $dibagikan = new dibagikan;
        $dibagikan->id_flashcard = $id_flashcard;
        $dibagikan->id_pengirim = $id_pengirim;
        $dibagikan->id_penerima = $id_penerima;
        $dibagikan->save();

        $flashcard = flashcard::find($id_flashcard);
        $authPengirim = auth::where('id_user', $id_pengirim)->first();
        $penerima = Pengguna::find($id_penerima);
        $pengirim = Pengguna::find($id_pengirim);
        $authPenerima = auth::where('id_user', $id_penerima)->first();

        $notifPengirim = Notification::create([
            'judul' => 'Flashcard Dibagikan',
            'deskripsi' => "Flashcard {$flashcard->judul} behasil dibagikan ke {$penerima->nama}. {$flashcard->deskripsi}",
            'id_user' => $id_pengirim,
            'type' => 'Dibagikan',
            'dibaca' => 0,
            'dilihat' => 0,
        ]);

        $notifPenerima = Notification::create([
            'judul' => 'Flashcard Dibagikan',
            'deskripsi' => "{$pengirim->nama} membagikan flashcard {$flashcard->judul}. {$flashcard->deskripsi}",
            'id_user' => $id_penerima,
            'type' => 'Dibagikan',
            'dibaca' => 0,
            'dilihat' => 0,
        ]);

        if ($authPengirim) {
            SendOneSignalNotification::send($notifPengirim->judul, $notifPengirim->deskripsi, $authPengirim->id_device);
        }

        if ($authPenerima) {
            SendOneSignalNotification::send($notifPenerima->judul, $notifPenerima->deskripsi, $authPenerima->id_device);
        }

        $data = [
            'status' => 'Success',
            'message' => 'Flashcard Telah Di Sampaikan Ke pada pengguna lain',
            'data' => '',
        ];
        return $data;
    }
    public function readpenerima($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = DB::table('flashcard_dibagikan')
                ->select(['flashcard_dibagikan.*', 'users.nama_user AS penerima', 'users.nama AS nama_penerima', 'flashcard.judul AS nama_flashcard', 'flashcard.deskripsi AS deskripsi_flashcard', 'flashcard.attachment AS attachment_flashcard'])
                ->where('id_penerima', '=', $id)
                ->join('flashcard', 'flashcard_dibagikan.id_flashcard', '=', 'flashcard.id')
                ->join('users', 'flashcard_dibagikan.id_penerima', '=', 'users.id')
                ->get();
            foreach ($read as $row) {
                $row->attachment_flashcard = 'http://abe.intiru.com/UploadedFile/flashcard/' . $row->attachment_flashcard;
            }

            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $read,
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
    public function readpengirim($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = DB::table('flashcard_dibagikan')
                ->select(['flashcard_dibagikan.*', 'users.nama_user AS pengirim', 'users.nama AS nama_pengirim', 'flashcard.judul AS nama_flashcard', 'flashcard.deskripsi AS deskripsi_flashcard', 'flashcard.attachment AS attachment_flashcard'])
                ->where('id_pengirim', '=', $id)
                ->join('flashcard', 'flashcard_dibagikan.id_flashcard', '=', 'flashcard.id')
                ->join('users', 'flashcard_dibagikan.id_pengirim', '=', 'users.id')
                ->get();
            foreach ($read as $row) {
                $row->attachment_flashcard = 'http://abe.intiru.com/UploadedFile/flashcard/' . $row->attachment_flashcard;
            }
            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $read,
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
