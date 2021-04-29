@extends('layouts.master')

@section('title') Testimonial @stop

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
    <x-breadcrumb type="Testimonial" action="List" />
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                <div class="mb-30">
                        <a href="{{ route('testimonials.create') }}" class="btn btn-primary float-right mt-20"><i class="ion-plus"></i> Add Testimonial</a>
                    </div>
                    <h4 class="mt-0 header-title">@yield('title')</h4>
                    <p class="text-muted m-b-30 font-14">&nbsp;</p>
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Testifier</th>
                                <th>Testimony</th>
                                <th>Published?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $item)
                                <tr>
                                    <td>
                                        <img src="{{ URL::to($item->picture) }}" alt="" height="100" width="100">
                                    </td>
                                    <td style="width:200px;">
                                        <h2>{!! $item->name !!}</h2>
                                        <p>{!! $item->position !!}</p>
                                    </td>
                                    <td>
                                        {!! $item->testimony !!}
                                    </td>
                                    <td align="center">
                                        <x-status :state="$item->published" />
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('testimonials.edit', $item->id) }}"><span class="badge badge-pill badge-warning p-2"><i class="ion-edit"></i> Modify</span></a><br><br>
                                        @if($item->status == 1)
                                            <a href="{{ route('testimonials.action', $item->id) }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('publish').submit();">
                                                    <span class="badge badge-pill badge-success"><i class="ion-unlocked"></i> Published</span>
                                            </a>
                                            <form id="publish" action="{{ route('testimonials.action', $item->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="status" id="status" value=0>
                                            </form>
                                        @else
                                            <a href="{{ route('testimonials.action', $item->id) }}" 
                                                onclick="event.preventDefault();
                                                    document.getElementById('unpublish').submit();">
                                                    <span class="badge badge-pill badge-info p-2"><i class="ion-locked"></i> Unpublished</span>
                                            </a>
                                            <form id="unpublish" action="{{ route('testimonials.action', $item->id) }}" method="POST" class="d-none">
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