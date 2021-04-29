@extends('layouts.master')

@section('title') Our Client  @stop

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
    <x-breadcrumb type="Client" action="Management" />

    <div class="row">
        <div class="col-lg-5">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Creating a new Client</h4>
                    <hr>
                    @if($flag)
                        <form action="{{ route('clients.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Client Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Client Name" value="{{ old('name') }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="published" class="col-sm-3 col-form-label">Published</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" id="switch1" class="form-control @error('published') is-invalid @enderror" name="published" switch="none" />
                                        <label for="switch1" data-on-label="Yes"
                                                data-off-label="No"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="logo" class="col-sm-3 col-form-label">Client Logo</label>
                                <div class="col-sm-9">
                                    <img src="{{URL::to('assets/images/users/user-4.jpg')}}" class="" id="photo" style="width:100%; height:100px; margin-top:10px;" alt="Greenicc">
                                    <input type="file" id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo" accept="image/*" onchange="showMyImage(this)" value="{{ old('logo') }}" />
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <div class="">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('update.client', $client->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Client Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Client Name" value="{{ $client->name }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="published" class="col-sm-3 col-form-label">Published</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" id="switch1" class="form-control @error('published') is-invalid @enderror" name="published" switch="none" @if($client->published) checked @endif />
                                        <label for="switch1" data-on-label="Yes"
                                                data-off-label="No"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="logo" class="col-sm-3 col-form-label">Client Logo</label>
                                <div class="col-sm-9">
                                    <img @if(is_null($client->logo) || @empty($client->logo)) src="{{asset('assets/images/users/user-4.jpg')}}" @else src="{{ URL::to($client->logo) }}" @endif id="photo" style="width:100%; height:70px;" alt="Greenicc">
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" name="file" id="logo" accept="image/*" onchange="showMyImage(this)" />
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <div class="">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Save Changes
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
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
                                <th>Logo</th>
                                <th>Client Name</th>
                                <th>Published?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $item)
                                <tr>
                                    <td align="center">
                                        <img src="{{ URL::to($item->logo) }}" alt="" height="100" width="100">
                                    </td>
                                    <td>
                                        <h4>{!! $item->name !!}</h4>
                                    </td>
                                    <td>
                                        <x-status :state="$item->published" />
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('clients.edit', $item->id) }}"><span class="badge badge-pill badge-warning p-2"><i class="ion-edit"></i> Modify</span></a><br><br>
                                        @if($item->published == 1)
                                            <a href="{{ route('clients.action', $item->id) }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('publish').submit();">
                                                    <span class="badge badge-pill badge-success"><i class="ion-unlocked"></i> unpublished</span>
                                            </a>
                                            <form id="publish" action="{{ route('clients.action', $item->id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="published" id="published" value=0>
                                            </form>
                                        @else
                                            <a href="{{ route('clients.action', $item->id) }}" 
                                                onclick="event.preventDefault();
                                                    document.getElementById('unpublish').submit();">
                                                    <span class="badge badge-pill badge-info p-2"><i class="ion-locked"></i> Published</span>
                                            </a>
                                            <form id="unpublish" action="{{ route('clients.action', $item->id) }}" method="POST" class="d-none">
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

<script>
    function showMyImage(fileInput) {

        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) { 
            var file = files[i];
            var imageType = /image.*/; 

            if (!file.type.match(imageType)) {
                continue;
            } 

            var img=document.getElementById("photo"); 
            img.file = file; 
            var reader = new FileReader();

            reader.onload = (function(aImg) { 
                return function(e) { 
                aImg.src = e.target.result; 
                }; 
            })(img);

            reader.readAsDataURL(file);
        } 
    }
</script>
@endsection

