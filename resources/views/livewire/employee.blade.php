<div class="space-y-8">
    @if (session()->has('message'))
        <p role="status" class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('message') }}
        </p>
    @endif

    <section class="bg-white p-6 shadow-xl sm:rounded-lg sm:p-8">
        <h3 class="text-lg font-semibold text-gray-900">Add employee</h3>

        <form wire:submit="addEmployee" class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <label for="employee_number" class="block text-sm font-medium text-gray-700">Employee number</label>
                <input id="employee_number" type="text" wire:model="employee_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('employee_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <input id="first_name" type="text" wire:model="first_name" required autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <input id="last_name" type="text" wire:model="last_name" required autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" wire:model="email" required autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input id="phone" type="tel" wire:model="phone" required autocomplete="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input id="position" type="text" wire:model="position" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire date</label>
                <input id="hire_date" type="date" wire:model="hire_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('hire_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-end">
                <button type="submit" wire:loading.attr="disabled" wire:target="addEmployee" class="inline-flex min-h-10 items-center justify-center rounded-md bg-gray-900 px-5 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-wait disabled:opacity-60">
                    <span wire:loading.remove wire:target="addEmployee">Add employee</span>
                    <span wire:loading wire:target="addEmployee">Adding...</span>
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white p-6 shadow-xl sm:rounded-lg sm:p-8">
        <h3 class="text-lg font-semibold text-gray-900">Employees</h3>

        @if ($employees->isEmpty())
            <p class="mt-4 text-sm text-gray-600">No employees have been added yet.</p>
        @else
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th scope="col" class="px-3 py-3 font-medium">Employee number</th>
                            <th scope="col" class="px-3 py-3 font-medium">Name</th>
                            <th scope="col" class="px-3 py-3 font-medium">Email</th>
                            <th scope="col" class="px-3 py-3 font-medium">Phone</th>
                            <th scope="col" class="px-3 py-3 font-medium">Position</th>
                            <th scope="col" class="px-3 py-3 font-medium">Hire date</th>
                            <th scope="col" class="px-3 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->employee_number }}</td>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->email }}</td>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->phone }}</td>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->position }}</td>
                                <td class="whitespace-nowrap px-3 py-3">{{ $employee->hire_date->format('M j, Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-3">
                                    <div class="flex items-center gap-3">
                                        <button type="button" wire:click="editEmployee({{ $employee->id }})" class="text-sm font-medium text-gray-700 underline decoration-gray-300 underline-offset-4 hover:text-gray-900">Edit</button>
                                        <button type="button" wire:click="deleteEmployee({{ $employee->id }})" wire:confirm="Delete this employee? This action cannot be undone." class="text-sm font-medium text-red-700 underline decoration-red-300 underline-offset-4 hover:text-red-900">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    @if ($showEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="edit-employee-title">
            <button type="button" wire:click="closeEditModal" aria-label="Close edit dialog" class="fixed inset-0 size-full cursor-default bg-gray-900/50"></button>
            <div class="relative z-10 flex min-h-full items-center justify-center p-4">
                <section class="w-full max-w-3xl rounded-md bg-white p-6 shadow-xl sm:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <h3 id="edit-employee-title" class="text-lg font-semibold text-gray-900">Edit employee</h3>
                        <button type="button" wire:click="closeEditModal" class="text-sm font-medium text-gray-600 underline underline-offset-4 hover:text-gray-900">Cancel</button>
                    </div>

                    <form wire:submit="updateEmployee" class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="edit_employee_number" class="block text-sm font-medium text-gray-700">Employee number</label>
                            <input id="edit_employee_number" type="text" wire:model="employee_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('employee_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_first_name" class="block text-sm font-medium text-gray-700">First name</label>
                            <input id="edit_first_name" type="text" wire:model="first_name" required autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                            <input id="edit_last_name" type="text" wire:model="last_name" required autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="edit_email" type="email" wire:model="email" required autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input id="edit_phone" type="tel" wire:model="phone" required autocomplete="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_position" class="block text-sm font-medium text-gray-700">Position</label>
                            <input id="edit_position" type="text" wire:model="position" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="edit_hire_date" class="block text-sm font-medium text-gray-700">Hire date</label>
                            <input id="edit_hire_date" type="date" wire:model="hire_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('hire_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-end justify-end">
                            <button type="submit" wire:loading.attr="disabled" wire:target="updateEmployee" class="inline-flex min-h-10 items-center justify-center rounded-md bg-gray-900 px-5 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-wait disabled:opacity-60">
                                <span wire:loading.remove wire:target="updateEmployee">Save changes</span>
                                <span wire:loading wire:target="updateEmployee">Saving...</span>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    @endif
</div>