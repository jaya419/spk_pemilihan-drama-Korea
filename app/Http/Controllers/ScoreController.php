<?php

namespace App\Http\Controllers;

use App\Models\Drama;
use App\Models\Genre;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $dramas = Drama::all();
        $genres = Genre::all();
        $scores = Score::all()->keyBy(function ($item) {
            return $item->drama_id . '-' . $item->genre_id;
        });

        return view('score.index', compact('dramas', 'genres', 'scores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'drama_ids' => 'required|array',
            'drama_ids.*' => 'exists:dramas,id',
            'value' => 'required|array',
            'value.*' => 'array',
            'value.*.*' => 'required|integer|min:0|max:100',
        ]);

        foreach ($request->drama_ids as $drama_id) {
            foreach ($request->value[$drama_id] as $genre_id => $val) {
                Score::updateOrCreate(
                    [
                        'drama_id' => $drama_id,
                        'genre_id' => $genre_id,
                    ],
                    [
                        'skor' => $val,
                    ]
                );
            }
        }

        return redirect()->route('score.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function calculateSAW()
    {
        $dramas = Drama::all();
        $genres = Genre::all();

        if ($dramas->isEmpty() || $genres->isEmpty() || Score::count() === 0) {
            $results = [];
            return view('result.index', compact('results'));
        }

        $results = [];

        foreach ($dramas as $drama) {
            $total = 0;

            foreach ($genres as $genre) {
                $score = Score::where('drama_id', $drama->id)
                              ->where('genre_id', $genre->id)
                              ->first();

                $value = $score ? $score->skor : 0;

                if ($genre->tipe === 'benefit') {
                    $max = Score::where('genre_id', $genre->id)->max('skor') ?: 1;
                    $normalized = $max > 0 ? $value / $max : 0;
                } else {
                    $min = Score::where('genre_id', $genre->id)->min('skor') ?: 1;
                    $normalized = $value > 0 ? $min / $value : 0;
                }

                $weight = $genre->bobot;
                $total += $normalized * $weight;
            }

            $results[] = [
                'drama' => $drama->nama_drama,
                'score' => round($total * 100, 2),
            ];
        }

        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return view('result.index', compact('results'));
    }

    public function dashboard()
    {
        $dramaCount = Drama::count();
        $genreCount = Genre::count();
        $scoreCount = Score::count();

        $latestScore = Score::latest()->first();
        $latestGenre = Genre::latest()->first();
        $latestDrama = Drama::latest()->first();

        $dramas = Drama::all();
        $genres = Genre::all();
        $sawResults = [];

        if ($dramas->isNotEmpty() && $genres->isNotEmpty()) {
            foreach ($dramas as $drama) {
                $total = 0;
                foreach ($genres as $genre) {
                    $score = Score::where('drama_id', $drama->id)
                                  ->where('genre_id', $genre->id)
                                  ->first();

                    $value = $score ? $score->skor : 0;

                    $max = Score::where('genre_id', $genre->id)->max('skor') ?: 1;
                    $min = Score::where('genre_id', $genre->id)->min('skor') ?: 1;

                    if ($genre->tipe === 'benefit') {
                        $normalized = $max > 0 ? $value / $max : 0;
                    } else {
                        $normalized = $value > 0 ? $min / $value : 0;
                    }

                    $weight = $genre->bobot;
                    $total += $normalized * $weight;
                }

                $sawResults[] = [
                    'drama' => $drama->nama_drama,
                    'score' => round($total * 100, 2),
                ];
            }

            usort($sawResults, fn($a, $b) => $b['score'] <=> $a['score']);
        }

        $top3RankedDramas = array_slice($sawResults, 0, 3);
        $newlyAddedDramas = Drama::latest()->take(3)->get();

        return view('dashboard.index', compact(
            'dramaCount', 'genreCount', 'scoreCount',
            'latestScore', 'latestGenre', 'latestDrama',
            'top3RankedDramas', 'newlyAddedDramas'
        ));
    }
}
