@extends('components.layouts.admin')
@section('content')
    <x-layouts.header></x-layouts.header>
    <x-layouts.aside></x-layouts.aside>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Saran Fitur</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Saran Fitur</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="alert alert-danger text-center">Disclaimer: 1 akun hanya bisa 1x request</div>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Request Fitur</h3>
                    <div class="d-flex flex-column ">
                        @forelse ($pesan as $data)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2 mb-2 me-auto">
                                    <img src="{{ asset('storage/foto_profil/' . $data->user->foto) }}" alt="Foto Profil"
                                        class="rounded-circle" width="55px">
                                    <div class="d-flex flex-column mt-1">
                                        <h6 class="text-secondary">{{ $data->user->name }}</h6>
                                        <h6 style="font-weight: bold; font-size: 0.6em;">
                                            {{ $data->created_at->translatedFormat('l, d F Y') }}</h6>
                                    </div>
                                </div>
                                @if (Auth::user()->id === $data->user_id)
                                    <form action="{{ route('admin.delete', $data->id) }}" method="POST"
                                        class="delete-form ms-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button style="border: none; background: transparent;" class="mb-5"><i
                                                class="bi bi-trash" style="color: grey;"></i></button>
                                    </form>
                                @endif
                            </div>
                            <p style="text-align: justify">
                                {{ $data->chat }}
                            </p>
                            @if ($data->feedback)
                            
                            <div class="feedback-container" id="feedback-{{ $data->id }}"
                                    style="display: none; margin-left: 30px;">
                                    <div class="d-flex gap-2">
                                        <img src="{{ asset('storage/foto_profil/' . $data->user->foto) }}" alt=""
                                            class="rounded-circle" width="38px">
                                        <div class="d-flex flex-column">
                                            <h6 class="text-secondary" style="font-size: 10px">Admin</h6>
                                            <h6 style="font-weight: bold; font-size: 0.4em;">
                                                {{ $data->updated_at->translatedFormat('l, d F Y') }}
                                            </h6>
                                        </div>
                                    </div>  
                                    <p style="text-align: justify; font-size: 12px;">
                                        {{ $data->feedback }}
                                    </p>    
                                </div>
                                <a href="#" class="text-secondary text-center lihat-balasan-btn"
                                    data-target="#feedback-{{ $data->id }}">Lihat balasan</a>
                            @endif
                        @empty
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/image/404.jpg') }}" alt="" class="img-fluid"
                                    width="500px">
                            </div>
                        @endforelse
                    </div>
                    {{ $pesan->links() }}

                </div>
            </div>
            @if (!$userSend)
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.send_chat') }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <textarea name="chat" placeholder="Ketik pesan....." style="border: none; resize: none; outline: none; width: 100%"
                                    rows="3"></textarea>
                            </div>
                            <button type="submit" style="border: none; background: blue; border-radius: 50%"><i
                                    class="bi bi-arrow-up" style="color: white"></i></button>
                            <button type="reset" style="border: none; background: grey; border-radius: 50%"><i
                                    class="bi bi-arrow-clockwise" style="color: white"></i></button>
                        </form>
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.lihat-balasan-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const targetId = this.getAttribute('data-target');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement.style.display === 'none') {
                        targetElement.style.display = 'block';
                        this.textContent = 'Sembunyikan balasan';
                    } else {
                        targetElement.style.display = 'none';
                        this.textContent = 'Lihat balasan';
                    }
                });
            });

            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Apa kamu yakin?",
                        text: "Data ini akan dihapus secara permanen!!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, saya yakin!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
