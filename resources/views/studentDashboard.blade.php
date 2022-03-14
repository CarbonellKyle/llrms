@extends('layouts.app')

@section('css')
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="site-grad">
    <div class="site-grid">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Available Resources') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($numRows==0)
                        <div class="alert alert-warning" role="alert">
                                {{'No files to download yet!'}}
                        </div>

                        @else
                        <div class="table-responsive">
                            <table class="table" id="studentResourcesTable">
                                <thead>
                                    <th class="text-center">
                                        Filename
                                    </th>
                                    <th class="text-center">
                                        Filetype
                                    </th>
                                    <th class="text-center">
                                        FileSize
                                    </th>
                                    <th class="text-center">
                                        Subject
                                    </th>
                                    <th class="text-center">
                                        Uploaded By
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
                                            {{ $file->filename }}
                                        </td>
                                        <td class="text-center">
                                            {{ $file->filetype }}
                                        </td>
                                        <td class="text-center">
                                            file size
                                        </td>
                                        <td class="text-center">
                                            {{ $file->subject_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $file->first_name . ' ' . $file->last_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $file->filedescription }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info mb-1 w-100" href="/student/resources/previewFile/{{ $file->id }}">Preview File</a>
                                            <form method="GET" action="{{ route('download') }}">
                                                <input type="hidden" name="file_id" value="{{ $file->id }}" >
                                                <button class="btn btn-sm btn-primary w-100">Download File</button>
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
        </div>
    </div>
</div>


@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#studentResourcesTable').DataTable();
        } );
    </script>
@endpush