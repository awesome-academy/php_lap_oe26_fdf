@extends('admin.layout.master')
@section('title', trans('message.editImage'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('image.update', $image->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">{{ trans('message.editImage')}} </h4>
                    <div class="">&nbsp</div>
                    <div class="">&nbsp</div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                            {{ trans('message.nameImage') }}
                        </label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="images" >
                            <img class="image" src="{{ asset('storage/images/' . $image->image) }}">
                            <span class=" alert-danger">{{ $errors->first('images') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                            {{ trans('message.imageProduct') }}
                        </label>
                        <div class="col-md-9">
                            <select class="select2 form-control custom-select" name="product" required>
                                <option selected disabled>{{ trans('message.actionimageProduct') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            @if ($product->id == $image->product_id) selected
                                            @endif>{{ $product->name }}
                                        </option>
                                    @endforeach
                            </select>
                            <span class=" alert-danger">{{ $errors->first('product') }}</span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('message.submitEditCategory') }}
                        </button>
                        <a class="btn btn-danger" href="{{ route('image.index') }}">
                            {{ trans('message.cane') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
