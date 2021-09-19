<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenispengguna;
use App\Models\Pengguna;
use App\Models\auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class jenispenggunas extends BaseController
{
    public function read($id)
    {
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $read = jenispengguna::where('id','!=', 2)->get();
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
