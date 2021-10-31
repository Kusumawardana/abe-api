<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\flashcard;
use App\Models\Notification;
use App\Models\Pengguna;
use App\Services\SendOneSignalNotification;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class flashcards extends BaseController
{
    public function read($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function readvalid($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::where('status', '=', 'valid')->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function myread($id, $from, $to)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::where('id_user', $id)
                ->skip($from)
                ->take($to)
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function mydelete($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {

            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Hapus',
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
    public function myreadsearch($id, $search)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::where('id_user', $id)
                ->where('judul', 'LIKE', $search . '%')
                ->orderBy('id', 'DESC')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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

    public function readtype($id, $type, $from, $to)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::where('id_jenis', $type)
                ->where('status', 'valid')
                ->orderBy('id', 'DESC')
                ->skip($from)
                ->take($to)
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function readall($id, $type)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = flashcard::where('id_jenis', $type)
                ->where('status', 'valid')
                ->orderBy('id', 'DESC')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function readtypesearch($from, $to, $id, $search, $type)
    {
        $validation = auth::where('id_user', $id)->count();
        if ($validation >= 1) {
            $read = flashcard::where('id_jenis', $type)->where('judul', 'LIKE', $search . '%')
                ->orderBy('id', 'DESC')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
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
    public function create(Request $req)
    {
        $validation = auth::where('id_user', $req->id_user)->count();

        if ($validation >= 1) {
            $user = Pengguna::where('id', $req->id_user)
                ->with('jenispengguna:id,nama')
                ->first();
            if ($user->jenispengguna->nama == 'orang tua') {
                $flashcard = new flashcard;
                $flashcard->judul = $req->judul;
                $flashcard->deskripsi = $req->deskripsi;
                $flashcard->id_jenis = 1;
                $gambar = $req->file('file');
                $gambar->move(public_path('UploadedFile/flashcard/'), time() . '_' . $gambar->getClientOriginalName());
                $flashcard->attachment = time() . '_' . $gambar->getClientOriginalName();
                $flashcard->status = 'invalid';
                $flashcard->save();
            } elseif ($user->jenispengguna->nama == 'terapis') {

            }
            $data = [
                'status' => 'Success',
                'message' => 'Data Berhasil Di Hapus',
                'data' => $user,
            ];

            $notif = Notification::create([
                'judul' => 'Flashcard',
                'deskripsi' => "Flashcard {$req->judul} ditambahkan. {$req->deskripsi}",
                'type' => 'Flashcard',
                'dibaca' => 0,
                'dilihat' => 0,
            ]);

            SendOneSignalNotification::send($notif->judul, $notif->deskripsi);

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
