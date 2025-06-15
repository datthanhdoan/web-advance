<?php

namespace App\Http\Controllers;

use App\Models\Clap;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ClapController extends Controller
{
    public function toggleClap(Post $post)
    {
        if (! Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập để vỗ tay.'], 401);
        }

        $user = Auth::user();

        $clap = Clap::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($clap) {
            $clap->delete();
            $message = 'Đã bỏ vỗ tay.';
            $clapped = false;
        } else {
            Clap::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            $message = 'Đã vỗ tay thành công!';
            $clapped = true;
        }

        $totalClaps = $post->claps()->count();

        return response()->json([
            'message' => $message,
            'totalClaps' => $totalClaps,
            'clapped' => $clapped,
        ]);
    }
}
