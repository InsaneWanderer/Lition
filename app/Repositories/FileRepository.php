<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function getBookFile(int $bookId, string $type = "ru")
    {
        return File::where('book_id', $bookId)
            ->where('file_type', $type)
            ->first();
    }
}
