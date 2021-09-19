<?php

namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\berita;
use Illuminate\Support\Facades\DB;



class beritas extends BaseController
{
    public function read($from,$to,$id)
    {

        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = berita::orderBy('id', 'DESC')->skip($from)->take($to)->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/berita/'.$read[$i]['attachment'];
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
    public function search($from,$to,$id,$search)
    {
        $validation = auth::where('id_user',$id)->count();
            if ($validation >= 1){
                $read = berita::where('judul', 'LIKE', $search.'%')
                    ->get();
                $readcount = count($read);
                for ($i = 0; $i < $readcount; $i++){
                    $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/berita/'.$read[$i]['attachment'];
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
