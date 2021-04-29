@extends('layouts.master')

@section('title') Category @stop

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
    <x-breadcrumb type="Category" action="List" />
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                <div class="mb-30">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary float-right mt-20"><i class="ion-plus"></i> Add Category</a>
                    </div>
                    <h4 class="mt-0 header-title">@yield('title')</h4>
                    <p class="text-muted m-b-30 font-14">&nbsp;</p>
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Display Text</th>
                                <th>Published?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td style="width: 100px;">
                                        <img src="{{ URL::to($category->cover) }}" alt="" height="100" width="300">
                                    </td>
                                    <td>
                                        <h2>{!! $category->heading !!}</h2>
                                        <p>{!! $category->description !!}</p>
                                    </td>
                                    <td align="center">
                                        <x-status :state="$category->status" />
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('categories.edit', $category->id) }}"><span class="badge badge-pill badge-warning p-2"><i class="ion-edit"></i> Modify</span></a><br><br>
                                        @if($category->status == 1)
                                            <a href="{{ route('categories.action', $category->id) }}"
                                                onclick="confirm('Do you want to publish Category?');
                                                    document.getElementById('publish').submit();">
                                                    <span class="badge badge-pill badge-success"><i class="ion-unlocked"></i> Published</span>
                                            </a>
                                            <form id="publish" action="{{ route('categories.action', $category->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="status" id="status" value=0>
                                            </form>
                                        @else
                                            <a href="{{ route('categories.action', $category->id) }}" 
                                                onclick="event.preventDefault();
                                                    document.getElementById('unpublish').submit();">
                                                    <span class="badge badge-pill badge-info p-2"><i class="ion-locked"></i> Unpublished</span>
                                            </a>
                                            <form id="unpublish" action="{{ route('categories.action', $category->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="status" id="status" value=1>
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