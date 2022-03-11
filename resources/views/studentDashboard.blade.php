@extends('layouts.app')

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
                                <table class="table">
                                    <thead class=" text-info">
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
                                                {{ $file->filedescription }}
                                            </td>
                                            <td class="text-center">
                                                <form method="GET" action="{{ route('download') }}">
                                                    <input type="hidden" name="file_id" value="{{ $file->id }}" >
                                                    <button>Download File</button>
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


@endsection