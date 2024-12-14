<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data['books'] = Book::with('bookshelf')->get();
       return view('books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name','id');
        return view('books.create', $data);
        // return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|max:2077',
            'publisher' => 'required|max:255',
            'city' => 'required|max:50',
            'cover' => 'nullable',
            'bookshelf_id' => 'required',
        ]);
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('cover_buku', 'public');
           
            $validated['cover'] = basename($path);
        }
        Book::create($validated);
        $notification =  array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );
        if($request->save == true){
            return redirect()->route('book')->with($notification);
        } else {
            return redirect()->route('book.create')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    public function edit(string $id){
        $data['book'] = Book::findOrFail($id);
        $data['bookshelves'] = Bookshelf::pluck('name','id');
        return view('books.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    public function update(Request $request, string $id){
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|max:2077',
            'publisher' => 'required|max:255',
            'city' => 'required|max:50',
            'cover' => 'nullable',
            'bookshelf_id' => 'required',
        ]);
        if ($request->hasFile('cover')) {
            if($book->cover != null){
                Storage::delete('public/cover_buku/'.$request->old_cover);
            }
            $path = $request->file('cover')->store('cover_buku', 'public');
           
            $validated['cover'] = basename($path);
        }
        $book->update($validated);
        $notification =  array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('book')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if($book->cover != null){
            Storage::delete('public/cover_buku/' .$book->cover);
        }
        $book->delete();
        $notification =  array(
            'message' => 'Data buku berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('book')->with($notification);
    }

    public function print(){
        $data['books'] = Book::with('bookshelf')->get();
        $pdf = Pdf::loadView('books.print', $data);
        return $pdf->download('books.pdf');
    }

    public function export(){
        return Excel::download(new BooksExport, 'books.xlsx');
    }
}