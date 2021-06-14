<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NewsletterNotification;
use Illuminate\Console\Command;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter {emails?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico';

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
        $emails = $this->arguments('emails');

        $builder = User::first();

        if ($emails) {
            $builder->whereIn('email', $emails);
        }

        
        $count = $builder->count();

        $this->output->progressStart($count);


        if ($count) {
            
            User::query()->whereNotNull('email_verified_at')
                ->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
            $this->info("Se enviaron {$count} correos");
            $this->output->progressFinish();
        } else {
            $this->info('No se envio ningun correo');
        }

    }
}
