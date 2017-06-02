@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-1">{{Auth::id()}}</div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="to" class="col-md-4 control-label">to</label>

                                <div class="col-md-6">
                                    <input id="to" type="text" class="form-control" name="to" value="{{ old('to') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">type</label>

                                <div class="col-md-6">
                                    <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-4 control-label">content</label>

                                <div class="col-md-6">
                                    <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection