@include('layouts.header')
    <link rel="stylesheet" href="{{ asset('css/tms_subscription.css') }}">
    
    <br>
    
    <div class="container d-flex mt-5">
        
        @foreach($packages as $package)
            <div class="card mx-2">
                <div class="card-body">
                    <h3><center>{{ $package->name }}</center></h3>    
                    <p>{{ $package->description }}</p>
                    <h5><center>${{ $package->amount }}</center></h5>
                    
                </div>
                <div class="card-footer">
                    <div id="paypal-button-{{$package->name}}">
                        <script>
                            paypal.Buttons({
                                style: {
                                       layout: 'horizontal',
                                       color: 'black',
                                       shape: 'rect',
                                       label: 'pay',
                                       height: 50
                                    },
                           
                               // Sets up the transaction when a payment button is clicked
                               createOrder: function (data, actions) {
                                   return actions.order.create({
                                       purchase_units: [{
                                           amount: {
                                               value: {{ $package->amount }} // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                           },
                                           payee: {
                                               email_address: 'sb-jrxtl8639213@personal.example.com'
                                           }
                                       }]
                               
                                   });
                               },
                           
                               // Finalize the transaction after payer approval
                               onApprove: function (data, actions) {
                                   return actions.order.capture().then(function (orderData) {
                                       var transaction = orderData.purchase_units[0].payments.captures[0];
                                       var paymentAmount = orderData.purchase_units[0];
                                       
                                        var amountValue = paymentAmount['amount'].value;
                                        var t_id = transaction.id;
                                        var card_limit = '30';
                                         
                                        $.ajax({
                                            url : "{{ route('create_gold_subscription') }}",
                                            method : "POST",
                                            data : {"_token" : "{{csrf_token()}}" , amount : amountValue , transaction_id : t_id , card_limit : card_limit , card_type : 'paypal', "subscription_plan":{{ $package->id }}},
                                            success : function (response) {
                                                if(response){
                                                    window.location.href="{{ route('index') }}";    
                                                }
                                            }
                                          
                                        });
                                   });
                               }
                            }).render('#paypal-button-{{$package->name}}');
                        </script>
                    </div>    
                </div>
            </div>
        @endforeach
    </div>
    
    
    
    
    
    
    
    {{-- <div class="card-div">
        
        <div class="membership-card-1">
            <h3>Silver</h3>
            <h1>$9.99</h1>
            <div class="para-div">
                <p>
                    In plan 1 you will have all the features with Client and Users.
                </p>
            </div>

            <div id="paypal-button-silver">
                <script>
                    paypal.Buttons({
                        style: {
                               layout: 'horizontal',
                               color: 'black',
                               shape: 'rect',
                               label: 'pay',
                               height: 50
                            },
                   
                       // Sets up the transaction when a payment button is clicked
                       createOrder: function (data, actions) {
                           return actions.order.create({
                               purchase_units: [{
                                   amount: {
                                       value: 9.99 // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                   },
                                   payee: {
                                       email_address: 'sb-jrxtl8639213@personal.example.com'
                                   }
                               }]
                       
                           });
                       },
                   
                       // Finalize the transaction after payer approval
                       onApprove: function (data, actions) {
                           return actions.order.capture().then(function (orderData) {
                               var transaction = orderData.purchase_units[0].payments.captures[0];
                               var paymentAmount = orderData.purchase_units[0];
                               
                                var amountValue = paymentAmount['amount'].value;
                                var t_id = transaction.id;
                                var card_limit = '30';
                                 
                                $.ajax({
                                    url : "{{ route('create_gold_subscription') }}",
                                    method : "POST",
                                    data : {"_token" : "{{csrf_token()}}" , amount : amountValue , transaction_id : t_id , card_limit : card_limit , card_type : 'paypal', "subscription_plan":1},
                                    success : function (response) {
                                        if(response){
                                            window.location.href="{{ route('index') }}";    
                                        }
                                    }
                                  
                                });
                           });
                       }
                    }).render('#paypal-button-silver');
                </script>
            </div>    
        </div>
        
        
        
        <div class="membership-card-2">
            <h3>Gold</h3>
            <h1>$19.99</h1>
            <div class="para-div">
                <p>
                    In GOLD subscription you are allowed to create more than one users.    
                </p>
            </div>
            
            <div id="paypal-button-gold">
                <script>
                    paypal.Buttons({
                       
                       
                        style: {
                               layout: 'horizontal',
                               color: 'black',
                               shape: 'rect',
                               label: 'pay',
                               height: 50
                            },
                   
                       
                       // Sets up the transaction when a payment button is clicked
                       createOrder: function (data, actions) {
                           return actions.order.create({
                               purchase_units: [{
                                   amount: {
                                       value: 19.99 // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                   },
                                   payee: {
                                       email_address: 'sb-jrxtl8639213@personal.example.com'
                                   }
                               }]
                       
                           });
                       },
                   
                       // Finalize the transaction after payer approval
                       onApprove: function (data, actions) {
                           return actions.order.capture().then(function (orderData) {
                               
                               // Successful capture! For dev/demo purposes:
                               console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                               var transaction = orderData.purchase_units[0].payments.captures[0];
                               console.log('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                               var paymentAmount = orderData.purchase_units[0];
                               
                                var amountValue = paymentAmount['amount'].value;
                                var t_id = transaction.id;
                                var card_limit = '30';
                                 
                                $.ajax({
                                    url : "{{ route('create_gold_subscription') }}",
                                    method : "POST",
                                    data : {"_token" : "{{csrf_token()}}" , amount : amountValue , transaction_id : t_id , card_limit : card_limit , card_type : 'paypal', "subscription_plan":2},
                                    success : function (response) {
                                        if(response){
                                            window.location.href="{{ route('index') }}";    
                                        }
                                    }
                                  
                                });
                           });
                       }
                    }).render('#paypal-button-gold');
                
                </script>
            </div>                
        </div>
        
        
        <div class="membership-card-3">
            <form action="" method="POST">
                @csrf
                <h3>Diamond</h3>
                <h1>$29.99</h1>
                <div class="para-div">
                    <p>
                        Plan 3 includes social posting ability<br>
                        Facebook, Twitter, LinedIn<br>
                        and have some more social posting.
                    </p>
                </div>
                
                <div id="paypal-button-diamond">
                    <script>
                        paypal.Buttons({
                           
                           
                            style: {
                                   layout: 'horizontal',
                                   color: 'black',
                                   shape: 'rect',
                                   label: 'pay',
                                   height: 50
                                },
                       
                           
                           // Sets up the transaction when a payment button is clicked
                           createOrder: function (data, actions) {
                               return actions.order.create({
                                   purchase_units: [{
                                       amount: {
                                           value: 29.99 // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                       },
                                       payee: {
                                           email_address: 'sb-jrxtl8639213@personal.example.com'
                                       }
                                   }]
                           
                               });
                           },
                       
                           // Finalize the transaction after payer approval
                           onApprove: function (data, actions) {
                               return actions.order.capture().then(function (orderData) {
                                   var transaction = orderData.purchase_units[0].payments.captures[0];
                                   var paymentAmount = orderData.purchase_units[0];
                                   
                                    var amountValue = paymentAmount['amount'].value;
                                    var t_id = transaction.id;
                                    var card_limit = '30';
                                     
                                    $.ajax({
                                        url : "{{ route('create_gold_subscription') }}",
                                        method : "POST",
                                        data : {"_token" : "{{csrf_token()}}" , amount : amountValue , transaction_id : t_id , card_limit : card_limit , card_type : 'paypal', "subscription_plan":3},
                                        success : function (response) {
                                            if(response){
                                                window.location.href="{{ route('index') }}";    
                                            }
                                        }
                                      
                                    });
                               });
                           }
                        }).render('#paypal-button-diamond');
                    </script>
                </div>
            </form>
        </div>
        
    </div> --}}
    
@include('layouts.footer')