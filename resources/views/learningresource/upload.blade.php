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
        <a href="{{ route('learningresource.index') }}" class="btn btn-primary mb-2">Manage Resources</a>
        <div class="card">
            <div class="card-header">
                <h5 class="title m-0">{{ __('Upload Files') }}</h5>
            </div>
            <div class="card-body">
            <form action="{{ route('learningresource.uploadSubmit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Hidden since user already logged in -->
                <input type="hidden" name="uploadedbyid" value="{{ auth()->user()->id }}">

                <!-- Input File Start -->
                <input type="file" name="file" class="form-control">
                <!-- Input File End -->

                <!-- Grade Level Select Start -->
                <div class="form-floating my-2">
                    <select class="form-select" id="grade_level" name="grade_level">
                        <option value="0" selected>Kinder</option>
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
                        <option value="D1">Domain 1</option>
                        <option value="D2">Domain 2</option>
                        <option value="D3">Domain 3</option>
                        <option value="D4">Domain 4</option>
                        <option value="D5">Domain 5</option>
                        <option value="D6">Domain 6</option>
                        <option value="D7">Domain 7</option>
                    </select>
                    <label for="subject_name">Subject</label>
                </div>
                <!-- Subject End -->

                <!-- File Description Start -->
                <textarea name="filedescription" id="file_desciption" class="form-control my-2" style="height: 100px; resize: none;" placeholder="Description"></textarea>
                <!-- File Description End -->

                <button class="btn btn-primary w-100" type="submit">Upload</button>
            </form>
        </div>
        </div>
    </div>

    <script>
        $('#grade_level').on('change', function(){
            $('#subject_name').html('');
            if ($('#grade_level').val() == 0){
                $('#subject_name').append('<option value="D1">Domain 1</option>');
                $('#subject_name').append('<option value="D2">Domain 2</option>');
                $('#subject_name').append('<option value="D3">Domain 3</option>');
                $('#subject_name').append('<option value="D4">Domain 4</option>');
                $('#subject_name').append('<option value="D5">Domain 5</option>');
                $('#subject_name').append('<option value="D6">Domain 6</option>');
                $('#subject_name').append('<option value="D7">Domain 7</option>');
            }
            if ($('#grade_level').val() == 1){
                $('#subject_name').append('<option value="MTB">MTB</option>');
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
            }
            if ($('#grade_level').val() == 2){
                $('#subject_name').append('<option value="MTB">MTB</option>');
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
            }
            if ($('#grade_level').val() == 3){
                $('#subject_name').append('<option value="MTB">MTB</option>');
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
            }
            if ($('#grade_level').val() == 4){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="EPP">EPP</option>');
            }
            if ($('#grade_level').val() == 5){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="EPP">EPP</option>');
            }
            if ($('#grade_level').val() == 6){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="EPP">EPP</option>');
            }
            if ($('#grade_level').val() == 7){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="TLE">TLE</option>');
            }
            if ($('#grade_level').val() == 8){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="TLE">TLE</option>');
            }
            if ($('#grade_level').val() == 9){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="TLE">TLE</option>');
            }
            if ($('#grade_level').val() == 10){
                $('#subject_name').append('<option value="ESP">EsP</option>');
                $('#subject_name').append('<option value="ARAPAN">Arapan</option>');
                $('#subject_name').append('<option value="MATH">Math</option>');
                $('#subject_name').append('<option value="MAPEH">Mapeh</option>');
                $('#subject_name').append('<option value="ENGLISH">English</option>');
                $('#subject_name').append('<option value="FILIPINO">Filipino</option>');
                $('#subject_name').append('<option value="SCIENCE">Science</option>');
                $('#subject_name').append('<option value="TLE">TLE</option>');
            }
            if ($('#grade_level').val() == 11){
                $('#subject_name').append('<option value="21ST-CEN">21st Century</option>');
                $('#subject_name').append('<option value="EARTH-SCI">Earth Science</option>');
                $('#subject_name').append('<option value="GEN-MATH">General Mathemathics</option>');
                $('#subject_name').append('<option value="KUMONIKASYON">Kumonikasyon</option>');
                $('#subject_name').append('<option value="ORAL-COMM">Oral Communication</option>');
                $('#subject_name').append('<option value="PE">Physical Education</option>');
                $('#subject_name').append('<option value="EMP-TECH">Empowerment Technology</option>');
                $('#subject_name').append('<option value="TVL">TVL</option>');
            }
            if ($('#grade_level').val() == 12){
                $('#subject_name').append('<option value="21ST-CEN">21st Century</option>');
                $('#subject_name').append('<option value="ENG-FOR-ACAD">English for Academic</option>');
                $('#subject_name').append('<option value="PER-DEV">Personal Development</option>');
                $('#subject_name').append('<option value="PRACTICAL-1">Practical Research 1</option>');
                $('#subject_name').append('<option value="PRACTICAL-2">Practical Research 2</option>');
                $('#subject_name').append('<option value="PE">Physical Education</option>');
                $('#subject_name').append('<option value="TVL">TVL</option>');
            }
        });
    </script>
@endsection