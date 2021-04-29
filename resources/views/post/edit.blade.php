@extends('layouts.master')

@section('title') Modify {{$news->title}} @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="News Post" action="Modify a news" />

    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($news, ['method' => 'PATCH', 'route' => ['news.update', $news->id], 'files' => true]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Modify {{ $news->title }}</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $news->title }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Published</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" id="switch1" class="form-control @error('published') is-invalid @enderror" name="published" switch="none" @if($news->published) checked @endif />
                                            <label for="switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('body') is-invalid @enderror" id="description" name="body" rows="6">{!! $news->body !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="form-group float-center">
                                    <img src="@if(is_null($news->picture)){{URL::to('assets/images/users/user-4.jpg')}} @else {{ URL::to($news->picture) }} @endif" id="photo" style="width:100%; height:250px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" id="picture" accept="image/*" onchange="showMyImage(this)" value="{{ old('picture') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Save Change
                                        </button>
                                        <a href="{{ route('news.index') }}" class="btn btn-secondary waves-effect m-l-5"><i class="ion-arrow-left-c"></i> Cancel</a>
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
</div>
@endsection

@section('script')
    <!--Wysiwig js-->
    <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>

<script>
    $(document).ready(function () {
        if($("#description").length > 0){
            tinymce.init({
                selector: "textarea#description",
                theme: "modern",
                height:200,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }
    });

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