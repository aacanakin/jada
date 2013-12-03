<?php
namespace Jada;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Exception;

class BaseCommand extends Command
{
	/**
	 * Variable holds raw configuration
	 */
	protected $_config;

	/**
	 * Variable holds configuration array
	 */
	protected $config;

	/**
	 * Variables holds the name & description of command
	 */
	protected $name;
	protected $description;

	/**
	 * Variable holds arguments w/ following structure
	 * array(
	 * 	   'name'		 => 'command:hello',
	 *     'description' => 'Sample description',
	 *     'required'    => true|false
	 * );
	 */
	protected $args = array();

	/**
	 * Variable holds arguments w/ following structure
	 * array(
	 * 	   'name'		 => 'command:hello',
	 *     'description' => 'Sample description',
	 * );
	 */
	protected $options = array();

	/**
	 * Variables holds Input-Output interface objects
	 */
	protected $in;
	protected $out;

	public function __construct(array $config)
	{
		parent::__construct();
		$this->_config = $config;
	}

	/**
	 * Function that runs on execution
	 */
	protected function main()
	{

	}

	/**
	 * Function returns argument given name
	 */
	protected function arg($name = null)
	{
		return $this->in->getArgument($name);
	}

	/**
	 * Function returns option given name
	 */
	protected function option($name = null)
	{
		return $this->in->getOption($name);
	}

	/**
	 * Function prints error (red)
	 */
	protected function error($text)
	{
		$this->out->writeln('<error>' . $text . '</error>');
	}

	/**
	 * Function prints comment (yellow)
	 */
	protected function comment($text)
	{
		$this->out->writeln('<comment>' . $text . '</comment>');
	}

	/**
	 * Function prints a question
	 */
	protected function ask($text)
	{
		$this->out->writeln('<question>' . $text . '</question>');
	}

	/**
	 * Function prints info
	 */
	protected function info($text)
	{
		$this->out->writeln('<info>' . $text . '</info>');
	}

	/**
	 * Function register configuration
	 */
	protected function registerConfig($environment = 'default')
	{
		$this->config = $this->_config[$environment];
	}

	/**
	 * Function of symfony's configure command
	 */
	protected function configure()
	{
		$this->setName($this->name)
			 ->setDescription($this->description);

		foreach ($this->args as $arg)
		{
			$type = $arg['required'] ? InputArgument::REQUIRED : InputArgument::OPTIONAL;
			$this->addArgument(
				$arg['name'],
				$type,
				$arg['description']
			);
		}

		$this->options[] = array(
			'name' => 'env',
			'description' => 'application environment'
		);

		foreach ($this->options as $option)
		{
			$this->addOption(
				$option['name'],
				null,
				InputOption::VALUE_REQUIRED,
				$option['description']
			);
		}
	}

	/**
	 * Function of symfony's execute command
	 */
	protected function execute(InputInterface $in, OutputInterface $out)
	{
		$this->in = $in;
		$this->out = $out;

		$environment = $this->option('env');

		if (empty($environment)) {
			$this->registerConfig();
		} else {
			$this->registerConfig($environment);
		}

		$this->main();
	}
}
