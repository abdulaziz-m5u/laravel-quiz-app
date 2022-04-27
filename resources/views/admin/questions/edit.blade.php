@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit question')}}</h1>
                    <a href="{{ route('admin.questions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="question_text">{{ __('question text') }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text" value="{{ old('question_text', $question->question_text) }}" />
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control"  name="category_id" id="category">
                            @foreach($categories as $id => $category)
                                <option {{ $id == $question->category->id ? 'selected' : null }} value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @php $i=1 @endphp
                    @foreach($question->questionOptions as $question)
                    <div class="form-group">
                        <label for="question_text">Option {{ $i }}</label>
                        <input type="hidden" name="id[]" value="{{ $question->id}}">
                        <textarea class="form-control" id="question_text" placeholder="1" name="option[]"> {{ $question->option_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_text">Point To Answer {{ $i }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="Point To Answer 1" name="point[]" value="{{ $question->points }}" />
                    </div>
                    @php $i++ @endphp
                    @endforeach

                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection