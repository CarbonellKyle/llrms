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
                            <strong class="">For:</strong> {{ $file->grade_level!=0 ? 'Grade ' . $file->grade_level . ' Students' : 'Kinder Students'}}
                        </div>
                        <div class="form-group">
                            <strong class="">Subject:</strong> {{ $file->subject_name }}
                        </div>
                        <div class="form-group">
                            <strong class="">Description:</strong> {{ $file->filedescription }}
                        </div>
                        <div class="form-group">
                            <strong class="">Status:</strong> 
                                @if($file->verified==true)
                                    <span class="text-success">
                                        {{ 'Verified by ' . $file->verifiedby }}
                                    </span>

                                    @else
                                    <span @if($file->remarks!=null) class="text-warning" @else class="text-danger" @endif> 
                                        {{ $file->remarks!=null ? 'Reviewed by ' . $file->reviewedby : 'Unverified' }} 
                                    </span>
                                @endif
                        </div>
                        <a class="btn btn-info mt-2 w-100" href="/learningresource/openFile/{{ $file->id }}" target="_blank">Open File</a>
                    </div>
                </div>

                <!-- Remarks Section for Teacher View -->
                @if(auth()->user()->group_id==2)

                    @if(Session::has('review_submitted'))
                        <div class="alert alert-success mt-4" role="alert">
                            {{Session::get('review_submitted')}}
                        </div>
                    @endif

                    @if(Session::has('file_verified'))
                        <div class="alert alert-success mt-4" role="alert">
                            {{Session::get('file_verified')}}
                        </div>
                    @endif

                    <div class="card mt-2">
                        <div class="card-body">
                            <!-- Remarks Start -->
                            <h5>{{ $file->remarks!=null ? 'Remarks from ' . $file->reviewedby : 'Remarks' }}<h5>
                            <textarea disabled name="remarks" id="file_desciption" class="form-control my-2" style="height: 100px; resize: none;" placeholder="No remarks">{{ $file->remarks }}</textarea>
                            <!-- Remarks End -->
                                
                        </div>
                    </div>
                @endif  

                <!-- Remarks Section for Personnel View -->
                @if(auth()->user()->group_id==1)

                    @if(Session::has('review_submitted'))
                        <div class="alert alert-success mt-4" role="alert">
                            {{Session::get('review_submitted')}}
                        </div>
                    @endif

                    @if(Session::has('file_verified'))
                        <div class="alert alert-success mt-4" role="alert">
                            {{Session::get('file_verified')}}
                        </div>
                    @endif

                    <div class="card mt-2">
                        <div class="card-body">
                            <form method="POST" action="{{ route('learningresource.addRemarks') }}">
                                @csrf
                                <input type="hidden" name="file_id" value="{{ $file->id }}" >
                                <!-- Remarks Start -->
                                <h5>Remarks<h5>
                                <textarea name="remarks" id="file_desciption" class="form-control my-2" style="height: 100px; resize: none;" placeholder="Add Remarks">{{ $file->remarks }}</textarea>
                                <!-- Remarks End -->
                                
                                <button type="submit" class="btn btn-primary mt-2 w-100">Submit Review</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-2" @if($file->verified==true) hidden @endif>
                        <form method="POST" action="{{ route('learningresource.verifyFile') }}">
                            @csrf
                            <input type="hidden" name="file_id" value="{{ $file->id }}" >
                            <button type="submit" class="btn btn-sm btn-success w-100">Verify</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection