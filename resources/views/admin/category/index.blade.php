 @extends('admin.layout.master')
 @section('title', trans('message.categoryAdmin'))
 @section('content')
 <div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h3 class="page-title">{{ trans('message.category') }}</h3>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ trans('message.home') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ trans('message.category') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="{{ route('category.create') }}">
                            {{ trans('message.createCategory') }}
                        </a>
                        <div class="">&nbsp</div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr class="btn-info">
                                    <th class=""> {{ trans('message.nameCategory') }}</th>
                                    <th class="">{{ trans('message.descriptionCategory') }}</th>
                                    <th class="">{{ trans('message.parent') }}</th>
                                    <th class="">{{ trans('message.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $cate)
                                    <tr>
                                        <td>{{ $cate->name }}</td>
                                        <td>{{ $cate->description }}</td>
                                        <td>
                                            @if ($cate->parent_id == 0)
                                                {{ trans('message.foodsCategory') }}
                                            @else
                                                {{ trans('message.dinksCategory') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $cate->id) }}"
                                                class="btn btn-warning">
                                                <span class="fa fa-edit"> {{ trans('message.btnEdit') }}</span>
                                            </a>
                                            <a data-id="{{ $cate->id }}" data-url="{{ route('category.destroy', $cate->id) }}"
                                                class=" delete btn btn-danger">
                                                <span class="fa fa-trash"></span>
                                                {{ trans('message.btnDelete') }}
                                            </a>
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
