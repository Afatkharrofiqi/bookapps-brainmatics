@extends('layouts.app')

@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Form create book</div>
                    <div class="card-body">
                        @include('components.error-form')
                        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="book title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="cover" name="cover" value="{{ old('cover') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="year" name="year" value="{{ old('year') }}" placeholder="year">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="categories[]" multiple id="categories" class="form-select">
                                        @foreach ($categories as $key => $category)
                                            @forelse (old('categories') ?? [] as $selectedId)
                                                <option value="{{ $key }}" {{ $selectedId == $key ? 'selected' : '' }}>{{ $category }}</option>
                                                @empty
                                                <option value="{{ $key }}">{{ $category }}</option>
                                            @endforelse
                                        @endforeach
                                    </select>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#categories').select2({
            // ajax: {
            //     url: '{{ route('category.select2')}}',
            //     dataType: 'json',
            //     processResults: function(data){
            //         console.log({data});
            //         return {
            //             results: data.map(function(item){
            //                 return {id: item.id, text: item.name}
            //             })
            //         }
            //     }
            // }
        });
    </script>
@endsection
