@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="page-header">
    <h1>Detail User</h1>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h2>{{ $user->name }}</h2>
    </div>

    <div style="margin-bottom: 20px;">
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p>
            <strong>Role:</strong> 
            @if($user->role === 'admin')
                <span style="background: #e7d4f5; color: #5a3d7a; padding: 4px 8px; border-radius: 3px;">Admin</span>
            @else
                <span style="background: #d4e7f5; color: #3d5a7a; padding: 4px 8px; border-radius: 3px;">Siswa</span>
            @endif
        </p>
        <p><strong>Dibuat:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.login.edit', $user->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.login.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
