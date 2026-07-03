@extends('backoffice.layouts.app')

@section('breadcrumb', 'Tambah Pasien')
@section('title', 'Tambah Pasien')

@section('content')
@include('backoffice.pasien.form', [
    'title' => 'Tambah Pasien',
    'action' => route('admin.backoffice.pasien.store'),
    'method' => 'POST',
    'pasien' => null
])
