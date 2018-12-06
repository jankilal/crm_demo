<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>CRM Sense</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <!-- mobile settings -->
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <!-- WEB FONTS -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />
      <!-- CORE CSS -->
      <link href="<?php echo base_url(); ?>webroot/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- THEME CSS -->
      <link href="<?php echo base_url(); ?>webroot/css/essentials.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>webroot/css/layout.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>webroot/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
      <link href="<?php echo base_url(); ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>webroot/css/jquery-ui.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="<?php echo base_url() ?>webroot/css/fastselect.min.css">
      <link href="<?php echo base_url() ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="<?php echo base_url() ?>webroot/css/custom_main.css">
      <script type="text/javascript" src="<?php echo base_url(); ?>webroot/plugins/jquery/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/jquery.validate.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/additional-methods.min.js"></script>
        <script type="text/javascript">
      var plugin_path = '<?php echo base_url(); ?>webroot/plugins/';
      var webroot_path = '<?php echo base_url(); ?>webroot/js/';
      var base_url = '<?php echo base_url(); ?>';
      </script>
   <style type="text/css">
      .shadow-none{
         box-shadow:none;
         border: none;
      }
      .quote-wrapper{height: 600px;
         overflow-y:auto;
      }

      .quote-wrapper::-webkit-scrollbar-track
      {
         -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
         background-color: #F5F5F5;
         opacity: 0;
      }

      .quote-wrapper::-webkit-scrollbar
      {
         width: 6px;
         background-color: #F5F5F5;
         opacity: 0;
      }

      .quote-wrapper::-webkit-scrollbar-thumb
      {
         background-color: #000000;
         opacity: 0;
      }
      .quote-wrapper:hover::-webkit-scrollbar-track{ opacity: 1 }
      .quote-wrapper:hover::-webkit-scrollbar-thumb{ opacity: 1 }

   </style>
   <script type="text/javascript">
    function convertNumberToWords(amount) 
    {
         var words = new Array();
         words[0] = '';
         words[1] = 'One';
         words[2] = 'Two';
         words[3] = 'Three';
         words[4] = 'Four';
         words[5] = 'Five';
         words[6] = 'Six';
         words[7] = 'Seven';
         words[8] = 'Eight';
         words[9] = 'Nine';
         words[10] = 'Ten';
         words[11] = 'Eleven';
         words[12] = 'Twelve';
         words[13] = 'Thirteen';
         words[14] = 'Fourteen';
         words[15] = 'Fifteen';
         words[16] = 'Sixteen';
         words[17] = 'Seventeen';
         words[18] = 'Eighteen';
         words[19] = 'Nineteen';
         words[20] = 'Twenty';
         words[30] = 'Thirty';
         words[40] = 'Forty';
         words[50] = 'Fifty';
         words[60] = 'Sixty';
         words[70] = 'Seventy';
         words[80] = 'Eighty';
         words[90] = 'Ninety';
         amount = amount.toString();
         var atemp = amount.split(".");
         var number = atemp[0].split(",").join("");
         var n_length = number.length;
         var words_string = "";
         if (n_length <= 9) {
             var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
             var received_n_array = new Array();
             for (var i = 0; i < n_length; i++) {
                 received_n_array[i] = number.substr(i, 1);
             }
             for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                 n_array[i] = received_n_array[j];
             }
             for (var i = 0, j = 1; i < 9; i++, j++) {
                 if (i == 0 || i == 2 || i == 4 || i == 7) {
                     if (n_array[i] == 1) {
                         n_array[j] = 10 + parseInt(n_array[j]);
                         n_array[i] = 0;
                     }
                 }
             }
             value = "";
             for (var i = 0; i < 9; i++) {
                 if (i == 0 || i == 2 || i == 4 || i == 7) {
                     value = n_array[i] * 10;
                 } else {
                     value = n_array[i];
                 }
                 if (value != 0) {
                     words_string += words[value] + " ";
                 }
                 if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                     words_string += "Crores ";
                 }
                 if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                     words_string += "Lakhs ";
                 }
                 if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                     words_string += "Thousand ";
                 }
                 if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                     words_string += "Hundred and ";
                 } else if (i == 6 && value != 0) {
                     words_string += "Hundred ";
                 }
             }
             words_string = words_string.split("  ").join(" ");
         }
         return words_string;
    }
   </script>
   </head>
   <body>
   <!-- WRAPPER -->
   <div id="wrapper" class="clearfix">