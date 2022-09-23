@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Form edit book</div>
                    <div class="card-body">
                        @include('components.error-form')
                        <form method="POST" action="{{ route('book.update', ['book' => $book->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}" placeholder="book title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="cover" name="cover" value="{{ old('cover') }}">
                                    <div class="mt-2">
                                        @if (str_contains($book->cover, 'html'))
                                            <img src="{{ $book->cover }}" width="100" />
                                            @else
                                            <img src="{{ asset('storage/'. $book->cover) }}" width="100" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="year" name="year" value="{{ $book->year ?? old('year') }}" placeholder="year">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="categories[]" multiple id="categories" class="form-select" data-placeholder="Choose category">
                                        @foreach ($categories as $key => $category)
                                            @forelse (old('categories') ?? [] as $selectedId)
                                                    <option value="{{ $key }}" {{ $selectedId == $key ? 'selected' : '' }}>{{ $category }}</option>
                                                @empty
                                                    @forelse ($book->categories as $cat)
                                                        <option value="{{ $key }}" {{ $cat->id == $key ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                    @empty
                                                        <option value="{{ $key }}">{{ $category }}</option>
                                                    @endforelse
                                            @endforelse
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created_by" class="col-sm-2 col-form-label">Created By</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="created_by" readonly value="{{ $book->createdBy->name }}">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#categories').select2({});
    </script>
@endsection
