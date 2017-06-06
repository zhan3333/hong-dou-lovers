@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2">Type </label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="inputType" id="inputType" value="1" checked> 单聊
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inputType" id="inputType" value="2"> 群聊
                            </label>
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
                            <div class="row">
                                <div class="col-sm-8 col-xs-8">
                                    <input type="text" id="inputContent" class="form-control" placeholder="Content">
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <button id="sendMessage" type="button" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection