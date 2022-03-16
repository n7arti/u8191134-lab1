<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Positive;

class Employee
{

    public function __construct(
        private int $id = 1,
        private string $name = "Ivan",
        private int $salary = 100000,
        private ?DateTime $dateBegin =  null
    ) {

        if ($dateBegin == null)
            $this->dateBegin =  new DateTime();

        $validator = Validation::createValidator();
        $errorsId = $validator->validate($id, [
            new Type('int'),
            new PositiveOrZero(),
        ]);
        $errorsName = $validator->validate($name, [
            new Type('string'),
            new Length(['min' => 2]),
        ]);
        $errorsSalary = $validator->validate($salary, [
            new Type('int'),
            new Positive(),
        ]);

        if (count($errorsId) + count($errorsName) + count($errorsSalary) == 0) {
            $this->id = $id;
            $this->name = $name;
            $this->salary = $salary;
            $this->dateBegin = $dateBegin;
            echo "done ";
        } else {
            if (count($errorsId) != 0) {
                echo "id ";
                foreach ($errorsId as $error) {
                    echo $error->getMessage();
                }
            }

            if (count($errorsName) != 0) {
                echo "name ";
                foreach ($errorsName as $error) {
                    echo $error->getMessage();
                }
            }

            if (count($errorsSalary) != 0) {
                echo "salary ";
                foreach ($errorsSalary as $error) {
                    echo $error->getMessage();
                }
            }
        }
    }

    public function getWorkExperience(): int
    {
        return $this->dateBegin->diff(new DateTime())->format('%Y');
    }

    public function getSalary(): int
    {
        return $this->salary;
    }
}
