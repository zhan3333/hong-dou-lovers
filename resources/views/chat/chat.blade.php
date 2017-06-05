@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2">Type</label>
                        <div class="col-sm-10">
                            <input type="text" id="inputType" class="form-control" placeholder="Type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTo" class="col-sm-2">To </label>
                        <div class="col-sm-10">
                            <input type="text" id="inputTo" class="form-control" placeholder="To">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContent" class="col-sm-2">Content</label>
                        <div class="col-sm-10">
                            <input type="text" id="inputContent" class="form-control" placeholder="Content">
                        </div>
                    </div>
                    <button id="sendMessage" type="button" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection