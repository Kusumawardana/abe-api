<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\respon;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class respons extends BaseController
{
    public function read($id,$perkembangan)
    {
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = respon::where('id_perkembangan', $perkembangan)
                ->with('terapis:id,nama_terapis')
                ->with('orangtua:id,nama_orangtua')
                ->get();
            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $read
            ];
            return $data;
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => ''
            ];
            return $data;
        }
    }
    public function createortu(Request $req){
        $deskripsi = $req->deskripsi;
        $id_user = $req->id_user;
        $id_perkembangan= $req->id_perkembangan;
        $user = Pengguna::where('id',$id_user)->first();

        if (isset($deskripsi)){
            $respon = new respon;
            $respon->deskripsi = $req->deskripsi;
            $respon->id_orang_tua = $user->id_type;
            $respon->id_terapis = 0;
            $respon->id_perkembangan = $req->id_perkembangan;
            $respon->save();
            $data = [
                'status' => 'Success',
                'message' => 'Respon Telah Disampaikan',
                'data' => ''
            ];
            return $data;
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi kolom judul dan deskripsi untuk mengajukan keluhan',
                'data' => ''
            ];
            return $data;
        }
    }
    public function deleteortu($id,$id2){
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $perkembangan = respon::find($id2);
            $perkembangan->delete();

            $data = [
                'status' => 'Success',
                'message' => 'Data Berhasil Di Hapus',
                'data' => ''
            ];
            return $data;
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => ''
            ];
            return $data;
        }



    }
}
