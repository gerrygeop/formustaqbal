<div class="flex flex-col">
	<div class="overflow-x-auto">
		<div class="inline-block min-w-full py-2 align-middle">
			<div class="overflow-hidden shadow border border-gray-200 dark:border-gray-700 md:rounded-lg">
				<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
					<thead class="bg-gray-50 dark:bg-gray-800">
						<tr>
							{{ $thead }}
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
						{{ $tbody }}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
