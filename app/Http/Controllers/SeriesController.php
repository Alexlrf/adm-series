<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SeriesFormRequest;
use DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $request->session()->forget('mensagem.sucesso');
        $series = Serie::all();

        return view('series.index')
                ->with('series', $series)
                ->with('mensagemSucesso', $mensagemSucesso);

    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());

        return redirect()
            ->route('series.index')
            ->with('mensagem.sucesso', "Série [ $serie->nome ] adicionada com sucesso!");;
    }

    public function destroy(Serie $series)
    {
        $series->delete();

        return redirect()
            ->route('series.index')
            ->with('mensagem.sucesso', "Série [ $series->nome ] removida com sucesso!");
    }

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        
        return redirect()
            ->route('series.index')
            ->with('mensagem.sucesso', "Série [ $series->nome ] atualizada com sucesso!");

    }
}
