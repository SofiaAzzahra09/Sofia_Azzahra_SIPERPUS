<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array():array
    {
        $books = Book::all();
        $books_filter = [];
        foreach($books as $key => $book){
            $books_filter[$key]['no'] = $key + 1;
            $books_filter[$key]['judul'] = $book['title'];
            $books_filter[$key]['penulis'] = $book['penulis'];
            $books_filter[$key]['penerbit'] = $book['penerbit'];
            $books_filter[$key]['tahun'] = $book['tahun'];
            $books_filter[$key]['rak'] = $book['bookshelf'] -> name;
        }
        return $books_filter;
    }

    public function headings(): array{
        return [
            'no',
            'judul',
            'penulis',
            'penerbit',
            'tahun',
            'rak'
        ];
    }
}
