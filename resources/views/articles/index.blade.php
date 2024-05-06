@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Management</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#editTabs" type="button" role="tab" aria-controls="contact" aria-selected="false" style="display: none">Edit</button>
            </li>
        </ul>
        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="card-header">Manage Articles</div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="/create" method="post">
                    @csrf
                    <div class="row">
                        <lable>Title</lable>
                        <input type="text" name="title" placeholder="Title">
                    </div>
                    <div class="row">
                        <lable>Description</lable>
                        <input type="text" name="description" placeholder="Description">
                    </div>


                    <div class="row">
                        <lable>Tags</lable>
                        <select class="tags" name="tags[]" style="width: 100%" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <lable>Categories</lable>
                        <select class="categories" name="categories" style="width: 100%">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <lable>Is Active</lable>
                        <select class="isActive" name="isActive" style="width: 100%">
                            <option value="0">no</option>
                            <option value="1">yes</option>
                        </select>
                    </div>
                    <input type="submit" value="submit">
                </form>
            </div>
            <div class="tab-pane fade" id="editTabs" role="tabpanel" aria-labelledby="editTabs">
                3
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

