<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\anak;
use App\Models\Pengguna;
use App\Models\memilikiorangtua;
use App\Models\orangtua;
use Laravel\Lumen\Routing\Controller as BaseController;

class anaks extends BaseController
{
    public function readanak($id,$from,$to){
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = anak::skip($from)
                ->take($to)
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
    public function readanaksearch($id,$from,$to,$search){
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = anak::where('nama_anak', 'LIKE', $search.'%')
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
    public function readspesific($id,$from,$to)
    {
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $getuser = Pengguna::where('id',$id)
                ->with('jenispengguna:id,nama')
                ->first();
            if ($getuser->jenispengguna->nama == 'orang tua'){
                $ortu = memilikiorangtua::where('id_orangtua', $getuser->id_type)
                    ->with('anak:id,nama_anak')
                    ->with('orangtua:id,nama_orangtua')
                    ->skip($from)
                    ->take($to)
                    ->get();
                $data = [
                    'status' => 'Success',
                    'message' => 'Data Dapat Di Akses',
                    'data' => $ortu
                ];
                return $data;
            }
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Akun Belum Login',
                'data' => ''
            ];
            return $data;
        }
    }
    public function readspesificsearch($id,$from,$to,$search){
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $getuser = Pengguna::where('id',$id)
                ->with('jenispengguna:id,nama')
                ->first();
            if ($getuser->jenispengguna->nama == 'orang tua'){

                $ortu = memilikiorangtua::where('id_orangtua', $getuser->id_type)
                    ->whereHas('anak', function ($query) use($search){
                        $query->where('nama_anak', 'LIKE',$search.'%');
                    })
                    ->with('anak:id,nama_anak')
                    ->with('orangtua:id,nama_orangtua')
                    ->get();

                $data = [
                    'status' => 'Success',
                    'message' => 'Data Dapat Di Akses',
                    'data' => $ortu
                ];
                return $data;
            }
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
