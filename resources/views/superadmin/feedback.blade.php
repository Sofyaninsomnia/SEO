@extends('components.layouts.superadmin.header-content')
@section('content')
    <x-layouts.superadmin.header>
    </x-layouts.superadmin.header>
    <x-layouts.superadmin.aside></x-layouts.superadmin.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Feeback Pesan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.pesan') }}">Pesan Saran Fitur</a></li>
                    <li class="breadcrumb-item active">Feedback Pesan</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
           <div class="card">
            <div class="card-body">
                <h3 class="card-title">Feedback Saran Fitur</h3>
                <form action="{{ route('send_feedback', $pesan->id) }}" class="form-control" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" name="user_id" value="{{ $pesan->user->name }}" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="chat">Pesan</label>
                        <textarea name="chat" class="form-control" rows="3" readonly>{{ $pesan->chat }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="feedback">Feedback</label>
                        <textarea name="feedback" class="form-control" rows="8" autofocus>{{ $pesan->feedback }}</textarea>
                    </div>
                    <div class="d-flex gap-1 mb-2 mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        <a href="{{ route('list.pesan') }}" class="btn btn-danger btn-sm"><i class="bi bi-arrow-left-circle"></i></a>
                    </div>
                </form>
            </div>
           </div>
        </section>
    </main>
@endsection
