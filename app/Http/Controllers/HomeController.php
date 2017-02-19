<?php

namespace App\Http\Controllers;

use App;
use App\Repositories\BookRepository;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $shelves;
    protected $users;
    protected $books;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $shelves, UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => [
            'index',
            'faq',
            'search'
        ]]);
        $this->shelves = $shelves;
        $this->users = $users;
        $this->books = $books;
    }

    public function index()
    {

        $topics = [];
        $shelves = $this->shelves->ourPicks();
        $favoriteBooks = $this->books->getFavorites();
        $featuredBooks = $this->books->getFeatured();
        return view('home', [
            'shelves' => $shelves->toArray(),
            'topics' => $topics,
            'books' => json_encode($favoriteBooks),
            'featuredBooks' => json_encode($featuredBooks)
        ]);
    }

    public function faq()
    {
        return view('static.about');
    }

    public function welcome(Request $request)
    {
        return view('welcome', ['user' => $request->user()]);
    }

    public function landing()
    {
        return view('landing');
    }
}
