@extends('backoffice.layouts.app')

@section('breadcrumb', 'Role Permission')
@section('title', 'Role Permission')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-soft-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400">Total Role</p>
                    <h3 class="text-3xl font-bold text-slate-700 mt-2">{{ $totalRoles }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="ni ni-badge text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-soft-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400">Total Permission</p>
                    <h3 class="text-3xl font-bold text-slate-700 mt-2">{{ $totalPermissions }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <i class="ni ni-lock-circle-open text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-soft-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400">Role Permission</p>
                    <h3 class="text-3xl font-bold text-slate-700 mt-2">{{ $totalRolePermissions }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="ni ni-check-bold text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM TAMBAH ROLE & PERMISSION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-soft-xl p-6">
            <h6 class="text-lg font-bold text-slate-700 mb-4">Tambah Role</h6>

            <form action="{{ route('admin.backoffice.roles.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="name"
                       class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                       placeholder="Contoh: admin" required>

                <button class="px-5 py-3 bg-blue-500 text-white rounded-xl font-semibold">
                    Simpan
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-soft-xl p-6">
            <h6 class="text-lg font-bold text-slate-700 mb-4">Tambah Permission</h6>

            <form action="{{ route('admin.backoffice.permissions.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="name"
                       class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm"
                       placeholder="Contoh: users.view" required>

                <button class="px-5 py-3 bg-purple-500 text-white rounded-xl font-semibold">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- ROLE PERMISSION --}}
    <div class="bg-white rounded-2xl shadow-soft-xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h6 class="text-xl font-bold text-slate-700">Pengaturan Role Permission</h6>
        </div>

        <div class="p-6">
            <div class="mb-8">
                <label class="block mb-2 text-sm font-bold text-slate-700">Pilih Role</label>
                <select id="roleSelect"
                        class="w-full md:w-1/3 px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @foreach($roles as $role)
                @php
                    $groupedPermissions = $permissions->groupBy(function ($permission) {
                        $name = $permission->name;

                        if (str_contains($name, '.')) {
                            return strtoupper(explode('.', $name)[0]);
                        }

                        if (str_contains($name, '-')) {
                            return strtoupper(explode('-', $name)[0]);
                        }

                        return 'LAINNYA';
                    });
                @endphp

                <form action="{{ route('admin.backoffice.roles.sync-permissions', $role->id) }}"
                      method="POST"
                      class="role-permission-form hidden"
                      data-role-id="{{ $role->id }}">
                    @csrf

                    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                        <div>
                            <h6 class="text-lg font-bold text-slate-700">
                                Permission untuk role:
                                <span class="px-3 py-1 rounded-lg bg-green-700 text-white text-sm">
                                    {{ $role->name }}
                                </span>
                            </h6>
                            <p class="text-sm text-slate-400 mt-1">
                                {{ $role->permissions->count() }} permission aktif
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <button type="button"
                                    class="btn-check-all px-4 py-2 border border-green-700 text-green-700 rounded-xl text-sm font-semibold hover:bg-green-50">
                                Pilih Semua
                            </button>

                            <button type="button"
                                    class="btn-uncheck-all px-4 py-2 border border-slate-500 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-50">
                                Hapus Semua
                            </button>

                            <button type="submit"
                                    class="px-5 py-2 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600">
                                Simpan
                            </button>
                        </div>
                    </div>

                    <div class="space-y-5">
                        @foreach($groupedPermissions as $groupName => $items)
                            <div class="border border-slate-200 rounded-2xl overflow-hidden">
                                <div class="flex items-center justify-between px-5 py-3 bg-slate-50 border-b border-slate-200">
                                    <h6 class="text-sm font-bold text-slate-700 uppercase">
                                        {{ $groupName }}
                                    </h6>

                                    <i class="ni ni-bold-down text-sm text-slate-500"></i>
                                </div>

                                <div class="p-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-4">
                                        @foreach($items as $permission)
                                            <label class="flex items-center gap-3 cursor-pointer">
                                                <input type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $permission->name }}"
                                                       class="permission-checkbox w-5 h-5 rounded border-slate-300 text-green-600 focus:ring-green-500"
                                                       {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                                <span class="text-sm font-semibold text-slate-700 break-all">
                                                    {{ $permission->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            @endforeach

            <div id="emptyRoleMessage"
                 class="border border-dashed border-slate-300 rounded-2xl p-10 text-center text-slate-400">
                Silakan pilih role terlebih dahulu untuk menampilkan daftar permission.
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const roleSelect = document.getElementById('roleSelect');
    const forms = document.querySelectorAll('.role-permission-form');
    const emptyMessage = document.getElementById('emptyRoleMessage');

    roleSelect.addEventListener('change', function () {
        const roleId = this.value;
        let selected = false;

        forms.forEach(form => {
            if (form.dataset.roleId === roleId) {
                form.classList.remove('hidden');
                selected = true;
            } else {
                form.classList.add('hidden');
            }
        });

        emptyMessage.classList.toggle('hidden', selected);
    });

    document.querySelectorAll('.btn-check-all').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('form').querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = true);
        });
    });

    document.querySelectorAll('.btn-uncheck-all').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('form').querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = false);
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 1800,
            showConfirmButton: false
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ $errors->first() }}'
        });
    @endif
</script>
@endpush