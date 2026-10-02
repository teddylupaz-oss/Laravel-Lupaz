<?php

use App\Livewire\Employee;
use App\Models\Employee as EmployeeModel;
use Livewire\Livewire;

it('adds an employee', function () {
    Livewire::test(Employee::class)
        ->set('employee_number', 'EMP-1001')
        ->set('first_name', 'Ava')
        ->set('last_name', 'Santos')
        ->set('email', 'ava.santos@example.com')
        ->set('phone', '555-0100')
        ->set('position', 'Analyst')
        ->set('hire_date', '2026-10-01')
        ->call('addEmployee')
        ->assertHasNoErrors()
        ->assertSee('Employee added successfully!');

    $this->assertDatabaseHas('employees', [
        'employee_number' => 'EMP-1001',
        'first_name' => 'Ava',
        'last_name' => 'Santos',
        'email' => 'ava.santos@example.com',
    ]);
});

it('edits an employee', function () {
    $employee = EmployeeModel::create([
        'employee_number' => 'EMP-1002',
        'first_name' => 'Noah',
        'last_name' => 'Reyes',
        'email' => 'noah.reyes@example.com',
        'phone' => '555-0101',
        'position' => 'Assistant',
        'hire_date' => '2025-03-15',
    ]);

    Livewire::test(Employee::class)
        ->call('editEmployee', $employee->id)
        ->assertSet('showEditModal', true)
        ->set('position', 'Senior Assistant')
        ->call('updateEmployee')
        ->assertHasNoErrors()
        ->assertSet('showEditModal', false)
        ->assertSee('Employee updated successfully!');

    $this->assertDatabaseHas('employees', [
        'id' => $employee->id,
        'employee_number' => 'EMP-1002',
        'email' => 'noah.reyes@example.com',
        'position' => 'Senior Assistant',
    ]);
});

it('deletes an employee', function () {
    $employee = EmployeeModel::create([
        'employee_number' => 'EMP-1003',
        'first_name' => 'Mia',
        'last_name' => 'Cruz',
        'email' => 'mia.cruz@example.com',
        'phone' => '555-0102',
        'position' => 'Coordinator',
        'hire_date' => '2024-08-01',
    ]);

    Livewire::test(Employee::class)
        ->call('deleteEmployee', $employee->id)
        ->assertSee('Employee deleted successfully!');

    $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
});