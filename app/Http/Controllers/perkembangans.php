<?php

namespace App\Http\Controllers;

use App\Models\anak;
use App\Models\auth;
use App\Models\Notification;
use App\Models\perkembangan;
use App\Models\terapis;
use App\Services\SendOneSignalNotification;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class perkembangans extends BaseController
{

    public function readanak($from, $to, $id, $anak)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = perkembangan::
                with('anak:id,nama_anak')
                ->whereHas('anak', function ($query) use ($anak) {
                    $query->where('id', $anak);
                })
                ->with('terapis:id,nama_terapis')
                ->orderBy('id', 'DESC')
                ->skip($from)
                ->take($to)
                ->get();
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
    public function readanaksearch($from, $to, $id, $anak, $search)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = perkembangan::where('judul', 'LIKE', $search . '%')
                ->with('anak:id,nama_anak')
                ->whereHas('anak', function ($query) use ($anak) {
                    $query->where('id', $anak);
                })
                ->with('terapis:id,nama_terapis')
                ->get();
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
        $judul = $req->judul;
        $deskripsi = $req->deskripsi;
        $id_terapis = $req->id_terapis;
        $id_anak = $req->id_anak;

        if (isset($judul) || isset($deskripsi)) {
            $perkembangan = new perkembangan;
            $perkembangan->judul = $judul;
            $perkembangan->deskripsi = $deskripsi;
            $perkembangan->id_terapis = $id_terapis;
            $perkembangan->id_anak = $id_anak;
            $perkembangan->save();

            $anak = anak::find($id_anak);
            $terapis = terapis::find($id_terapis);

            $notif = Notification::create([
                'judul' => 'Laporan perkembangan anak',
                'deskripsi' => "Laporan {$anak->nama_anak} oleh {$terapis->nama_terapis}. {$deskripsi}",
            ]);

            SendOneSignalNotification::send($notif->judul, $notif->deskripsi);

            $data = [
                'status' => 'Success',
                'message' => 'Laporan Perkembangan Telah Terkirim',
                'data' => '',
            ];
            return $data;
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi kolom judul atau deskripsi untuk mengajukan keluhan',
                'data' => '',
            ];
            return $data;
        }
    }
    public function delete($id, $item)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $perkembangan = perkembangan::find($item);
            $perkembangan->delete();
            $data = [
                'status' => 'Success',
                'message' => 'Data Berhasil Di Hapus',
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
