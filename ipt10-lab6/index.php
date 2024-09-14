<?php
require "vendor/autoload.php";

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('ipt10');
$log->pushHandler(new StreamHandler('ipt10.log'));

// add records to the log
$log->warning('Raemart Millare');
$log->error('millare@example.com');
$log->info('profile', [
    'student_number' => '22-1006-129',
    'college' => 'CCS',
    'program' => 'Information Technology',
    'university' => 'Angeles University Foundation'
]);

class TestClass
{
    private $logger;
    public function __construct($logger_name)
    {
        $this->logger = new Logger($logger_name);
        // Log that the class has been created
        $this->logger->info(__FILE__ . " Class created ");
    }

    public function greet($name)
    {
        // provide a greeting message with the name of the invoker
        $message = "Greetings to Raemart Millare";
        // Log it
        $this->logger->info(__METHOD__ . " {$name}");
        return $message;
    }

    public function getAverage($data)
    {
        // Log it
        $this->logger->info(__CLASS__ . " get the average ");
        // compute the average and return it
        $average = array_sum($data) / count($data);
        return $average;
    }

    public function largest($data)
    {
        // Log it
        $this->logger->info(__CLASS__ . " Get the largest number ");
        // compute the largest number and return it
        $largest = max($data);
        return $largest;
    }

    public function smallest($data)
    {
        // Log it
        $this->logger->info(__CLASS__ . " Get the smallest number ");
        // compute the smallest number and return it
        $smallest = min($data);
        return $smallest;
    }
}



$obj = new TestClass('ipt10');
echo $obj->greet($name);
$data = [100, 345, 4563, 65, 234, 6734, -99];
echo " Average: " . $obj->getAverage($data) . "\n";
echo "Largest: " . $obj->largest($data) . "\n";
echo "Smallest: " . $obj->smallest($data) . "\n";

$log->info('data', $data);
$log->debug('object', ['object' => print_r($obj, true)]);