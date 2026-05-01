@extends('admin.layout')

@section('title', 'Audit Log')
@section('page_title', 'Audit Log — Riwayat Perubahan Data')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-6">Audit Log</h1>
    
    @php $logs = \App\Models\AuditLog::with('user')->latest()->paginate(50); @endphp
    
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-semibold">
                    <tr>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Aksi</th>
                        <th class="px-4 py-3">Model</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $log->created_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3">{{ $log->user?->name ?? 'System' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                @if($log->action === 'create') bg-green-100 text-green-700
                                @elseif($log->action === 'update') bg-blue-100 text-blue-700
                                @elseif($log->action === 'delete') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $log->description }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $log->ip_address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                            <i data-feather="activity" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada aktivitas tercatat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
