<?php

namespace App\Console\Commands;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PromotionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotion:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新优惠状态';

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
     * @return mixed
     */
    public function handle()
    {
//        Promotion::where('status', 'audit')->update(['status' => 'wait']);

        Promotion::where('get_start_at', '>', Carbon::now())
            ->where('status', '!=', 'audit')
            ->update(['status' => 'wait']);

        Promotion::where('get_start_at', '<', Carbon::now())
            ->where('status', '!=', 'audit')
            ->update(['status' => 'process']);

        Promotion::where(function ($query) {
            $query->where('get_end_at', '<', Carbon::now())->orwhere('stock', '<=', 0);
        })->where('status', '!=', 'audit')->update(['status' => 'complete']);

        \Log::info('更新优惠状态');
    }
}
