@extends('layout') 
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Project Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('Project.create') }}">
                    Add New Project
                </a>
            </div>
        </div>
    </div> 
 
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif 
 
    <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Project</th>
            <th>Responsible</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th style="width:280px">Action</th>
        </tr> 
 
        @foreach($Project as $project)
            <tr>
                <td>{{ ++$i }}</td>
                <td style="background:aqua; font-weight: bold">{{ $project->title}}</td>
                
                @if ($project->status == 'deleted')
                    <td style="background:red">{{ $project->text }}</td>
                    <td style="background:red">{{ $project->responsible}}</td> 
                    <th style="background:red">{{ $project->sdate}}</th>
                    <th style="background:red">{{ $project->edate}}</th>
                    <td style="background:red">Deleted</td>
                @elseif($project->status == 'active')
                    <td style="background:yellow">{{ $project->text }}</td>
                    <td style="background:yellow">{{ $project->responsible}}</td> 
                    <th style="background:yellow">{{ $project->sdate}}</th>
                    <th style="background:yellow">{{ $project->edate}}</th>
                    <td style="background:yellow">Active</td>
                @else
                    <td style="background:green">{{ $project->text }}</td>
                    <td style="background:green">{{ $project->responsible}}</td> 
                    <th style="background:green">{{ $project->sdate}}</th>
                    <th style="background:green">{{ $project->edate}}</th>
                    <td style="background:green">Complete

                @endif  
                   
 
                <td>
                    <form action="{{ route('Project.destroy', $project->id) }}" method="POST">
                        <a class="btn btn-info"
                            href="{{ route('Project.show', $project->id) }}">
                            Show
                        </a> 
 
                        <a class="btn btn-primary"
                            href="{{ route('Project.edit', $project->id) }}">
                            Edit
                        </a> 
 
                        {{-- @csrf
                        @method('DELETE')
                        --}} 
 
                        {{ csrf_field() }}
                       {{ method_field('DELETE') }}
  
 
                        <button type="submit" class="btn btn-danger">
                            Edit Status
                        </button> 
            
                    </form>
             
                </td>
            </tr>
        @endforeach
    </table> 
 
    {!! $Project->links() !!} 
 
@endsection