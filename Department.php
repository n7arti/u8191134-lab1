<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'Employee.php';
class Department
{
    private array $employees;
    private string $name = "Apelsin";
    public function __construct(array $employees, string $name)
    {
        $this->employees = $employees;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountEmpoyees(): int
    {
        return count($this->employees);
    }

    public function getSalarySum(): int
    {
        $sum = 0;
        foreach ($this->employees as $item) {
            $sum += $item->getSalary();
        }
        return $sum;
    }
}
$emp0 =  new Employee(4, 'A', 200000, new DateTime());
$emp1 = new Employee();
$emp2 =  new Employee(1, "Serega", 100000, new DateTime());
$emp3 =  new Employee(4, 'Arrr', 200000, new DateTime());
$emp4 =  new Employee(10, 'Tamir', 300000, new DateTime());
$emp5 =  new Employee(10, 'Tamir', 40000, new DateTime());

$dep1 = new Department([$emp1, $emp2, $emp3,], 'LALALA');
$dep2 = new Department([$emp1, $emp2, $emp3,], 'LALALA_DOP');
$dep3 = new Department([$emp4, $emp5,], 'AbraCadabra');
$arr = [$dep1, $dep2, $dep3];
$max = 0;
$maxcount = 0;
for ($i = 0; $i < 3; $i++) {
    if ($arr[$i]->getSalarySum() > $max)
        $max = $arr[$i]->getSalarySum();
}
$maxDep = array();
for ($i = 0; $i < 3; $i++) {
    if ($arr[$i]->getSalarySum() == $max)
        array_push($maxDep, $arr[$i]);
}
if (count($maxDep) == 1)
    echo $maxDep[0]->getName();
else {
    for ($i = 0; $i < count($maxDep); $i++) {
        if ($maxDep[$i]->getCountEmpoyees() > $maxcount)
            $maxcount = $maxDep[$i]->getCountEmpoyees();
    }
    for ($i = 0; $i < count($maxDep); $i++) {
        if ($maxDep[$i]->getCountEmpoyees() == $maxcount)
            echo $maxDep[$i]->getName() . " ";
    }
}
