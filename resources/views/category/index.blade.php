@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List of Category</div>
                    <div class="card-body">
                        @include('components.alert')
                        <div class="pb-2">
                            <a href="{{ route('category.create') }}" class="btn btn-dark">Create new Category</a>
                        </div>
                        <table class="table">
                            <thead class="table-dark">
                                <th>No</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key => $category)
                                    <tr>
                                        <td>{{$categories->firstItem() + $key}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->created_at}}</td>
                                        <td>{{$category->updated_at}}</td>
                                        <td class="justify-content-between">
                                            <a href="#" class="btn btn-primary">Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Category is empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

