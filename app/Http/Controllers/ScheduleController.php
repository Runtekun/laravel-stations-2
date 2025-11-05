<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Movie;
use Carbon\CarbonImmutable;

class ScheduleController extends Controller
{
    // スケジュール一覧表示 GET /admin/schedules
    public function index()
    {
        // スケジュールが存在する映画だけ取得
        $movies = Movie::has('schedules')->with('schedules')->get();
        return view('admin.schedules.index', compact('movies'));
    }

    // スケジュール詳細 GET /admin/schedules/{id}
    public function show($id)
    {
        $schedule = Schedule::with('movie')->findOrFail($id);
        return view('admin.schedules.show', compact('schedule'));
    }

    // 新規作成フォーム GET /admin/movies/{id}/schedules/create
    public function create($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.schedules.create', compact('movie'));
    }

    // スケジュール保存 POST /admin/movies/{id}/schedules/store
     public function store(Request $request, $id)
    {

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
    ]);

        $start_time = date('Y-m-d H:i:s', strtotime("{$validated['start_time_date']} {$validated['start_time_time']}"));
        $end_time = date('Y-m-d H:i:s', strtotime("{$validated['end_time_date']} {$validated['end_time_time']}"));

        Schedule::create([
           'movie_id' => $validated['movie_id'],
           'start_time' => $start_time,
           'end_time' => $end_time,  
    ]);

    return redirect()
        ->route('admin.movies.show', $validated['movie_id'])
        ->with('success', 'スケジュールを追加しました');
    }

    // 編集フォーム GET /admin/schedules/{scheduleId}/edit
    public function edit($scheduleId)
    {
        $schedule = Schedule::with('movie')->findOrFail($scheduleId);
        return view('admin.schedules.edit', compact('schedule'));
    }

    // 更新 PATCH /admin/schedules/{id}/update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        $start_time = CarbonImmutable::createFromFormat('Y-m-d H:i', "{$validated['start_time_date']} {$validated['start_time_time']}");
        $end_time   = CarbonImmutable::createFromFormat('Y-m-d H:i', "{$validated['end_time_date']} {$validated['end_time_time']}");

        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'movie_id' => $validated['movie_id'],
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return redirect()->route('admin.schedules.show', $id)
                         ->with('success', 'スケジュールを更新しました');
    }

    // 削除 DELETE /admin/schedules/{scheduleId}/destroy
    public function destroy($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $movieId = $schedule->movie_id;
        $schedule->delete();

        return redirect()->route('admin.movies.show', $movieId)
                         ->with('success', 'スケジュールを削除しました');
    }
}