@extends('layouts.master')

@section('title') Add Gallery @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Gallery" action="Add" />
    <div class="row">
        <div class="col-lg-12">
            <form class="" action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card m-b-20">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="category" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
                                            <option value=''>------- Select --------</option>
                                            <option value="news">News</option>
                                            <option value="service">Service</option>
                                            <option value="project">Project</option>
                                            <option value="category">Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="referred" class="col-sm-3 col-form-label">Relation</label>
                                    <div class="col-sm-9">
                                        <select name="referred" id="referred" class="form-control @error('referred') is-invalid @enderror">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="form-group">
                                    <div id="image_preview" class="col-lg-12"></div>
                                    <input type="file" multiple class="@error('picture') is-invalid @enderror" name="picture[]" id="picture" accept="image/*" onchange="preview_image();" />
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Upload Media
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection

@section('script')
<script>
    function preview_image() 
    {
        var total_file=document.getElementById("picture").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append(
                "<img width='180' src='"+URL.createObjectURL(event.target.files[i])+"'>"
            );
        }
    }

    $(function(){
        $('#category').change(function(){
            var ctype = $(this).val();
            $('#referred').html('<option selected="selected" value="">Loading...</option>');
            if(ctype != "") {
               
                $.ajax({
                    url:"{{ route('ctypes') }}",
                    data:{type:ctype},
                    type:'GET',
                    success:function(data) {
                        var resp = $.trim(data);
                        
                        $('#referred').html('<option selected="selected" value="">Select Relation</option>');
                        $.each(data, function(key, value) {

                            $('#referred').append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                });
            } else {
                $("#referred").html("<option value=''>------- Select --------</option>");
            }
        })
    });
</script>
@endsection