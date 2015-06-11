<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\User\UserStatistics;
use Carbon\Carbon;

class UpdateStatistics extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'statistics:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the user statistics table - daily.';

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
	public function fire()
	{
		$this->info("Updating user statistics....");
		
		$yesterday = array(
				Carbon::now()->subDay()->setTime(00,00,00),
				Carbon::now()->setTime(00,00,00)
		);
		
		$today = array(
				Carbon::now()->setTime(00,00,00),
				Carbon::now()
		);
		
		$stats = UserStatistics::whereBetween('created_at', $today)->orderBy('user_id')->get();
		
		
		
		$this->info($stats);
		
		
		if($this->confirm('Estas de acuerdo?'))
		{
			$this->info('Siiii');
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

}
