<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $is_showing = $request->input('is_showing');
        $movies = Movie::query();
        if ($keyword) {
            $movies->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($is_showing === '0' || $is_showing === '1') {
            $movies->where('is_showing', $is_showing);
        }

        $movies = $movies->paginate(20);

        return view('movies.index', ['movies' => $movies]);

        
    }

    public function indexAdmin()
    {
        $movies = Movie::all();
        return view('admin.movies.index', ['movies' => $movies]);
    }

     public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required|string',
            'is_showing' => 'required|boolean',
            'genre' => 'required|string',
        ]);

        DB::transaction(function () use ($validated) {
        // ジャンル取得または作成
        $genre = Genre::firstOrCreate(['name' => $validated['genre']]);
        

        $movie = new Movie();
        $movie->title = $validated['title'];
        $movie->image_url = $validated['image_url'];
        $movie->published_year = $validated['published_year'];
        $movie->description = $validated['description'];
        $movie->is_showing = $validated['is_showing'];
        $movie->genre_id = $genre->id;
        $movie->save();
        });

        return redirect()->route('admin.movies.index');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:movies,title,' . $id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required|string',
            'is_showing' => 'required|boolean',
            'genre' => 'required|string',
        ]);

        DB::transaction(function () use ($validated, $id) {

        $movie = Movie::findOrFail($id);
        $genre = Genre::firstOrCreate(['name' => $validated['genre']]);

        $movie->title = $validated['title'];
        $movie->image_url = $validated['image_url'];
        $movie->published_year = $validated['published_year'];
        $movie->description = $validated['description'];
        $movie->is_showing = $validated['is_showing'];
        $movie->genre_id = $genre->id;
        $movie->save();
        });

        return redirect()->route('admin.movies.index');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index');
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        $schedules = Schedule::where('movie_id', $id)
        ->orderBy('start_time', 'asc')
        ->get();
        return view('movies.show', compact('movie', 'schedules'));
    }

    public function showAdmin($id)
    {
        $movie = Movie::findOrFail($id);

        $schedules = Schedule::where('movie_id', $id)
        ->orderBy('start_time', 'asc')
        ->get();
        return view('admin.movies.show', compact('movie', 'schedules'));
    }
}
