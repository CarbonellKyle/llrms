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
        <a href="{{ route('learningresource.upload') }}" class="btn btn-primary mt-4">Upload Files</a>

        @if(Session::has('delete_file'))
            <div class="alert alert-danger mt-4" role="alert">
                {{Session::get('delete_file')}}
            </div>
        @endif

        <h3 class="mt-4">Recent Uploaded Files</h3>
        @if($numRows==0)
            <div class="alert alert-warning" role="alert">
                    {{'You haven\'t upload any files yet!'}}
            </div>

            @else
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-info">
                        <th class="text-center">
                            Filename
                        </th>
                        <th class="text-center">
                            Grade Level
                        </th>
                        <th class="text-center">
                            Subject
                        </th>
                        <th class="text-center">
                            Description
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </thead>
                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="text-center">
                                {{ $file->filename . '.' . $file->filetype}}
                            </td>
                            <td class="text-center">
                                {{ $file->grade_level }}
                            </td>
                            <td class="text-center">
                                {{ $file->subject_name }}
                            </td>
                            <td class="text-center">
                                {{ $file->filedescription == null ? 'No Description' : $file->filedescription }}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-info" href="/learningresource/viewFile/{{ $file->id }}">
                                    View
                                </a>
                                <a class="btn btn-sm btn-warning" href="/learningresource/editFile/{{ $file->id }}">
                                     Edit
                                </a>
                                <a class="btn btn-sm btn-danger" href="/learningresource/deleteFile/{{ $file->id }}">
                                     Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection