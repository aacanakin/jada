<?php
namespace Console;

use Jada\BaseCommand;

class SampleCommand extends BaseCommand
{
	protected $args = array(
		array(
			'name' 		   => 'username',
			'description'  => 'enter your name here dude!',
			'required'     => true,
		)
	);

	protected $options = array(
		array(
			'name' => 'exc',
			'description' => 'puts excalamation mark at the end'
		),
	);

	protected $name = 'greet:user';
	protected $description = 'greets someone!';

	protected function main()
	{
		// p($this->config);
		// d($this->config);

		if ($this->option('exc')) {

			$this->out->writeln("Hello {$this->arg('username')}!");

		} else {

			$this->out->writeln("hi {$this->arg('username')}");
		}

		$this->info('This is info');
		$this->error('This is error');
		$this->comment('This is comment');
		$this->ask('This is question');
	}
}