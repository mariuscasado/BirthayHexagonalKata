<?php

namespace App;

interface EmployeeRepository
{
    /**
     * @return Employee[]
     */
    public function getEmployees(): array;
}