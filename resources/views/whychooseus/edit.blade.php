@extends('layouts.master')

@section('title') Why Choose Us  @stop

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
    <x-breadcrumb type="Why Choose Us" action="Management" />

    <div class="row">
        <div class="col-lg-5">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Make Changes</h4>
                    <hr>
                    {!! Form::open(['route' => ['update.coreValues', $choice->id], 'method' => 'POST']) !!}
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                            <div class="col-sm-9">
                                <input type="text" id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Icon" value="{{ $choice->icon }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="heading" class="col-sm-3 col-form-label">Heading</label>
                            <div class="col-sm-9">
                                <input type="text" id="heading" name="heading" class="form-control @error('heading') is-invalid @enderror" placeholder="Heading" value="{{ $choice->heading }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">{{ $choice->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Save Changes
                                </button>
                                <a href="{{ route('coreValues.index') }}" class="btn btn-secondary waves-effect m-l-5"><i class="ion-arrow-left-c"></i> Cancel</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">@yield('title')</h4>
                    <p class="text-muted m-b-30 font-14">&nbsp;</p>
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Display Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($choices as $item)
                                <tr>
                                    <td align="center">
                                        <i class="{!! $item->icon !!}"></i><br>
                                        {{ $item->icon }}
                                    </td>
                                    <td>
                                        <h2>{!! $item->heading !!}</h2>
                                        <p>{!! $item->description !!}</p>
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('coreValues.edit', $item) }}"><span class="badge badge-pill badge-warning p-2"><i class="ion-edit"></i> Modify</span></a><br><br>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
