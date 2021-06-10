@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="card">
            <div class="card-header">
                <div class="title">Laravel Chat Application with Firebase
                    <a href="#" id="logout" class="float-right">Logout?</a>
                </div>
                <div class="users">Loading users ...</div>
            </div>
            <div class="card-body">
                Loading content ...
            </div>
            <div class="card-footer">
                <form id="chat-form">
                    <div class="input-group">
                        <input type="text" name="content" class="form-control" placeholder="Type your message ..."
                            autocomplete="off">
                        <div class="input-group-btn">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Welcome</h5>
                </div>
                <div class="modal-body">
                    <p>Before using this app, we need your nickname.</p>
                    <input type="text" class="form-control" name="user_name" placeholder="What's your nickname?">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="savename">Continue</button>
                </div>
            </div>
        </div>
    </div>
@endsection