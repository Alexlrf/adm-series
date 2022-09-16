<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index()
    {
        // Jeito escrevendo Query na mão, sem usar o Eloquent
        // $series = DB::select('select nome from series;');
        // dd($series);
        // return view('series.index')->with('series', $series);

        // $series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();
        return view('series.index')->with('series', $series);

    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        // Jeito escrevendo Query na mão, sem usar o Eloquent
        // $nome = $request->input('nome');
        // DB::insert('insert into series (nome) values (?)', [$nome]);
        // return redirect('/series');

        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();
        return redirect('/series');
    }
}
