@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <h1>Profil Saya</h1>
    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Role:</strong> {{ Auth::user()->role ?? '-' }}</p>
    <p><strong>Terdaftar sejak:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
</div>
@endsection
