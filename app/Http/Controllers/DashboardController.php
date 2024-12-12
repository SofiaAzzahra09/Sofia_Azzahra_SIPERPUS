<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();

        return view('dashboard', compact('bookCount'));
    }

}
