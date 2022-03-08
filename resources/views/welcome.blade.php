@extends('layouts.app')

@section('content')

<style>
    @media (max-width: 991.98px) {
        .site-grid {
            height: 800px;
        }
    }
</style>
<div class="site-grad">
    <div class="site-grid">
        <section id="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h2 class="text-center">Learning Resources Management and Development System <span class="h5">v1.0</span></h2>
                                <p class="h5 text-justify py-3">Personnels, Teachers, and Students from Division of Gingoog City can now upload and download resources through this system.</p>
                                <ul>
                                    <li>Personnels can download and upload resources.</li>
                                    <li>Teachers can download and upload learning resources.</li>
                                    <li>Students can download learning resources.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1 text-center">
                        <img src="{{ asset('images/deped-gingoog-logo.png') }}" class="img-fluid" alt="Google Sign In"> 
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

 @endsection