@extends('backoffice.layouts.app')

@section('breadcrumb', 'Edit Pasien')
@section('title', 'Edit Pasien')

@section('content')
@include('backoffice.pasien.form', [
    'title' => 'Edit Pasien',
    'action' => route('admin.backoffice.pasien.update', $pasien->id),
    'method' => 'PUT',
    'pasien' => $pasien
])
@endsection