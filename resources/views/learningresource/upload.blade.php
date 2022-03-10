@extends($layout, $data) 
<!-- $layout is the layout file to extend, $data contains variables to be pass at the layout file from the controller -->

@section('content')
<div id="content" class="content-wrapper p-3">
  	<button id="sidebarCollapse" type="button" class="btn bg-color-3 rounded-pill shadow-sm px-4 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
  	<div class="container">
        <h2 class="text-center">Learning Resource</h2>
        <h3>Upload Files<h3>
        <div class="col-md-6">
            @error('file')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror

            @if(Session::has('file_uploaded'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('file_uploaded')}}
                </div>
            @endif
            <form action="{{ route('learningresource.uploadSubmit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="uploadedbyid" value="{{ auth()->user()->id }}">
                File: <input type="file" name="file" class="form-control">
                Grade Level: <input type="number" name="grade_level" class="form-control">
                Subject: <input type="text" name="subject_name" class="form-control">
                Description: <input type="text" name="filedescription" class="form-control">
                <button class="btn btn-primary" type="submit">Upload</button>
            </form>
        </div>
    </div>
@endsection