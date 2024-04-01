
var amountt = $("#t_amount").val();

var idpay = document.getElementById("Id_paypal");
var stats = document.getElementById("Status_paypal");
var emailpay = document.getElementById("emailpay");
var iduserpay = document.getElementById("iduserpay");
///referenciando alos inputs de order done

paypal.Buttons({

    onClick() {
                var pais=$("#item-details-countryValue").val();
                var estado=$("#item-details-stateValue ").val();                                         
                var cuidad=$("#item-details-cityValue").val();
                var dir=$("#direc").val();
                
                console.log(pais,estado,cuidad,dir);
             
               
                if(pais===null||estado===null||cuidad===null||dir===''){
                      console.log('los campos estan vacios');
                    
               $("#orderform").submit();  
                }
                else {
                    console.log('los campos no estan vacios');
                }
               

    },

    style: {
        shape: 'pill',
        color: 'blue',
        layout: 'vertical',
        label: 'pay',

    },
    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
        return actions.order.create({
            purchase_units: [{
                    amount: {
                        value: amountt // Can also reference a variable or function
                    }
                }]
        });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
        return actions.order.capture().then(function (orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            //transaaccion paypal
            const transaction = orderData.purchase_units[0].payments.captures[0];
            idpay.value = transaction.id;
            stats.value = transaction.status;
            //datos de usuariopaypal
            const usuario = orderData.payer;
            emailpay.value = usuario.email_address;
            iduserpay.value = usuario.payer_id;
            //paypalData.value=JSON.stringify(orderData, null, 2);
        $("#orderform").submit(); 
//                                      $.ajax({
//                                        method: 'post',
//                                        url: 'http://localhost/Master_PHP/PHP_POO/Shop/order/done',
//                                        data: {stado: transaction.status}
//
//                                    });
            ///window.location.href = "http://localhost/Master_PHP/PHP_POO/Shop/order/done&datos="+transaction.status;
            //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
             //actions.redirect('http://localhost/Master_PHP/PHP_POO/Shop/order/confirmado');
           
        });
        
    
    }
}).render('#paypal-button-container');

                