<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\Notification;
use App\Models\perbedaan;
use App\Services\SendOneSignalNotification;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Lumen\Routing\Controller as BaseController;

class perbedaans extends BaseController
{
    public function readadmin($id)
    {
        $validation = auth::where('id_user', $id)->count();

        if ($validation >= 1) {
            $read = perbedaan::where('id_jenispengguna', '=', 2)->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment1'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $read[$i]['attachment1'];
            }
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment2'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $read[$i]['attachment2'];
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
    public function myread($id)
    {
        $validation = auth::where('id_user', $id)->count();
        if ($validation >= 1) {
            $read = perbedaan::where('id_user', '=', $id)->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment1'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $read[$i]['attachment1'];
            }
            for ($i = 0; $i < $readcount; $i++) {
                $read[$i]['attachment2'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $read[$i]['attachment2'];
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
    public function getComparison(Request $request, $perbedaanId, $id)
    {
        $validation = auth::where('id_user', $id)->count(); //ngikutin yg diatas, entah kenapa buat kyk gini authnya .-.)?
        $mustGetSameId = Faker::create()->boolean(); //change dapetin yang sama 50:50
        $comparison = new perbedaan();
        if ($validation >= 1) {
            if ($mustGetSameId) {
                $comparison = $comparison->find($perbedaanId);
            } else {
                $comparison = $comparison->where('id', '!=', $perbedaanId);
                if ($request->filled('is_admin') && $request->is_admin) {
                    $comparison = $comparison->where('id_jenispengguna', 2);
                } else {
                    $comparison = $comparison->where('id_user', $id);
                }
                $comparison = $comparison->inRandomOrder()->take(1)->first();
            }
            $comparison['attachment1'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $comparison['attachment1'];
            $comparison['attachment2'] = 'http://abe.intiru.com/UploadedFile/perbedaan/' . $comparison['attachment2'];

            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $comparison,
            ];
            return $data;
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => '',
            ];
            return response($data, 403);
        }
    }

    public function notifyAnswer(Request $request, $perbedaanId, $comparisonId, $id)
    {
        $validation = auth::where('id_user', $id)->latest()->first();
        $perbedaan = perbedaan::find($perbedaanId);
        $comparison = perbedaan::find($comparisonId);
        if ($validation !== null) {
            $notif = Notification::create([
                'judul' => 'Hasil Jawaban Bedakan Gambar',
                'deskripsi' => ('Menjawab dengan ' . $request->answer . ', ' . $perbedaan->judul . ($perbedaanId !== $comparisonId ? ' tidak ' : ' ') . 'sama dengan ' . $comparison->judul),
                'dilihat' => 0,
                'dibaca' => 0,
                'id_user' => $id,
                'type' => 'Bedakan Gambar',
            ]);

            SendOneSignalNotification::send($notif->judul, $notif->deskripsi, $validation->id_device);

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
