<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() {
      $books = Book::all();
      return response()->json($books);
    }

    public function store(Request $request) {
      // 1. validator
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'bio' => 'nullable|string',
        'genre_id' => 'required|exists:genres,id',
        'author_id' => 'required|exists:authors,id'
      ]);

    }
}
