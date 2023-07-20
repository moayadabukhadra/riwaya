<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use DB;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GetBooksData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected string $author_link = '';
    protected array $book = [];
    protected array $author = [];
    protected string $next_page = 'https://foulabook.com/ar/books';
    protected $signature = 'app:get-books-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $number_of_pages = 2071;;
        $client = new Client();
        $book_img = [];
        for ($i = 800; $i < $number_of_pages; $i++) {
            $link = 'https://foulabook.com/ar/books?page=' . $i;
            try {
                $crawler = $client->request('GET', $link);
                $books = $crawler->filter('.related-items');
                $books->filter('li')->each(function ($node) use ($client, $book_img) {
                    $this->book['title'] = $node->filter('h5')->filter('a')->text();
                    if (DB::table('books')->where('title', $this->book['title'])->doesntExist()) {

                        $this->book['url'] = $node->filter('h5')->filter('a')->attr('href');
                        $book_crawler = $client->request('GET', $this->book['url']);
                        $book_img['image'] = $book_crawler->filter('.media-wrap')->filter('img')->attr('src');
                        $book_crawler->filter('.v-list')->filter('li')->each(function ($node) {
                            if ($node->children('i')->attr('class') === 'fa fa-file-text') {
                                $this->book['page_count'] = filter_var($node->text(), FILTER_SANITIZE_NUMBER_INT);
                            }
                            $node->filter('i')->each(function ($node) {
                                if ($node->attr('class') === 'fa fa-sitemap') {
                                    $this->book['category'] = $node->nextAll()->text();
                                }
                                if ($node->attr('class') === 'fa fa-user') {
                                    $this->author_link = $node->nextAll()->filter('a')->attr('href');
                                    $this->author['name'] = $node->nextAll()->filter('a')->text();
                                }
                            });
                        });
                        $this->book['description'] = $book_crawler->filter('.article-body-wrap')->filter('.body-texdt')->filter('p')->each(function ($node) {
                            return $node->text();
                        });
                        unset($this->book['description'][0]);
                        unset($this->book['description'][count($this->book['description'])]);
                        $this->book['description'] = implode(' ', $this->book['description']);
                        $this->book['pdf_file_link'] = $book_crawler->filter('.article-body-wrap')->filter('.row')->filter('a')->each(function ($node) {
                            if (str_contains($node->attr('href'), 'downloading')) {
                                return $node->attr('href');
                            }
                        });

                        if ($this->book['pdf_file_link'] != null) {
                            $this->book['pdf_file'] = implode(' ', $this->book['pdf_file_link']);
                            $file_contents = file_get_contents($this->book['pdf_file']);
                            $this->book['file'] = $this->book['title'] . '.pdf';
                            file_put_contents(storage_path('app/public/books/' . $this->book['file']), $file_contents);
                        }


                        $author_crawler = $client->request('GET', $this->author_link);
                        $author_crawler->filter('.media-wrap')->filter('img')->each(function ($node) {
                            $this->author['img'] = $node->attr('src');
                        });
                        $this->author['bio'] = $author_crawler->filter('.show-less-div')->filter('p')->each(function ($node) {
                            if (!blank($node->text())) {
                                return $node->text();
                            }
                        });
                        $this->author['bio'] = implode('', $this->author['bio']);

                        if (Author::where('name', $this->author['name'])->doesntExist()) {
                            $author = Author::create($this->author);
                            $author_img = [];
                            $author_img['image'] = Image::make($this->author['img']);
                            if ($author_img['image']->mime() === 'image/png') {
                                $author_img['extension'] = 'png';
                            } else {
                                $author_img['extension'] = 'jpg';
                            }
                            $author_img['name'] = Str::random(10) . '.' . $author_img['extension'];
                            $author_img['image']->save(storage_path('app/public/images/' . $author_img['name']));
                            $author->image()->create(
                                [
                                    'name' => $author_img['name'],
                                    'path' => $author_img['name'],
                                ]
                            );

                        } else {
                            $author = Author::where('name', $this->author['name'])->first();
                        }

                        if (Category::where('name', $this->book['category'])->doesntExist()) {
                            $category = Category::create(['name' => $this->book['category']]);
                        } else {
                            $category = Category::where('name', $this->book['category'])->first();
                        }
                        if (!Book::where('title', 'like', '%' . $this->book['title'] . '%')->exists()) {
                            $book = Book::create([
                                'title' => $this->book['title'],
                                'page_count' => $this->book['page_count'],
                                'description' => $this->book['description'],
                                'category_id' => $category->id,
                                'author_id' => $author->id,
                                'file' => $this->book['file'],
                            ]);

                            $book_img['image'] = Image::make($book_img['image']);
                            $book_img['image']->crop($book_img['image']->width(), $book_img['image']->height() - 32, 0, 0)
                                ->insert(public_path('/assets/images/water-mark.png'), 'bottom-right', 10, 10);
                            if ($book_img['image']->mime() === 'image/png') {
                                $book_img['extension'] = 'png';
                            } else {
                                $book_img['extension'] = 'jpg';
                            }
                            $book_img['name'] = Str::random(10) . '.' . $book_img['extension'];
                            $book_img['image']->save(storage_path('app/public/images/' . $book_img['name']));
                            $book->image()->create(
                                [
                                    'name' => $book_img['name'],
                                    'path' => $book_img['name'],
                                ]
                            );
                        }
                    }

                });
                $this->book = [];
                $this->author = [];
            } catch (\Exception $exception) {
                continue;
            }
        }

    }
}
