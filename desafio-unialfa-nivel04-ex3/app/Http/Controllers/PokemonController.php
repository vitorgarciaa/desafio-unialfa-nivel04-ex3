<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function show($pokemon1, $pokemon2)
    {
        
        $pokemon1Dados = Http::withOptions(['verify' => false])->get('https://pokeapi.co/api/v2/pokemon/' . $pokemon1);
        $pokemon2Dados = Http::withOptions(['verify' => false])->get('https://pokeapi.co/api/v2/pokemon/' . $pokemon2);

        $pokemon1Base = $pokemon1Dados->json()['stats'][0]['base_stat'] ?? 0;
        $pokemon2Base = $pokemon2Dados->json()['stats'][0]['base_stat'] ?? 0;
    
        if ($pokemon1Base === $pokemon2Base) {
            return response()->json(['result' => 'os dois tem o mesmo poder, deu empate']);
        }

        $winner = ($pokemon1Base > $pokemon2Base) ? $pokemon1 : $pokemon2;
    
        return response()->json(['winner' => ($winner)]);
    }
    
}
