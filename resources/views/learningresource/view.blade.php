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
        <h2 class="text-center">View File</h2>

        <a href="{{ route('learningresource.index') }}" class="btn btn-primary mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg> Back
        </a>
        
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center">
                <img src="{{ url($filepath) }}" class="img-fluid"/>
            </div>
            <div class="col-lg-6">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong class="">Filename:</strong> {{ $file->filename }}
                        </div>
                        <div class="form-group">
                            <strong class="">Filetype:</strong> {{ $file->filetype }}
                        </div>
                        <div class="form-group">
                            <strong class="">Filesize:</strong> {{ $file->filesize }}
                        </div>
                        <div class="form-group">
                            <strong class="">For:</strong> {{ 'Grade ' . $file->grade_level . ' Students' }}
                        </div>
                        <div class="form-group">
                            <strong class="">Subject:</strong> {{ $file->subject_name }}
                        </div>
                        <div class="form-group">
                            <strong class="">Description:</strong> {{ $file->filedescription }}
                        </div>
                        <div class="form-group">
                            <strong class="">Status:</strong> 
                                <span @if($file->verified==true) class="text-success" @else class="text-danger" @endif> 
                                    {{ $file->verified==true ? 'Verified' : 'Unverified' }} 
                                </span>
                        </div>
                        <a class="btn btn-info mt-2 w-100" href="/learningresource/openFile/{{ $file->id }}" target="_blank">Open File</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection