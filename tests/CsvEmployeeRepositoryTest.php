<?php


use App\CannotCreateEmployeeException;
use App\CsvEmployeeRepository;
use App\EmployeeRepository;
use PHPUnit\Framework\TestCase;

class CsvEmployeeRepositoryTest extends TestCase
{
    private EmployeeRepository $sut;

    protected function setUp(): void
    {
        $this->sut = new CsvEmployeeRepository(dirname(__FILE__) . '/resources/employee_data_with_invalid_date.txt');
    }

    public function testGivenAInvalidDateThenThrowError(): void
    {
        $this->expectException(CannotCreateEmployeeException::class);

        $this->sut->getEmployees();
    }
}
