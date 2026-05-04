@extends('backoffice.layouts.app')

@section('breadcrumb', 'Profile')
@section('title', 'Profile')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="relative w-full mb-8">
        <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-20 w-20 rounded-xl bg-blue-500">
                        <span class="text-3xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                </div>

                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 text-slate-700">{{ $user->name }}</h5>
                        <p class="mb-0 font-semibold leading-normal text-sm text-slate-500">
                            {{ $user->roles->pluck('name')->join(', ') ?: 'User' }}
                        </p>
                    </div>
                </div>

                <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    <div class="relative right-0">
                        <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl">
                            <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-2 mb-0 transition-all ease-in-out border-0 rounded-lg bg-white shadow text-slate-700">
                                    <i class="ni ni-single-02"></i>
                                    <span class="ml-2">Profile</span>
                                </a>
                            </li>
                            <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-2 mb-0 transition-all ease-in-out border-0 rounded-lg text-slate-700">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ml-2">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">

        <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="rounded-t-2xl p-6 pb-0">
                    <div class="flex items-center">
                        <p class="mb-0 font-bold text-slate-700">Informasi Akun</p>
                        <button type="button"
                                class="inline-block px-6 py-2 mb-4 ml-auto font-bold text-center text-white transition-all bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-xs hover:bg-blue-600">
                            Edit Profile
                        </button>
                    </div>
                </div>

                <div class="flex-auto p-6">
                    <p class="leading-normal uppercase text-sm text-slate-400 font-bold">User Information</p>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama</label>
                                <input type="text" value="{{ $user->name }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                <input type="email" value="{{ $user->email }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Role</label>
                                <input type="text" value="{{ $user->roles->pluck('name')->join(', ') ?: '-' }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Bergabung</label>
                                <input type="text" value="{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>
                    </div>

                    <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent" />

                    <p class="leading-normal uppercase text-sm text-slate-400 font-bold">Contact Information</p>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 shrink-0 md:w-full">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Alamat</label>
                                <input type="text" value="{{ $user->address ?? '-' }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">No. Telepon</label>
                                <input type="text" value="{{ $user->phone ?? '-' }}" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                                <input type="text" value="Aktif" readonly
                                       class="text-sm block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:mt-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border overflow-hidden">
                <div class="h-36 bg-gradient-to-r from-blue-500 to-cyan-400"></div>

                <div class="flex flex-wrap justify-center -mx-3">
                    <div class="w-4/12 max-w-full px-3">
                        <div class="-mt-12 mb-4">
                            <div class="w-24 h-24 mx-auto rounded-full bg-white shadow-lg flex items-center justify-center">
                                <div class="w-20 h-20 rounded-full bg-blue-500 text-white flex items-center justify-center text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-auto p-6 pt-0 text-center">
                    <h5 class="text-slate-700">
                        {{ $user->name }}
                    </h5>

                    <div class="mb-2 font-semibold leading-relaxed text-base text-slate-700">
                        <i class="mr-2 ni ni-email-83"></i>
                        {{ $user->email }}
                    </div>

                    <div class="mt-4 mb-2 font-semibold leading-relaxed text-base text-slate-700">
                        <i class="mr-2 ni ni-badge"></i>
                        {{ $user->roles->pluck('name')->join(', ') ?: 'User' }}
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="p-3 rounded-xl bg-blue-50">
                            <span class="block text-lg font-bold text-blue-600">
                                {{ $user->id }}
                            </span>
                            <span class="text-xs text-slate-500">User ID</span>
                        </div>

                        <div class="p-3 rounded-xl bg-green-50">
                            <span class="block text-lg font-bold text-green-600">Aktif</span>
                            <span class="text-xs text-slate-500">Status</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection