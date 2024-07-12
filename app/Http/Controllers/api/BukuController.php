<?php

namespace App\Http\Controllers\api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Buku::orderBy('tajuk','asc')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Data Found',
            'data'=>$data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $dataBuku=new Buku;

        $rules=[
            'tajuk'=>'required',
            'tarikh_dikeluarkan'=>'required|date',
        ];

        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal Masuk',
                'data'=>$validator->errors()
          ]);
        }

      $dataBuku->tajuk=$request->tajuk;
      $dataBuku->penulis=$request->penulis;
      $dataBuku->tarikh_dikeluarkan=$request->tarikh_dikeluarkan;
      $post=$dataBuku->save();

      return response()->json([
            'status'=>true,
            'message'=>'Berjaya masukkan data'
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $data=Buku::find($id);
      if($data){
        return response()->json([
            'status'=>true,
            'message'=>'Data Ditemui',
            'data'=>$data
        ],200);
      }
      else{

            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemui',

            ]);

      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataBuku= Buku::find($id);

        $rules=[
            'tajuk'=>'required',
            'tarikh_dikeluarkan'=>'required|date',
        ];

        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal  Masukkan data',
                'data'=>$validator->errors()
          ]);
        }

      $dataBuku->tajuk=$request->tajuk;
      $dataBuku->penulis=$request->penulis;
      $dataBuku->tarikh_dikeluarkan=$request->tarikh_dikeluarkan;
      $post=$dataBuku->save();

      return response()->json([
            'status'=>true,
            'message'=>'Berjaya kemaskini data'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $dataBuku= Buku::find($id);

      if(empty($dataBuku)){
        return response()->json([
            'status'=>false,
            'message'=>'Tidak dijumpai'
        ],404);
      }

      $post=$dataBuku->delete();

      return response()->json([
            'status'=>true,
            'message'=>'Berjaya Buang data'
      ]);
    }
}
