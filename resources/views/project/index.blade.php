@extends('layouts.master')

@section('title') Project @stop

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />

<link href="{{ URL::asset('assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Project" action="List" />
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                <div class="mb-30">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary float-right mt-20"><i class="ion-plus"></i> Add Project</a>
                    </div>
                    <h4 class="mt-0 header-title">@yield('title')</h4>
                    <p class="text-muted m-b-30 font-14">&nbsp;</p>
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Title</th>
                                <th>Published?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>
                                        <img src="{{ URL::to($project->picture) }}" alt="" height="100" width="100">
                                    </td>
                                    <td>
                                        <h4><a href="{{route('projects.show', $project->id)}}">{!! $project->title !!}</a></h4>
                                        <p>{!! Str::limit($project->body, 230) !!}</p>
                                    </td>
                                    <td align="center">
                                        <x-status :state="$project->published" />
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('projects.edit', $project->id) }}"><span class="badge badge-pill badge-warning p-2"><i class="ion-edit"></i> Modify</span></a><br><br>
                                        @if($project->published == 1)
                                            <a href="{{ route('projects.action', $project->id) }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('publish').submit();">
                                                    <span class="badge badge-pill badge-success"><i class="ion-unlocked"></i> Published</span>
                                            </a>
                                            <form id="publish" action="{{ route('projects.action', $project->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="published" id="published" value=0>
                                            </form>
                                        @else
                                            <a href="{{ route('projects.action', $project->id) }}" 
                                                onclick="event.preventDefault();
                                                    document.getElementById('unpublish').submit();">
                                                    <span class="badge badge-pill badge-info p-2"><i class="ion-locked"></i> Unpublished</span>
                                            </a>
                                            <form id="unpublish" action="{{ route('projects.action', $project->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="published" id="published" value=1>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js')}}"></script>
@endsection