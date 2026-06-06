@extends('backoffice.layouts.app')

@section('breadcrumb', 'Management User')
@section('title', 'Tambah User')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-soft-xl rounded-2xl p-6">

            <div class="mb-6">
                <h6 class="text-xl font-bold text-slate-700">Tambah User</h6>
                <p class="text-sm text-slate-400 mt-1">Tambahkan akun pengguna baru ke dalam sistem</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-600">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.backoffice.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-600">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
                               placeholder="Masukkan nama user" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-600">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
                               placeholder="Masukkan email" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-600">Password</label>
                        <input type="password" name="password"
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
                               placeholder="Minimal 6 karakter" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-600">Role</label>
                        <select name="role"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
                                required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <a href="{{ route('admin.backoffice.users.index') }}"
                       class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200">
                        Kembali
                    </a>

                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-500 rounded-xl hover:bg-blue-600 shadow">
                        Simpan User
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection