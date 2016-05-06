<?php
require_once('config.inc.php');
require('php/phpbitadmin.class.php');
include('php/tooltip_content.php');
include('php/init_ui_vars.php'); 
include('php/www_rd_bconf_request.php'); 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bitcoin Node</title>

<!-- jQuery CDNs --> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<!-- UI Support files -->
<link rel="stylesheet" href="css/m_phpbitadmin.css" />
<link rel="stylesheet" href="css/tooltip.css" />
<script src="js/ui_functions.js"></script>

<style>
#minrelaytxfee_id .ui-rangeslider-sliders {
    margin: 0.5em 100px !important;
}
#minrelaytxfee_id input.ui-input-text.ui-slider-input {
    width: 170px !important;
}
input[type=number] {
    width: 80px;
}
.ui-slider-track {
    margin-left: 130px;
}
</style>
<script type="text/javascript">
    $(document).bind("pagecreate", function () {
					    $.mobile.ajaxEnabled = false;
						});
</script>

<style>
input.normal {
     width: 45px !important;
    display: inline-block; }
</style>

</head>
<body>

<!-------------------------------------------------
HOME Page
---------------------------------------------------->
<div data-role="page" id="home" data-theme="a">
    <?php include "html/menu.html"; ?>
    <?php include "html/header.html"; ?>
    <?php include "html/home_page.php"; ?>
</div>

<!-------------------------------------------------
DEVICE STATUS Page
---------------------------------------------------->
<div data-role="page" id="device-status" data-theme="a">
    <?php include "html/menu.html"; ?>
    <?php include "html/header.html"; ?>
   <?php include "html/dev_status_page.php"; ?>
</div>


<!-------------------------------------------------
Bitcoin Configuration Page
---------------------------------------------------->
<div data-role="page" id="bitcoin_conf" data-theme="a">
    <?php include "html/menu.html"; ?>
    <?php include "html/header.html"; ?>
    <?php include "html/dev_bcupdate_page.php"; ?>
</div>

<!-------------------------------------------------
CONTROLS Page
---------------------------------------------------->
<div data-role="page" id="controls" data-theme="a">
    <?php include "html/menu.html"; ?>
    <?php include "html/header.html"; ?>
    <?php include "html/dev_control_page.php"; ?>
</div>

<!-------------------------------------------------
About Page
---------------------------------------------------->
<div data-role="page" id="about" data-theme="a">
    <?php include "html/menu.html"; ?>
    <?php include "html/header.html"; ?>
    <?php include "html/about_page.php"; ?>
</div>

<script>
// -----------------------------------------------------------------
//  This is the Ajax call for the bitcoin.conf updates to transfer 
//  data to the server-side.  
// -----------------------------------------------------------------
$("#bitcoinconf_form").submit(function( e ) {
      var r;
      r = confirm("Are you sure that you want to update these parameters in bitcoin.conf and restart bitcoind?");
	  if (r == false) {
	      return;
      }
      e.preventDefault();
      var postData = $("#bitcoinconf_form").serialize();
      // var formURL = $(this).attr("action");
      var request = $.ajax({
          // url: formURL,
		  url: "php/www_wr_bconf_mbox.php",
          type: 'POST',
          dataType: "html",
          data: postData 
     });
     request.done(function(msg) {
        $("#bitcoin_status").html(msg);          
     });
     request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
     });
});
// -----------------------------------------------------------------
</script>

<script>
// -----------------------------------------------------------------
//  This is the Ajax call for the actual Bitnodes registration
// -----------------------------------------------------------------
$("#bitnodes_reg_form").submit(function( e ) {
     e.preventDefault();
     var postData = $("#bitnodes_reg_form").serialize();
     var formURL = $(this).attr("action");
     var request = $.ajax({
         url: formURL,
         type: 'POST',
         dataType: "html",
         data: postData 
     });
     request.done(function(msg) {
       $("#bitcoin_status").html(msg);
    });
     request.fail(function(jqXHR, textStatus) {
         alert( "Request failed: " + textStatus );
    });
});
// -----------------------------------------------------------------
</script>

</body>
</html>
<?php // ob_flush(); ?>

