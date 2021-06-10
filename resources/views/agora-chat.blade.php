@extends('layouts.app')

@section('content')
    {{-- <agora-chat :allusers="{{ $users }}" :allclasses="{{ $classes }}" authuserid="{{ auth()->id() }}"
        authuser="{{ auth()->user()->name }}" agora_id="{{ env('AGORA_APP_ID') }}"
        :role="{{ \Auth::user()->role }}" /> --}}
    <div class="wrapper">
        <div class="card">
            <div class="card-header">
                <div class="title">Laravel Chat Application with Firebase</div>
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
@endsection

@section('scripts')
    <script>
        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("BJcOO9WOvGaaBjuOBItFAFFor3gSg-vwxk8Iq9Vk0AnLOIIwOl4G9uLYJhbPREPak80eJ1IEypdNpddH7fnM2yc");

        function sendTokenToServer(fcm_token) {
            const user_id = '{{ Auth::user()->id }}';

            axios.post('/api/save-token', {
                fcm_token, user_id
            }).then(res => {
                console.log(res);
            })
        }
        messaging.getToken().then((currentToken) => {
            if (currentToken) {
                // this.sendTokenToServer(currentToken);
                // Send the token to your server and update the UI if necessary
                // ...
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });

    </script>
@endsection
