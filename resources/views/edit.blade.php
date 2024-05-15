@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ route('Project.index') }}">
                    Back
                </a>
            </div>
        </div>
    </div>
  
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Problems!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('Project.update', $Project->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" value= "{{ $Project->title }}">
                </div>
                <div class="form-group">
                    <strong>Project:</strong>
                    <input type="text" name="text" class="form-control" value= "{{ $Project->text }}">
                </div>
                <div class="form-group">
                    <strong>Responsible:</strong>
                    <input type="text" name="responsible" class="form-control" value= "{{ $Project->responsible }}">
                </div>
                <div class="form-group">
                    <strong>Start date:</strong>
                    <input type="date" name="sdate" class="form-control" value= "{{ $Project->sdate }}">
                </div>
                <div class="form-group">
                    <strong>End date:</strong>
                    <input type="date" name="edate" class="form-control" value= "{{ $Project->edate }}">
                </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Project status:</strong>
                <select name="status" class="form-select">
                    @php
                    $statuses = ['active', 'deleted', 'complete'];
                    @endphp
                    @foreach ($statuses as $status)
                        @if($status === $Project->status)
                            <option selected value="{{ $status }}">{{ $status }} </option>
                        @else
                            <option value="{{ $status }}">{{ $status }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
  
@endsection