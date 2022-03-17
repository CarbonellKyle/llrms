@extends('layouts.personnelLayout', ['active' => 'verify'])

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
        <h2 class="text-center">Unverified Files</h2>
        <br><br>

        @if(Session::has('file_verified'))
            <div class="alert alert-success mt-4" role="alert">
                {{Session::get('file_verified')}}
            </div>
        @endif

        @if($numRows==0)
            <div class="alert alert-warning" role="alert">
                {{'There are no unverified files'}}
            </div>

            @else
            <div class="table-responsive">
                <table class="table" id="unverifiedFilesTable">
                    <thead class=" text-info">
                        <th class="text-center">
                            Uploader
                        </th>
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
                            Action
                        </th>
                    </thead>
                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="text-center">
                                {{ $file->first_name . ' ' . $file->last_name}}
                            </td>
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
                            <td class="text-center">
                                <a class="btn btn-sm btn-info mb-1 w-100" href="/learningresource/openFile/{{ $file->id }}" target="_blank">Preview File</a>
                                <form method="POST" action="{{ route('learningresource.verifyFile') }}">
                                    @csrf
                                    <input type="hidden" name="file_id" value="{{ $file->id }}" >
                                    <button type="submit" class="btn btn-sm btn-success w-100">Verify</button>
                                </form>
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
            $('#unverifiedFilesTable').DataTable();
        } );
    </script>
@endpush