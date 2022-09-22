<script>
$(document).ready(function() {

  var currentRequest1 = null;
  function load_container() {
    if (currentRequest1 != null) {
      currentRequest1.abort();
      currentRequest1 = null;
    }
    currentRequest1 = $.ajax({
      url: '<?=$global_domain?>/root/secure/form/account/form-load-container',
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

  $(document).on('click', '#cl-change-email', function() {
  	$.ajax({
      url: 'root/secure/form/account/form-change-email',
      type: 'POST',
      data: {
        new_email: $('#new_email').val()
      },
      success: function(response) {
        if (response == 1) {
          alert('Bad email');
        }
        if (response == 2) {
          alert('Email exists');
        }  
        if (response == 100) {
          $('.is-invalid').removeClass('is-invalid');
          alert('Success');
          /*
          setTimeout(function() {
    				location.reload();
    			}, 300);
          */
        }
  		}
  	});
  });

  $(document).on('click', '#cl-change-password', function() {
  	$.ajax({
      url: 'root/secure/form/account/form-change-password',
      type: 'POST',
      data: {
        new_password: $('#new_password').val(),
        confirm_new_password: $('#confirm_new_password').val()
      },
      success: function(response) {
        if (response == 1) {
          alert('Too long password');
        }
        if (response == 2) {
          alert('Change something...');
        } 
        if (response == 3) {
          alert('the passwords do not match');
        }  
        if (response == 100) {
          $('.is-invalid').removeClass('is-invalid');
          alert('Success');
        }
  		}
  	});
  });

  $(document).on('click', '#cl-set-company', function() {
  	$.ajax({
      url: 'root/secure/form/account/form-change-company',
      type: 'POST',
      data: {
        company_name: $('#company_name').val(),
        email: $('#email').val(),
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val()

      },
      success: function(response) {
        console.log(response);
        if (response == 1) {
          alert('Invalid company name');
        }
        if (response == 2) {
          alert('Bad email');
        }  
        if (response == 3) {
          alert('Email exists');
        }
        if (response == 4) {
          alert('Invalid first name');
        }
        if (response == 5) {
          alert('Invalid last name');
        }
        if (response == 100) {
          $('.is-invalid').removeClass('is-invalid');
          alert('Success');
          /*
          setTimeout(function() {
    				location.reload();
    			}, 300);
          */
        }
  		}
  	});
  });

  $(document).on('click', '#cl-set-billing', function() {
  	$.ajax({
      url: 'root/secure/form/account/form-change-billing',
      type: 'POST',
      data: {
        billing_email: $('#billing_email').val()
      },
      success: function(response) {
        console.log(response);
        if (response == 1) {
          alert('Bad email');
        }
        if (response == 2) {
          alert('Email exists');
        }  
        if (response == 100) {
          $('.is-invalid').removeClass('is-invalid');
          alert('Success');
          /*
          setTimeout(function() {
    				location.reload();
    			}, 300);
          */
        }
  		}
  	});
  });

  $(document).on('click', '#cl-set-address', function() {
  	$.ajax({
      url: 'root/secure/form/account/form-change-address',
      type: 'POST',
      data: {
        address_line1: $('#address_line1').val(),
        address_line2: $('#address_line2').val(),
        address_line3: $('#address_line3').val()

      },
      success: function(response) {
        console.log(response);
        if (response == 1) {
          alert('Invalid address 1');
        }
        if (response == 2) {
          alert('Invalid address 2');
        }
        if (response == 3) {
          alert('Invalid address 3');
        }  
        if (response == 100) {
          $('.is-invalid').removeClass('is-invalid');
          alert('Success');
          /*
          setTimeout(function() {
    				location.reload();
    			}, 300);
          */
        }
  		}
  	});
  });

});
</script>
