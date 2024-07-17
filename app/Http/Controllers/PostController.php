<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewPostEmails;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post = Post::create($request->all());

        // Dispatch job to send emails
        SendNewPostEmails::dispatch($post);

        return response()->json($post, 201);
    }
}
