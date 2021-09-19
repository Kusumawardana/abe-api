<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\perbedaan;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class perbedaans extends BaseController
{
    public function readadmin($id)
    {
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = perbedaan::where('id_jenispengguna','=',2)->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment1'] = 'http://abe.intiru.com/UploadedFile/perbedaan/'.$read[$i]['attachment1'];
            }
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment2'] = 'http://abe.intiru.com/UploadedFile/perbedaan/'.$read[$i]['attachment2'];
            }
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
    public function myread($id){
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $read = perbedaan::where('id_user','=',$id)->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment1'] = 'http://abe.intiru.com/UploadedFile/perbedaan/'.$read[$i]['attachment1'];
            }
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment2'] = 'http://abe.intiru.com/UploadedFile/perbedaan/'.$read[$i]['attachment2'];
            }
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
}
