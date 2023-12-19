<x-table>
	@slot('thead')
		<x-th>No</x-th>
		<x-th>NIM</x-th>
		<x-th>Nama</x-th>
		<x-th>Prodi</x-th>
		<x-th>Partisipasi</x-th>
		<x-th>Tugas</x-th>
		<x-th>UTS</x-th>
		<x-th>UAS</x-th>
		<x-th>Nilai Akhir</x-th>
	@endslot
	@slot('tbody')
		@foreach ($users as $user)
			<tr>
				<x-td>{{ $loop->iteration }}</x-td>
				<x-td>
					<div class="font-medium">
						{{ $user->username }}
					</div>
				</x-td>
				<x-td>
					<div class="font-medium">
						{{ $user->name }}
					</div>
				</x-td>
				<x-td>
					{{ $user->siakad ? $user->siakad->department->name : '-' }}
				</x-td>
				<x-td>
					{{ $user->grade?->c1 ?? 0 }}
				</x-td>
				<x-td>
					{{ $user->grade?->c2 ?? 0 }}
				</x-td>
				<x-td>
					{{ $user->grade?->c3 ?? 0 }}
				</x-td>
				<x-td>
					{{ $user->grade?->c4 ?? 0 }}
				</x-td>
				<x-td>
					{{ $user->grade?->result ?? 0 }}
				</x-td>
			</tr>
		@endforeach
	@endslot
</x-table>
