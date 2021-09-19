<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Pengguna;
use App\Models\jenispengguna;
use App\Models\orangtua;
use App\Models\terapis;
use App\Models\auth;

class Login extends BaseController
{
    public function index()
    {
        return "Selamat Datang di API ABE";
    }
    public function profile($id)
    {
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $getuser = Pengguna::where('id','=',$id)
                ->with('jenispengguna:id,nama')
                ->first();
            if ($getuser->jenispengguna->nama == 'terapis'){
                $type = terapis::where('id','=',$getuser->id_type)->get();
                $getuser->type = $type;
            }elseif ($getuser->jenispengguna->nama == 'orang tua'){
                $type = orangtua::where('id','=',$getuser->id_type)->get();
                $getuser->type = $type;
            }
            $data = [
                'status' => 'Success',
                'message' => 'Data Dapat Di Akses',
                'data' => $getuser
            ];
            return $data;
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Sepertinya anda telah log out',
            ];
            return $data;
        }
    }
    public function proseslogin(Request $req){
        $username = $req->username;
        $password = md5($req->password);
        $device = $req->device;

        $validation = Pengguna::where('nama_user',$username)
            ->where('password', $password)
            ->count();

        if ($validation == 1){
            $getuser = Pengguna::where('nama_user',$username)
                ->where('password', $password)
                ->with('jenispengguna:id,nama')
                ->first();
            $getauth = auth::where('id_user',$getuser->id)
                ->count();
            if ($getauth == 0 ){
                if ($getuser->isactive == 'iya'){
                  if ($getuser->jenispengguna->nama != 'admin'){
                      $auth = new auth;
                      $auth->nama = $getuser->nama_user;
                      $auth->token = $getuser->password;
                      $auth->id_user = $getuser->id;
                      $auth->id_device = $device;

                      $auth->save();
                      $data = [
                          'status' => 'Success',
                          'message' => 'Berhasil Login',
                          'data' => $getuser
                      ];
                      return $data;
                  }else{
                      $data = [
                          'status' => 'Error',
                          'message' => 'Akun Admin Hanya dapat diakses Melalui Website',
                          'data' => ''
                      ];
                      return $data;
                  }
                }else{
                    $data = [
                        'status' => 'Error',
                        'message' => 'Akun Anda Sedang Di nonaktifkan hubungi admin untuk aktivasi kembali',
                        'data' => ''
                    ];
                    return $data;
                }
            }else{
                $data = [
                    'status' => 'Error',
                    'message' => 'Akun Anda Sedang Aktif di perangkat lainnya',
                    'data' => ''
                ];
                return $data;
            }
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Nama Atau Password Salah',
                'data' => ''
            ];
            return $data;
        }
    }
    public function logout(Request $req){
        $logout = auth::where('id_user', $req->id)->delete();
        $data = [
            'status' => 'Success',
            'message' => 'Logout Berhasil',
            'data' => ''
        ];
        return $data;
    }
}
