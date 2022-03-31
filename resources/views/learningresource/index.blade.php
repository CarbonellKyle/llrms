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
        <h2 class="text-center">Learning Resources</h2><br>
        <a href="{{ route('learningresource.upload') }}" class="btn btn-primary mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
            </svg> Upload Files
        </a>

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
            <div class="table-responsive">
                <table class="table" id="filesUploadedTable">
                    <thead class=" text-info">
                        <th class="text-center">
                            Filename
                        </th>
                        <th class="text-center">
                            Filesize
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
                            Status
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
                                {{ $file->filesize }}
                            </td>
                            <td class="text-center">
                                {{ $file->grade_level!=0 ? 'Grade ' . $file->grade_level : 'Kinder' }}
                            </td>
                            <td class="text-center">
                                {{ $file->subject_name }}
                            </td>
                            <td class="text-center">
                                {{ $file->filedescription == null ? 'No Description' : $file->filedescription }}
                            </td>
                            @if($file->verified==true)
                                <td class="text-center text-success">
                                    {{ 'Verified' }}
                                </td>

                                    @else
                                    <td @if($file->remarks!=null) class="text-warning text-center" @else class="text-danger text-center" @endif>
                                    {{ $file->remarks!=null ? 'Reviewed' : 'Unverified' }}
                                    </td>

                            @endif
                            
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

@push('scripts')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#filesUploadedTable').DataTable();
        } );
    </script>
@endpush