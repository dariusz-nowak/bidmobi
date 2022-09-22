<script>
$(document).ready(function() {

  var currentRequest1 = null;
  function load_total_revenues_graph() {
    if (currentRequest1 != null) {
      currentRequest1.abort();
      currentRequest1 = null;
    }
    currentRequest1 = $.ajax({
      url: '<?=$global_domain?>/root/secure/form/dashboard/form-load-total-revenues-graph',
      data: {
        select_date: $('#bm_select_date').val()
      },
      type: 'POST',
      beforeSend: function(response) {
        $('#load_total_revenues_graph').html('<div class="text-center pt-3 pb-3"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
      },
      success: function(response) {
        $('#load_total_revenues_graph').html(response);
      },
      error: function(response) {
        console.log(response);
      }
    });
  }

  $(document).ready(function(){

    load_total_revenues_graph();

    $('.dropdown-item').click(function(){
      if (currentRequest1) {
        currentRequest1.abort();
      }
    });

    $('#bm_select_date').change(function(){
      load_total_revenues_graph();
    });

  });

});
</script>
