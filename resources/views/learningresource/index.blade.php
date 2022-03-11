@extends($layout, $data) <!-- $layout is the layout file to extend, $data contains variables to be pass at the layout file from the controller -->

@section('css')
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div id="content" class="content-wrapper p-3">
  	<button id="sidebarCollapse" type="button" class="btn bg-color-3 rounded-pill shadow-sm px-4 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>

    <div class="col-lg-12">
        <h2 class="text-center">Learning Resources</h2>
        <a href="{{ route('learningresource.upload') }}" class="btn btn-primary mb-4">Upload Files</a>

        @if(Session::has('delete_file'))
            <div class="alert alert-danger mt-4" role="alert">
                {{Session::get('delete_file')}}
            </div>
        @endif
        
        @if($numRows==0)
            <div class="alert alert-warning" role="alert">
                {{'You haven\'t upload any files yet!'}}
            </div>

            @else
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="filesUploadedTable">
                            <thead>
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
                                        <a class="btn btn-sm btn-primary" href="/learningresource/viewFile/{{ $file->id }}">
                                            View
                                        </a>
                                        <a class="btn btn-sm btn-warning" href="#">
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
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#filesUploadedTable').DataTable();
        } );
    </script>
@endpush