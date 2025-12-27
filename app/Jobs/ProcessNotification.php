<?php
/**
 * Notification creation job
 *      - Made as a job in case of any error
 * the user don't need to see an error
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Jobs;

use App\Http\Services\NotificationService;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessNotification implements ShouldQueue
{
    use Queueable;

    private NotificationService $service;
    private User $user;
    private string $header;
    private string $body;
    private string $type;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $header, string $body, string $type = NotificationService::NOTI_TYPE_MSG)
    {
        $this->service = new NotificationService();
        $this->user = $user;
        $this->header = $header;
        $this->body = $body;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->service->createNotification(
                $this->user,
                $this->header,
                $this->body,
                $this->type
            );
        } catch (\Exception $ex) {
            $this->fail($ex);
        }
    }
}
