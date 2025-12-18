@extends('layouts.guest.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <!-- Foto Pengembang -->
                                <img src="{{ $developer['photo'] }}" alt="Foto Pengembang" class="img-fluid profile-img">
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $developer['name'] }}</h4>
                                <p><strong>NIM:</strong> {{ $developer['nim'] }}</p>
                                <p><strong>Program Studi:</strong> {{ $developer['prodi'] }}</p>

                                <h5>Social Media & Links</h5>
                                <ul>
                                    <li>
                                        <strong>LinkedIn:</strong> 
                                        <a href="{{ $developer['linkedin'] }}" target="_blank" class="d-inline-flex align-items-center">
                                            <i class="fab fa-linkedin me-2"></i> LinkedIn Profile
                                        </a>
                                    </li>
                                    <li>
                                        <strong>GitHub:</strong> 
                                        <a href="{{ $developer['github'] }}" target="_blank" class="d-inline-flex align-items-center">
                                            <i class="fab fa-github me-2"></i> GitHub Profile
                                        </a>
                                    </li>
                                    <li>
                                        <strong>Sosial Media:</strong> 
                                        <a href="{{ $developer['social_media'] }}" target="_blank" class="d-inline-flex align-items-center">
                                            <i class="fab fa-instagram me-2"></i> Instagram Profile
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
