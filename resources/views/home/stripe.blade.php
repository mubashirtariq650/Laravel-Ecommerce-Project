<!DOCTYPE html>

<html>

<head>
<base href="/public">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

</head>

<body>

    

<div class="container">

     <div class="hero_area">
         <!-- header section strats -->
     <span style="font-size: 18px;">    @include('home.header')  </span>

    

    <h1 style="text-align: center; font-size:24px;padding-bottom:20px;">Pay Using Your Card ${{$totalprice}}</h1>

    

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default credit-card-box">

                <div class="panel-heading display-table" >

                        <h3 class="panel-title" >Payment Details</h3>

                </div>

                <div class="panel-body">

    

                   



     @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            &times;
        </button>
        {{ session()->get('message') }}
    </div>
@endif

    

                    <form 

                            role="form" 

                            action="{{ route('stripe.post',$totalprice) }}" 

                            method="post" 

                            class="require-validation"

                            data-cc-on-file="false"

                            data-stripe-publishable-key="{{ config('services.stripe.key') }}"


                            id="payment-form">

                        @csrf

    

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group required'>

                                <label class='control-label'>Name on Card</label> <input

                                    class='form-control' size='4' type='text'>

                            </div>

                        </div>

    

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group card required'>

                                <label class='control-label'>Card Number</label> <input

                                    autocomplete='off' class='form-control card-number' size='20'

                                    type='text'>

                            </div>

                        </div>

    

                        <div class='form-row row'>

                            <div class='col-xs-12 col-md-4 form-group cvc required'>

                                <label class='control-label'>CVC</label> <input autocomplete='off'

                                    class='form-control card-cvc' placeholder='ex. 311' size='4'

                                    type='text'>

                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Month</label> <input

                                    class='form-control card-expiry-month' placeholder='MM' size='2'

                                    type='text'>

                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Year</label> <input

                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'

                                    type='text'>

                            </div>

                        </div>

    

                        <div class='form-row row'>

                            <div class='col-md-12 error form-group hide'>

                                <div class='alert-danger alert'>Please correct the errors and try

                                    again.</div>

                            </div>

                        </div>

    

                        <div class="row">

                            <div class="col-xs-12">

                                <input type="submit" name="" value="Pay Now">

                            </div>

                        </div>

                            

                    </form>

                </div>

            </div>        

        </div>

    </div>

        

</div>

    

</body>

    

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    

<script type="text/javascript">

  

$(function() {

  

    /*------------------------------------------

    --------------------------------------------

    Stripe Payment Code

    --------------------------------------------

    --------------------------------------------*/

    

    var $form = $(".require-validation");

     

    $('form.require-validation').bind('submit', function(e) {

        var $form = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',

                         'input[type=text]', 'input[type=file]',

                         'textarea'].join(', '),

        $inputs = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid = true;

        $errorMessage.addClass('hide');

    

        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {

          var $input = $(el);

          if ($input.val() === '') {

            $input.parent().addClass('has-error');

            $errorMessage.removeClass('hide');

            e.preventDefault();

          }

        });

     

        if (!$form.data('cc-on-file')) {

          e.preventDefault();

          Stripe.setPublishableKey("{{ config('services.stripe.key') }}");

          Stripe.createToken({

            number: $('.card-number').val(),

            cvc: $('.card-cvc').val(),

            exp_month: $('.card-expiry-month').val(),

            exp_year: $('.card-expiry-year').val()

          }, stripeResponseHandler);

        }

    

    });

      

    /*------------------------------------------

    --------------------------------------------

    Stripe Response Handler

    --------------------------------------------

    --------------------------------------------*/

    function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            /* token contains id, last4, and card type */

            var token = response['id'];

                 

            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }

     

});

</script>
 <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>

</html>