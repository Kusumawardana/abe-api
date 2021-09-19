<?php

namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\jenisflashcard;


class jenisflashcards extends BaseController
{
    public function read($id)
    {
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = jenisflashcard::where('nama','!=','orang tua')
                ->where('nama','!=','terapis')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/jenisflashcard/'.$read[$i]['attachment'];
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
    public function readex($id)
    {
        $validation = auth::where('id_user',$id)->count();

        if ($validation >= 1){
            $read = jenisflashcard::where('nama','!=','orang tua')
                ->where('nama','!=','terapis')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/jenisflashcard/'.$read[$i]['attachment'];
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
    public function search($id,$search)
    {
        $validation = auth::where('id_user',$id)->count();
        if ($validation >= 1){
            $read = jenisflashcard::where('nama', 'LIKE', $search.'%')
                ->orderBy('id', 'DESC')
                ->get();
            $readcount = count($read);
            for ($i = 0; $i < $readcount; $i++){
                $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/jenisflashcard/'.$read[$i]['attachment'];
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
