<script>
$(document).ready(function() {

  var currentRequest1 = null;
  function load_container() {
    if (currentRequest1 != null) {
      currentRequest1.abort();
      currentRequest1 = null;
    }
    currentRequest1 = $.ajax({
      url: '<?=$global_domain?>/root/secure/form/billings/form-load-container',
      type: 'POST',
      beforeSend: function(response) {
        $('#load-container').html('<div class="text-center pt-3 pb-3"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
      },
      success: function(response) {
        $('#load-container').html(response);
      },
      error: function(response) {
        console.log(response);
      }
    });
  }

  $(document).ready(function(){

    load_container();

    $('.dropdown-item').click(function(){
      if (currentRequest1) {
        currentRequest1.abort();
      }
    });

  });

});

function load_payment_methods(){
  $.ajax({
      url: '<?=$global_domain?>/root/secure/form/billings/form-billings-method',
      type: 'POST',
      beforeSend: function(response) {
        $('#payments-div').html('<div class="text-center pt-3 pb-3"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
      },
      success: function(response) {
        $('#payments-div').html(response);
      },
      error: function(response) {
        console.log(response);
      }
    });
}

$(document).on('click', '#add_recent_payment', function() {
  	$.ajax({
      url: 'root/secure/form/billings/form-add-recent-payment',
      type: 'POST',
      data: {
        bank_name_value: $('#bank_name_value').val(),
        bank_acc_number: $('#bank_acc_number').val(),
        transaction_value: $('#transaction_value').val()
      },
      success: function(response) {
        if (response == 1) {
          alert('Bank name is empty');
        }
        if (response == 2) {
          alert('Bank account number is empty');
        } 
        if (response == 3) {
          alert('Transaction value is empty');
        }  
        if (response == 100) {
          location.reload()
        }
  		}
  	});
  });
  $(document).on('click', '#remove_recent_payment', function() {
  	$.ajax({
      url: 'root/secure/form/billings/form-remove-recent-payment',
      context: this,
      type: 'POST',
      data: {
        bank_id: this.previousElementSibling.value,
      },
      success: function(response) {
        if (response == 100) {
          location.reload()
        }
  		}
  	});
  });
</script>
