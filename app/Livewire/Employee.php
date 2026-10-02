<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee as EmployeeModel;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class Employee extends Component
{
    public $employee_number = '';
    public $position = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $hire_date = '';
    #[Locked]
    public ?int $editingEmployeeId = null;
    public bool $showEditModal = false;

    protected function rules(): array
    {
        return [
            'employee_number' => ['required', 'string', 'max:50', Rule::unique('employees', 'employee_number')->ignore($this->editingEmployeeId)],
            'position' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($this->editingEmployeeId)],
            'phone' => ['required', 'string', 'max:30'],
            'hire_date' => ['required', 'date'],
        ];
    }

    public function addEmployee()
    {
        $this->validate();

        EmployeeModel::create($this->validate());
        $this->resetEmployeeFields();

        session()->flash('message', 'Employee added successfully!');
    }

    public function editEmployee(int $id): void
    {
        $employee = EmployeeModel::findOrFail($id);

        $this->editingEmployeeId = $employee->id;
        $this->employee_number = $employee->employee_number;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->position = $employee->position;
        $this->hire_date = $employee->hire_date->format('Y-m-d');
        $this->showEditModal = true;
        $this->resetValidation();
    }

    public function updateEmployee(): void
    {
        $employee = EmployeeModel::findOrFail($this->editingEmployeeId);
        $employee->update($this->validate());

        $this->closeEditModal();
        session()->flash('message', 'Employee updated successfully!');
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingEmployeeId = null;
        $this->resetEmployeeFields();
    }

    public function deleteEmployee(int $id): void
    {
        EmployeeModel::findOrFail($id)->delete();

        if ($this->editingEmployeeId === $id) {
            $this->closeEditModal();
        }

        session()->flash('message', 'Employee deleted successfully!');
    }

    private function resetEmployeeFields(): void
    {
        $this->reset([
            'employee_number',
            'position',
            'first_name',
            'last_name',
            'email',
            'phone',
            'hire_date',
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.employee', [
            'employees' => EmployeeModel::latest()->get(),
        ]);
    }
}