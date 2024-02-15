<?php

namespace App\Console\Commands;

use App\Models\MembershipModel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:delete-expired';
    protected $description = 'Delete expired memberships';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        MembershipModel::where('akhir_membership','<',Carbon::now()->locale('id'))->delete();
        $this->info('Expired memberships deleted successfully.');
    }
}
