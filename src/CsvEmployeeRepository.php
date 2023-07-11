<?php

namespace App;

use DateTime;
use InvalidArgumentException;

class CsvEmployeeRepository implements EmployeeRepository
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        $fileHandler = fopen($this->fileName, 'rb');
        fgetcsv($fileHandler);
        $employees = [];
        while ($employeeData = fgetcsv($fileHandler, null)) {
            $employeeData = array_map('trim', $employeeData);
            try {
                //$dateTime = DateTime::createFromFormat('Y/m/d H:i:s', $employeeData[2] . ' 00:00:00');
                $date = new OurDate($employeeData[2], null);
                $employee = new Employee($employeeData[1], $employeeData[0], $date, $employeeData[3]);
            } catch (InvalidArgumentException $e){
                throw new CannotCreateEmployeeException();
            }
            $employees[] = $employee;
        }
        return $employees;
    }
}