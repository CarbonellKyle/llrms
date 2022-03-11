@extends($layout, $data) 
<!-- $layout is the layout file to extend, $data contains variables to be pass at the layout file from the controller -->

@section('content')
<div id="content" class="content-wrapper p-3">
  	<button id="sidebarCollapse" type="button" class="btn bg-color-3 rounded-pill shadow-sm px-4 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>

    <div class="col-lg-12 container">
        <h2 class="text-center">Learning Resource</h2>

        <a class="btn btn-primary" href="{{ route('learningresource.index') }}">Back</a>
        
        <h3 class="mt-4">View File</h3>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <img style="height: auto; width: 150px;" src="{{ url($filepath) }}"/><br>
            <a class="btn btn-info mt-2" href="/learningresource/openFile/{{ $file->id }}">Open File</a>

            <div class="mt-4">
                <div class="form-group">
                    <strong class="">Filename:</strong>
                        {{ $file->filename }}
                </div>
                <div class="form-group">
                    <strong class="">Filetype:</strong>
                        {{ $file->filetype }}
                </div>
                <div class="form-group">
                    <strong class="">For:</strong>
                        {{ 'Grade ' . $file->grade_level . ' Students' }}
                </div>
                <div class="form-group">
                    <strong class="">Subject:</strong>
                        {{ $file->subject_name }}
                </div>
                <div class="form-group">
                    <strong class="">Description:</strong>
                        {{ $file->filedescription }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection