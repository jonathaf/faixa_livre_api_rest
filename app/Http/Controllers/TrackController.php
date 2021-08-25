<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\TrackLike;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Retorna todos as faixas cadastradas
     */
    public function index()
    {
        return Track::all();
    }


    /**
     * Adiciona uma nova faixa
     */
    public function store(Request $request)
    {
        $track = new Track();

        $track->name = $request->name;
        $track->duration =  $request->duration;
        $track->album_id =  $request->album_id;
        $track->order = $request->order;

        $track->save();

        return response()->json([
            "message" => "Track successfully added"
        ], 201);
    }


    /**
     * Retorna uma faixa específica
     */
    public function show($id)
    {
        return Track::findOrFail($id);
    }


    /**
     * Edita uma faixa específica
     */
    public function update(Request $request, $id)
    {
        $track = Track::findOrFail($id);
        $track->update($request->all());

        return response()->json([
            "message" => "Track successfully updated"
        ], 200);
    }


    /**
     * Deleta uma faixa específica
     */
    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();   
    }

    /**
     * Adiciona uma track como favorito
     */
    public function addFavorite(Request $request)
    {
        

        $id = $request->all()['id'];

        if(Track::findOrFail($id))
        {
            $inputs['track_id'] = $id;
            $inputs['user_id'] = $request->user()->id;

            $track = TrackLike::select('id')
            ->where('user_id', '=', $inputs['user_id'])
            ->where('track_id', '=', $inputs['track_id'])
            ->count();

            if($track == 0)
            {
                TrackLike::create($inputs);

                return response()->json([
                    "message" => "track added to favorites"
                ], 201);
            }
            else
            {
                return response()->json([
                    "message" => "The track is already a favorite"
                ], 400);
            }
        }

        
    }

    /**
     * Remove uma track de favoritos
     */
    public function removeFavorite(int $id)
    {
        $track = TrackLike::findOrFail($id);
        $track->delete();
    }


    /**
     * Lista as tracks mais adicionadas aos favoritos
     */
    public function favorites()
    {
        return TrackLike::selectRaw("count('id') as total, track_id")
                   ->groupBy('track_id')
                   ->orderByDesc('total')->limit(10)->get();
    }
}
