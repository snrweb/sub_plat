<?php

namespace App\Jobs;

use App\Mail\NewPost;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
            $key = 'sent_email_' . $subscriber->email . '_post_' . $this->post->id;

            // Check if the email has already been sent
            if (Cache::has($key)) {
                continue;
            }

            try {
                Mail::to($subscriber->email)->send(new NewPost($this->post));

                // A unique key is generated and cached to track sent emails
                Cache::put($key, true, now()->addDays(1)); // Cache for 1 day
            } catch (\Exception $e) {
                // Log the error
                Log::error('Failed to send email to ' . $subscriber->email . ': ' . $e->getMessage());
            }
        }
    }
}
