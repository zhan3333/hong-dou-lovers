@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form>
                    <div class="form-group">
                        <label for="inputType">Type</label>
                        <input type="text" id="inputType" class="form-control" placeholder="Type">
                    </div>
                    <div class="form-group">
                        <label for="inputTo">To </label>
                        <input type="text" id="inputTo" class="form-control" placeholder="To">
                    </div>
                    <div class="form-group">
                        <label for="inputContent">Content</label>
                        <input type="text" id="inputContent" class="form-control" placeholder="Content">
                    </div>
                    <button id="sendMessage" type="button" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection