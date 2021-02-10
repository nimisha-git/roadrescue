var $=jQuery;
 $(document).on('click','#searchbtn', function(e)  { 
 $('#dealer-location-list').show();  
 $('#dealer-location-list .fusion-column-wrapper').empty(); 
  var state = $('#states').val();
  data = {
      'action': 'dealer_list', // that's how we get params from wp_localize_script() function
      'state' : state,
    };
  $.ajax({ // you can also use $.post here
      url : "../wp-admin/admin-ajax.php", // AJAX handler
      data : data,
      type : 'POST',
      success: function(data) {
        $('#dealer-location-list .fusion-column-wrapper').empty(); 
        $('#dealer-location-list .fusion-column-wrapper').append('<div class="row" id="dealers">'+data+'</div>');
        jQuery("html, body").animate({
          scrollTop: jQuery("#dealer-location-list").offset().top
        },1000);
      }
    });
});
 
