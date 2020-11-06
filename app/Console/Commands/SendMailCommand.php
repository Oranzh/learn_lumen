<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:SendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '命令行-测试脚本-SendMail';

    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $toMail  = '81586424@qq.com';

//        Mail::send([], ['a' => 'b'], function ($message) use ($toMail){
//            $message->to($toMail, 'me')->subject('Welcome');
//        });

        Mail::raw('This is a text', function ($message) use ($toMail) {
            $message->to($toMail, '这个在哪里')->subject('Welcome');
        });
    }
}