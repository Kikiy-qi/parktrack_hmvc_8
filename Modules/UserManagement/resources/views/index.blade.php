@extends('layouts.app')

@section('title', 'Kelola Pengguna - ParkTrack')

@section('content')
<div class="max-w-6xl mx-auto mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="bi bi-people-fill text-brand-500 mr-3"></i>Kelola Akun Pengguna
            </h2>
            <p class="text-slate-400 text-sm mt-1">
                Manajemen akun petugas parkir (Officer) dan pengendara (User).
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-lg shadow-brand-500/20 flex items-center">
            <i class="bi bi-person-plus-fill mr-2"></i>Tambah Pengguna
        </a>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-lg">
        <div class="p-5 border-b border-slate-700">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </div>
                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama, email, atau nomor telepon..."
                        class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block pl-11 p-2.5"
                    >
                </div>
                <div class="sm:w-52">
                    <select
                        name="role"
                        onchange="this.form.submit()"
                        class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-2.5"
                    >
                        <option value="">Semua Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->value }}" @selected($selectedRole === $role)>{{ $role->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-colors">
                        Cari
                    </button>
                    @if ($search !== '' || $selectedRole)
                        <a href="{{ route('admin.users.index') }}" class="border border-slate-600 text-slate-300 hover:text-white px-4 py-2.5 rounded-xl text-sm transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-300">
                <thead class="text-xs text-slate-400 uppercase bg-slate-900/60 border-b border-slate-700">
                    <tr>
                        <th class="px-5 py-4 w-16">No</th>
                        <th class="px-5 py-4">Nama Lengkap</th>
                        <th class="px-5 py-4">Email</th>
                        <th class="px-5 py-4">Telepon</th>
                        <th class="px-5 py-4">Role</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse ($users as $user)
                        @php($isCurrentUser = $user->is(auth()->user()))
                        <tr class="hover:bg-slate-700/20 transition-colors">
                            <td class="px-5 py-4 text-slate-400">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="px-5 py-4 font-bold text-white">
                                {{ $user->name }}
                                @if ($isCurrentUser)
                                    <span class="ml-2 text-[11px] bg-brand-500/20 text-brand-400 border border-brand-500/30 px-2 py-0.5 rounded-full">Anda</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">{{ $user->email ?? '-' }}</td>
                            <td class="px-5 py-4">{{ $user->phone ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $user->isOfficer() ? 'bg-amber-500/15 text-amber-400 border-amber-500/30' : 'bg-slate-700 text-slate-300 border-slate-600' }}">
                                    {{ $user->role->label() }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="bg-amber-500/20 hover:bg-amber-500 text-amber-300 hover:text-slate-900 border border-amber-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors">
                                        <i class="bi bi-pencil mr-1"></i>Edit
                                    </a>
                                    @unless ($isCurrentUser)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" data-confirm="Akun {{ $user->name }} akan dihapus permanen.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white border border-red-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors cursor-pointer">
                                                <i class="bi bi-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                                <i class="bi bi-person-x text-4xl text-slate-600 block mb-2"></i>
                                <p>Tidak ada pengguna yang cocok dengan pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-4 border-t border-slate-700 flex flex-wrap justify-between items-center gap-2 text-xs text-slate-400">
                <span>Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} pengguna</span>
                <div>{{ $users->links() }}</div>
            </div>
        @endif
    </div>
</div>
@endsection
