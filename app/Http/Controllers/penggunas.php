<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenispengguna;
use App\Models\Pengguna;
use App\Models\auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class penggunas extends BaseController
{
    public function read($id,$jenis)
    {
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $read = Pengguna::where('id_jenispengguna', $jenis)->where('id','!=',$id)->get();
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
