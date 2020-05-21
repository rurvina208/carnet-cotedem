@extends('identification.layouts.app')
@section('title','Fondos')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'background.create','btnText'=>'Crear','textTitle'=>'Fondos'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'background.index','method'=>'GET'])}}
                        <div class="input-group">
                                <select class="custom-select custom-select-sm"
                                        name="institution_id"
                                        id="institution_id">
                                    <option value="" selected>
                                        {{__('Search by Institution')}}
                                    </option>
                                    @foreach($institutions as $institution)
                                            <option value="{{$institution->institution->id}}">
                                                {{$institution->institution->INS_NOMBRE}}
                                            </option>
                                    @endforeach
                                </select>
                    <span class="input-group-btn">
                          <button
                              type="submit"
                              class="btn btn-xs" >{{__('Search')}}
                          </button>
                    </span>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of backgrounds')}}
                        {{$backgrounds->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Front Background')}}</th>
                            <th>{{__('Back Background')}}</th>
                            <th>{{__('Institution')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($backgrounds as $background)
                            <tr>
                                <td>
                                    <img width="150px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE)}}">

                                    <br />
                                    <small>
                                        {{__('Created_at')}} {{$background->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <img width="150px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE2)}}">

                                </td>
                                <td class="project_progress">
                                    <a href="{{route('institution.show',$background->institution->id)}}">
                                     {{$background->institution->INS_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('background.show',$background)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('background.edit',$background)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                    <form action="{{route('background.destroy',$background->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                          <h1>{{__('There are no registered backgrounds')}}</h1>
                        @endforelse
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
        <!-- end project list -->
{{--    </div>--}}
</div>
</div>
</div>
    <!-- /page content -->
@endsection

