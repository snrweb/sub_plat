<?php

namespace App\Jobs;

use App\Mail\NewPost;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewPostEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Post $post,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $subscribers = $this->post->website->subscriptions;

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewPost($this->post));
        }
    }
}
