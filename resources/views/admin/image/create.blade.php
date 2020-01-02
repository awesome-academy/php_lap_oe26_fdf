@extends('admin.layout.master')
@section('title', trans('message.createImage'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('image.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">{{ trans('message.createImage') }} </h4>
                    <div class="">&nbsp</div>
                    <div class="">&nbsp</div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                            {{ trans('message.nameImage') }}
                        </label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="images" >
                            <span class=" alert-danger">{{ $errors->first('images') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                            {{ trans('message.imageProduct') }}
                        </label>
                        <div class="col-md-9">
                            <select class="select2 form-control custom-select" name="product" required>
                                <option selected disabled>
                                    {{ trans('message.actionimageProduct') }}
                                </option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="alert-danger">{{ $errors->first('product') }}</span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('message.submitCreate') }}
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
