<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
            Nama Lengkap <span class="text-red-400">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $user?->name) }}"
            required
            class="w-full bg-slate-900 border @error('name') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
        @error('name')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">
            Email <span class="text-red-400">*</span>
        </label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $user?->email) }}"
            placeholder="nama@parktrack.com"
            required
            class="w-full bg-slate-900 border @error('email') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
        @error('email')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
    <div>
        <label for="phone" class="block text-sm font-semibold text-slate-300 mb-2">
            Nomor Telepon
        </label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $user?->phone) }}"
            placeholder="0812xxxxxxxx"
            class="w-full bg-slate-900 border @error('phone') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
        @error('phone')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-slate-300 mb-2">
            Role Pengguna <span class="text-red-400">*</span>
        </label>
        <select
            id="role"
            name="role"
            required
            class="w-full bg-slate-900 border @error('role') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
            @foreach ($roles as $role)
                <option value="{{ $role->value }}" @selected(old('role', $user?->role->value ?? 'user') === $role->value)>
                    {{ $role->label() }}
                </option>
            @endforeach
        </select>
        @error('role')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
        <p class="text-slate-400 text-xs mt-1.5">Petugas (Officer) dapat mengelola slot parkir, operasional parkir, dan akun pengguna.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 pt-4 border-t border-slate-700">
    <div>
        <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">
            Password @unless ($user)<span class="text-red-400">*</span>@endunless
        </label>
        <div class="relative">
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="new-password"
                @required(! $user)
                class="w-full bg-slate-900 border @error('password') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3 pr-11"
            >
            <button type="button" data-toggle-password="password" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white cursor-pointer">
                <i class="bi bi-eye"></i>
            </button>
        </div>
        @error('password')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
        <p class="text-slate-400 text-xs mt-1.5">
            {{ $user ? 'Kosongkan jika tidak ingin mengubah password.' : 'Minimal 8 karakter.' }}
        </p>
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">
            Ulangi Password
        </label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            autocomplete="new-password"
            @required(! $user)
            class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
    </div>
</div>
