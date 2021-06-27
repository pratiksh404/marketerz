<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Admin\Task;
use Illuminate\Console\Command;
use App\Notifications\TaskReminderNotification;

class TaskReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check and run task reminder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('reminder', 1)->whereDate('reminder_date_time', Carbon::today())->get();
        if (isset($tasks)) {
            if ($tasks->count() > 0) {
                foreach ($tasks as $task) {
                    $user = $task->user;
                    if (isset($task->user)) {
                        $user->setSlackUrl(env('TASK_REMINDER_SLACK_WEBHOOK_URL'))->notify(new TaskReminderNotification($task));
                        $task->update([
                            'reminder' => 0
                        ]);
                        $this->info('Reminder Notification Sent Successfully !');
                    } else {
                        $this->error('No user found !');
                    }
                }
            } else {
                $this->error('No task reminder for today.');
            }
        }
    }
}
