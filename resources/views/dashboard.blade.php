<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
			<section class="mx-auto max-w-3xl bg-white px-6 py-10 shadow-xl sm:rounded-lg sm:px-10">
				<div class="text-center">
					<p class="text-sm font-medium uppercase tracking-wider text-gray-500">Current count</p>
					<output id="counter-value" class="mt-4 block text-7xl font-semibold tabular-nums text-gray-900" aria-live="polite" aria-atomic="true">0</output>
				</div>

				<div class="mt-8 flex flex-wrap items-center justify-center gap-3">
					<button type="button" data-counter-action="decrement" aria-label="Decrease count" title="Decrease count" disabled class="inline-flex size-12 items-center justify-center rounded-md border border-gray-300 text-2xl font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
						-
					</button>
					<button type="button" data-counter-action="reset" class="inline-flex min-h-12 items-center justify-center rounded-md border border-gray-300 px-5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
						Reset
					</button>
					<button type="button" data-counter-action="increment" aria-label="Increase count" title="Increase count" class="inline-flex size-12 items-center justify-center rounded-md bg-gray-900 text-2xl font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
						+
					</button>
				</div>
			</section>

		</div>
	</div>

	<script>
		const counterDisplay = document.getElementById('counter-value');
		const decrementButton = document.querySelector('[data-counter-action="decrement"]');
		let count = 0;

		document.querySelectorAll('[data-counter-action]').forEach((button) => {
			button.addEventListener('click', () => {
				const action = button.dataset.counterAction;

				if (action === 'increment') {
					count += 1;
				} else if (action === 'decrement') {
					count = Math.max(0, count - 1);
				} else {
					count = 0;
				}

				counterDisplay.textContent = String(count);
				decrementButton.disabled = count === 0;
			});
		});
	</script>
</x-app-layout>
