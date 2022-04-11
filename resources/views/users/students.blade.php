@extends('layouts.teacherLayout', ['active' => 'students'])

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
        <h2 class="text-center">List of Students</h2>
        <h5 class="text-center">{{ $school }}</h5>
        <br><br>

        @if($numRows==0)
            <div class="alert alert-warning" role="alert">
                {{'There are no students registered in this system yet'}}
            </div>

            @else
            <div class="table-responsive">
                <table class="table" id="studentsTable">
                    <thead class=" text-info">
                        <th class="text-center">
                            Name
                        </th>
                        <th class="text-center">
                            Grade Level
                        </th>
                    </thead>
                    <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center">
                                {{ $student->first_name . ' ' . $student->last_name}}
                            </td>
                            <td class="text-center">
                                {{ $student->name }}
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
            $('#studentsTable').DataTable();
        } );
    </script>
@endpush