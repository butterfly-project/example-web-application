<?php

namespace Project\Command;

use Project\Service\Calculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculatorSumCommand extends Command
{
    /**
     * @var Calculator
     */
    protected $calculator;

    /**
     * @param Calculator $calculator
     */
    public function setCalculator(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    protected function configure()
    {
        $this
            ->setName('project:calculator:sum')
            ->setDescription('Summation: A + B')
            ->addArgument('a', InputArgument::REQUIRED, 'Argument A')
            ->addArgument('b', InputArgument::REQUIRED, 'Argument B');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $a = (int)$input->getArgument('a');
        $b = (int)$input->getArgument('b');

        $result = $this->calculator->sum($a, $b);
        $output->writeln(sprintf('%d + %d = %d', $a, $b, $result));
    }
}
