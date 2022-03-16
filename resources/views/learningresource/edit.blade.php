@extends($layout, $data) 
<!-- $layout is the layout file to extend, $data contains variables to be pass at the layout file from the controller -->

@section('content')
<div id="content" class="content-wrapper p-3">
  	<button id="sidebarCollapse" type="button" class="btn bg-color-3 rounded-pill shadow-sm px-4 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
  	
    <div class="col-lg-12">
        <h2 class="text-center">Edit File Info</h2>
        <a href="{{ route('learningresource.index') }}" class="btn btn-primary mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg> Back
        </a>
        
        @if(Session::has('file_updated'))
            <div class="alert alert-success mt-4" role="alert">
                {{Session::get('file_updated')}}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="title m-0">{{ __('Edit File Info') }}</h5>
            </div>
            <div class="card-body">
            <form action="{{ route('learningresource.updateFile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $file->id }}">
                <!-- Hidden since user already logged in -->
                <input type="hidden" name="uploadedbyid" value="{{ auth()->user()->id }}">

                <!-- Input File Start -->
                <!--<input type="file" name="file" class="form-control">-->
                <img style="height: auto; width: 150px;" src="{{ url($filepath) }}"/><br>
                <a class="btn btn-info mt-2" href="/learningresource/openFile/{{ $file->id }}" target="_blank">Open File</a>
                <!-- Input File End -->

                <br>
                <div class="form-floating my-2">
                    <input type="text" name="filename" value="{{ $file->filename }}" placeholder="Filename"  class="form-control" style="height: 60px; resize: none;" >
                    <label for="filename">Filename</label>
                </div>
                <!-- Grade Level Select Start -->
                <div class="form-floating my-2">
                    <select class="form-select" id="grade_level" name="grade_level">
                        <option value="{{ $file->grade_level }}" selected hidden>{{ $file->grade_level!=0 ? 'Grade ' . $file->grade_level : 'Kinder'}}</option>
                        <option value="0">Kinder</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5">Grade 5</option>
                        <option value="6">Grade 6</option>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                        <option value="11">Grade 11</option>
                        <option value="12">Grade 12</option>
                    </select>
                    <label for="grade_level">Grade Level</label>
                </div>
                <!-- Grade Level Select End -->

                <!-- Subject Start -->
                <div class="form-floating">
                    <select class="form-select" id="subject_name" name="subject_name">
                        <option value="{{ $file->subject_name }}" selected  hidden>{{ $file->subject_name }}</option>
                    </select>
                    <label for="subject_name">Subject</label>
                </div>
                <!-- Subject End -->

                <!-- File Description Start -->
                <textarea name="filedescription" id="file_desciption" class="form-control my-2" style="height: 100px; resize: none;" placeholder="Description">{{ $file->filedescription }}</textarea>
                <!-- File Description End -->

                <button class="btn btn-primary w-100" type="submit">Update</button>
            </form>
        </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    $('#grade_level').on('change', function(){
        $('#subject_name').html('');
        if ($('#grade_level').val() == 0){
            $('#subject_name').append('<option value="Domain 1">Domain 1</option>');
            $('#subject_name').append('<option value="Domain 2">Domain 2</option>');
            $('#subject_name').append('<option value="Domain 3">Domain 3</option>');
            $('#subject_name').append('<option value="Domain 4">Domain 4</option>');
            $('#subject_name').append('<option value="Domain 5">Domain 5</option>');
            $('#subject_name').append('<option value="Domain 6">Domain 6</option>');
            $('#subject_name').append('<option value="Domain 7">Domain 7</option>');
        }
        if ($('#grade_level').val() == 1){
            $('#subject_name').append('<option value="MTB">MTB</option>');
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
        }
        if ($('#grade_level').val() == 2){
            $('#subject_name').append('<option value="MTB">MTB</option>');
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
        }
        if ($('#grade_level').val() == 3){
            $('#subject_name').append('<option value="MTB">MTB</option>');
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
        }
        if ($('#grade_level').val() == 4){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="EPP">EPP</option>');
        }
        if ($('#grade_level').val() == 5){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="EPP">EPP</option>');
        }
        if ($('#grade_level').val() == 6){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="EPP">EPP</option>');
        }
        if ($('#grade_level').val() == 7){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="TLE">TLE</option>');
        }
        if ($('#grade_level').val() == 8){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="TLE">TLE</option>');
        }
        if ($('#grade_level').val() == 9){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="TLE">TLE</option>');
        }
        if ($('#grade_level').val() == 10){
            $('#subject_name').append('<option value="EsP">EsP</option>');
            $('#subject_name').append('<option value="Arapan">Arapan</option>');
            $('#subject_name').append('<option value="Math">Math</option>');
            $('#subject_name').append('<option value="Mapeh">Mapeh</option>');
            $('#subject_name').append('<option value="English">English</option>');
            $('#subject_name').append('<option value="Filipino">Filipino</option>');
            $('#subject_name').append('<option value="Science">Science</option>');
            $('#subject_name').append('<option value="TLE">TLE</option>');
        }
        if ($('#grade_level').val() == 11){
            $('#subject_name').append('<option value="21st Century">21st Century</option>');
            $('#subject_name').append('<option value="Earth Science">Earth Science</option>');
            $('#subject_name').append('<option value="General Mathematics">General Mathemathics</option>');
            $('#subject_name').append('<option value="Kumonikasyon">Kumonikasyon</option>');
            $('#subject_name').append('<option value="Oral Communication">Oral Communication</option>');
            $('#subject_name').append('<option value="Physical Education">Physical Education</option>');
            $('#subject_name').append('<option value="Empowerment Technology">Empowerment Technology</option>');
            $('#subject_name').append('<option value="TVL">TVL</option>');
        }
        if ($('#grade_level').val() == 12){
            $('#subject_name').append('<option value="21st Century">21st Century</option>');
            $('#subject_name').append('<option value="English for Academic">English for Academic</option>');
            $('#subject_name').append('<option value="Personal Development">Personal Development</option>');
            $('#subject_name').append('<option value="Practical Research 1">Practical Research 1</option>');
            $('#subject_name').append('<option value="Practical Research 2">Practical Research 2</option>');
            $('#subject_name').append('<option value="Physical Education">Physical Education</option>');
            $('#subject_name').append('<option value="TVL">TVL</option>');
        }
    });
</script>
@endpush
