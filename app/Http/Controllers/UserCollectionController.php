<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserCollectionController extends Controller
{
    public function showCollection(User $user)
    {
        $user->load('media');

        return new UserResource($user);
    }

    public function addToCollection(Request $request, User $user)
    {
        $validated = $request->validate([
            'media_id' => 'required|exists:media,id',
        ], [
            'media_id.required' => 'ID media wajib diisi.',
            'media_id.exists' => 'Media tidak ditemukan.',
        ]);

        if ($user->media()->where('media_id', $validated['media_id'])->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi pengguna',
            ], 409);
        }

        $user->media()->attach($validated['media_id']);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
        ], 201);
    }

    public function removeFromCollection(User $user, Media $media)
    {
        if (! $user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media tidak ada di dalam koleksi pengguna',
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi pengguna',
        ], 200);
    }
}
