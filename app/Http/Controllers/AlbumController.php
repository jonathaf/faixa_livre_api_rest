<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumLike as AlbumLike;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Retorna todos os albums cadastrados
     */
    public function index()
    {
        return Album::all();
    }

    /**
     * Adiciona um novo album
     */
    public function store(Request $request)
    {
        Album::create($request->all());

        return response()->json([
            "message" => "Album successfully added"
        ], 201);
    }

    /**
     * Retorna um album específico
     */
    public function show(int $id)
    {
        return Album::findOrFail($id);
    }

    /**
     * Edita um album específico
     */
    public function update(Request $request, int $id)
    {
        $album = Album::findOrFail($id);
        $album->update($request->all());

        return response()->json([
            "message" => "Album successfully updated"
        ], 200);
    }

    /**
     * Remove um album específico
     */
    public function destroy(int $id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
    }

    /**
     * Adiciona uma album como favorito
     */
    public function addFavorite(Request $request)
    {
        

        $id = $request->all()['id'];

        if(Album::findOrFail($id))
        {
            $inputs['album_id'] = $id;
            $inputs['user_id'] = $request->user()->id;

            $album = AlbumLike::select('*')
            ->where('user_id', '=', $inputs['user_id'])
            ->where('album_id', '=', $inputs['album_id'])
            ->count();

            if($album == 0)
            {
                AlbumLike::create($inputs);

                return response()->json([
                    "message" => "Album added to favorites"
                ], 201);
            }
            else
            {
                return response()->json([
                    "message" => "The album is already a favorite"
                ], 400);
            }
        }

        
    }

    /**
     * Remove um album de favoritos
     */
    public function removeFavorite(int $id)
    {
        $album = AlbumLike::findOrFail($id);
        $album->delete();
    }

    /**
     * Lista os albums mais adicionadas aos favoritos
     */
    public function favorites()
    {
        return AlbumLike::selectRaw("count('id') as total, album_id")
                   ->groupBy('album_id')
                   ->orderByDesc('total')->limit(10)->get();
    }
}
