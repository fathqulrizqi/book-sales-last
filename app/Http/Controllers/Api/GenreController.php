<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
      $genres = Genre::all();

      if($genres->isEmpty()) {
        return response()->json([
          "success" => true,
          "message" => "Resource data not found!"
        ], 200);
      }

      return response()->json([
        "success" => true,
        "message" => "Get All Resource",
        "data" => $genres
      ], 200);
    }

    public function store(Request $request) {
      // membuat validasi
      $validator = Validator::make($request->all(), [
        "name" => "required|string",
        "description" => "required|string"
      ]);

      // melakukan cek data yang bermasalah
      if ($validator->fails()){
        return response()->json([
          "success" => false,
          "message" => $validator->errors()
        ], 422);
      }

      // membuat data genre
      $genre = Genre::create([
        "name" => $request->name,
        "description" => $request->description
      ]);
      
      // memberi pesan berhasil
      return response()->json([
        "success" => true,
        "message" => "Resource added successfully!",
        "data" => $genre
      ], 201);
    }
}
