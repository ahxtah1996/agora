@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">Payment Details</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            {{-- <form id="payment-form" method="POST" data-parsley-validate
                                action="{{ route('order-post') }}">
                                @csrf
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <div id="product-group" class="form-group">
                                    <label for="plane">Select Plan:</label>
                                    <select required="required" data-parsley-class-handler="#product-group" id="plane"
                                        name="plane" class="form-control">
                                        <option value="price_100">Movie ($100)</option>
                                        <option value="price_50">Game ($50)</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div id="card-element"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" id="card-button" class="btn btn-lg btn-block btn-success btn-order">Place order
                                        !</button>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="payment-errors" id="card-errors"
                                            style="color: red;margin-top:10px;"></span>
                                    </div>
                                </div>
                            </form> --}}
                            {!! Form::open(['url' => route('order-post'), 'data-parsley-validate', 'id' => 'payment-form']) !!}
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="form-group" id="product-group">
                        {!! Form::label('plane', 'Select Plan:') !!}
                        {!! Form::select('plane', ['price_***' => 'Game ($50)','price_***' => 'Movie ($100)'], null, [
                            'class'                       => 'form-control',
                            'required'                    => 'required',
                            'data-parsley-class-handler'  => '#product-group'
                            ]) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="card-element"></div>
                            </div>
                        </div>
                          
                    </div>
                      <div class="form-group">
                          <button id="card-button" class="btn btn-lg btn-block btn-success btn-order">Place order !</button>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <span class="payment-errors" id="card-errors" style="color: red;margin-top:10px;"></span>
                        </div>
                      </div>
                    {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('script')

    <!-- PARSLEY -->
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };

    </script>

    <script src="http://parsleyjs.org/dist/parsley.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ env('STRIPE_KEY') }}', {
            locale: 'en'
        }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const card = elements.create('card', {
            style: style
        }); // Create an instance of the card Element.

        card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        console.log(stripe)

        form.addEventListener('submit', function(event) {
            console.log(111)
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                console.log(result)
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>

@endsection
