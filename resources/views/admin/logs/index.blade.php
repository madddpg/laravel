<x-layouts.app>
    <x-slot:heading>
        Activity Logs
    </x-slot:heading>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>System Activity Logs</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Log ID</th>
                            <th>Date / Time</th>
                            <th>Admin User</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>#{{ $log->id }}</td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ optional($log->admin)->username ?? 'Deleted Admin' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $log->action }}</span>
                                </td>
                                <td class="text-secondary">{{ $log->details }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No activity logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>