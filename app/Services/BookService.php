<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\FileRepository;
use App\Repositories\GenreRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookService extends BaseService
{
    private BookRepository $repository;
    private AuthorRepository $authorRepository;
    private GenreRepository $genreRepository;

    public function __construct() {
        $this->repository = new BookRepository();
        $this->authorRepository = new AuthorRepository();
        $this->genreRepository = new GenreRepository();
    }

    private function authorsString($book)
    {
        $authors = "";
        foreach ($book->authors as $author) {
            $authors .= $author->name.' '.$author->surname.', ';
        }
        return substr($authors, 0, -2);
    }

    public static function languages($book)
    {
        $languages = "";
        foreach ($book->files as $file) {
            if ($file->file_type != 'аудио') {
                $languages .= $file->file_type.', ';
            }
        }
        return substr($languages, 0, -2);
    }

    public static function genresString($book)
    {
        $genres = "";
        foreach ($book->genres as $genre) {
            $genres .= $genre->name.', ';
        }
        return substr($genres, 0, -2);
    }

    public function info(string $slug)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $authorsIds = [];
        foreach ($book->authors as $author) {
            $authorsIds[] = $author->id;
        }
        $authorBooks = $this->repository->authorsOtherBooks($book->id, $authorsIds);

        $audio = $this->repository->getAudio($book);

        $audioarr = array();
        foreach ($audio as $file)
        {
            $audioData = [
                'name' => $book->name,
                'artist' => $this->authorsString($book),
                'album' => 'bum bum',
                'url' => url($file->path),
                'cover_art_url' => url($book->cover_path),
            ];
            array_push($audioarr, $audioData);
        }
        $data = [
            'authors_books' => $authorBooks,
            'book' => $book,
            'audio' => $audioarr,
        ];
        return $data;
    }

    public function prepareRedact(string $slug = null)
    {
        $book = null;
        $authors = null;
        $genres = null;
        $subRepo = new SubscriptionRepository();
        if ($slug != null) {
            $book = $this->repository->bookBySlug($slug);
            if (!$book) {
                return $this->errNotFound('Книга не найдена');
            }

            $authors = $this->authorsString($book);
            $genres = $this->genresString($book);
        }
        $data = [
            'book' => $book,
            'subs' => $subRepo->index(),
            'authors' => $authors,
            'genres' => $genres,
        ];

        return $data;
    }

    public function create(array $data)
    {
        $result = false;
        $user = Auth::guard('web-user')->user();
        if (!$user?->admin) {
            return $this->errFobidden('В доступе отказано');
        }

        $data['slug'] = str_replace(' ', '-', $data['name']).date('-Y-m-d-h-i-sa');
        if(isset($data['cover'])) {
            $path = $data['cover']->store('public/book/'.$data['slug'].'/cover');
            $data['cover_path'] = Storage::url($path);
        }

        $path = $data['text_file']->store('public/book/'.$data['slug'].'/text');
        $fileArr = file($data['text_file']);
        $lines = count($fileArr);
        $data['pages_count'] = round((float) $lines / 20);

        $book = $this->repository->create($data);
        File::create([
            'book_id' => $book->id,
            'file_type' => 'русский',
            'path' => Storage::url($path),
        ]);

        $authors = array();
        foreach(explode(",", $data['authors']) as $author)
        {
            $authorRaw = explode(' ', trim($author));
            $authorEdited = [
                'name' => $authorRaw[0],
                'surname' => $authorRaw[1]
            ];
            array_push($authors, $authorEdited);
        }
        $authorsIds = $this->authorRepository->getIds($authors);
        $book->authors()->attach($authorsIds);

        $genres = array();
        foreach (explode(',', $data['genres']) as $genre) {
            array_push($genres, trim($genre));
        }
        $genresIds = $this->genreRepository->getIds($genres);
        $book->genres()->attach($genresIds);

        $result = true;
        return $result;
    }

    public function update(array $data)
    {
        $user = Auth::guard('web-user')->user();
        if (!$user?->admin) {
            return $this->errFobidden('В доступе отказано');
        }

        $book = $this->repository->bookById($data['id']);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        if ($data['name'] != $book->name) {
            $data['slug'] = str_replace(' ', '-', $data['name']).date('-Y-m-d-h-i-sa');
        }

        if(isset($data['cover'])) {
            $path = $data['cover']->store('public/book/'.$data['slug'].'/cover');
            $data['cover_path'] = Storage::url($path);
        }

        if(isset($data['text_file'])) {
            File::where('book_id', $book->id)
            ->where('file_type', 'русский')
            ->first()
            ->delete();

            $path = $data['text_file']->store('public/book/'.$data['slug'].'/text');
            $fileArr = file($data['text_file']);
            $lines = count($fileArr);
            $data['pages_count'] = round((float) $lines / 20);

            File::create([
                'book_id' => $book->id,
                'file_type' => 'русский',
                'path' => Storage::url($path),
            ]);
        }

        $book->update($data);

        if (isset($data['authors'])) {
            $authors = array();
            foreach(explode(",", $data['authors']) as $author) {
                $authorRaw = explode(' ', trim($author));
                $authorEdited = [
                    'name' => $authorRaw[0],
                    'surname' => $authorRaw[1]
                ];
                array_push($authors, $authorEdited);
            }
            $authorsIds = $this->authorRepository->getIds($authors);
            $book->authors()->detach();
            $book->authors()->attach($authorsIds);
        }

        if (isset($data['genres'])) {
            $genres = array();
            foreach (explode(',', $data['genres']) as $genre) {
                array_push($genres, trim($genre));
            }
            $genresIds = $this->genreRepository->getIds($genres);
            $book->genres()->detach();
            $book->genres()->attach($genresIds);

        }

        return true;
    }

    public function read(string $slug, int $page = 1, string $type = 'русский', bool $fragment = false)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $user = Auth::guard('web-user')->user();
        if (!$user) {
            $page = 1;
            $type = 'русский';
            $fragment = true;
        }
        else if($user->subscription_id < $book->subscription_id && $user->admin == null) {
            $page = 1;
            $type = 'русский';
            $fragment = true;
        }

        if ($type != 'русский') {
            $fragment = false;
        }
        if ($fragment) {
            $page = 1;
        }

        $content = array();
        $file = fopen(url($book->files()->where('file_type', $type)->first()->path), 'r');
        $fileArr = file(stream_get_meta_data($file)['uri'], FILE_SKIP_EMPTY_LINES) or exit("Unable to open file!");
        fclose($file);

        $lineCount = count($fileArr);
        $pageCount = round((float) $lineCount / 20);

        for ($i = ($page - 1) * 20; $i < $page * 20 && $i < $lineCount; $i++) {
            array_push($content, $fileArr[$i]);
        }

        if ($page + 7 > $pageCount) $pages_start = $pageCount - 8;
        else $pages_start = $page - 3 > 0 ? $page - 3 : ($page - 2 > 0 ? $page - 2 : ($page - 1 > 0 ? $page - 1 : $page));

        if ($page > 0 && $page < 4) $pages_end = 7;
        else $pages_end = $page + 3 < $pageCount ? $page + 3 : ($page + 2 < $pageCount ? $page + 2 : ($page + 1 < $pageCount ? $page + 1 : $page));

        $data = [
            'title' => $book->name,
            'fragment' => $fragment,
            'content' => $content,
            'page_count' => $pageCount,
            'cur_page' => $page,
            'start' => $pages_start,
            'end' => $pages_end,
            'slug' => $slug,
        ];
        return $data;
    }

    public function delete(int $id)
    {
        $book = $this->repository->bookById($id);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $book->delete();
        return true;
    }

    public function editFiles(string $slug, array $data)
    {
        $user = Auth::guard('web-user')->user();
        if (!$user?->admin) {
            return $this->errFobidden('В доступе отказано');
        }

        if(count($data['files']) != count($data['types'])) {
            return $this->errService("Недостаточно данных");
        }

        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        for($i = 0; $i < count($data['files']); $i++)
        {
            $file = File::where('book_id', $book->id)
            ->where('file_type', $data['types'][$i])
            ->first();

            if ($file) {
                return $this->errService('Файл с таким типом уже существует');
            }

            $path = "";
            if ($data['types'][$i] == 'аудио') {
                $path = $data['files'][$i]->store('public/book/'.$slug.'/audio');
            }
            else {
                $path = $data['files'][$i]->store('public/book/'.$slug.'/text');
            }

            File::create([
                'book_id' => $book->id,
                'file_type' => $data['types'][$i],
                'path' => Storage::url($path),
            ]);
        }

        return true;
    }

    public function removeFiles(int $fileId)
    {
        $file = File::find($fileId);
        if (!$file) {
            return $this->errNotFound('Файл не найден');
        }

        $file->delete();
        return true;
    }

    public function prepareControl(string $slug)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $data = [
            'book' => $book
        ];
        return $data;
    }
}
