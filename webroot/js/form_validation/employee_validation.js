jQuery.validator.addMethod("phoneno", function(phone_number, element) {
  phone_number = phone_number.replace(/\s+/g, "");
  return this.optional(element) || phone_number.length > 9 && 
  phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");

jQuery.validator.addMethod("passwordMatch", function(e, a) {
  return $("#employee_password").val()==$("#employee_conf_password").val()
} , "Employee password and confirm password must be same*");

jQuery.validator.addMethod("uniqueEmail", function(value, element) {          
  return check_email_address(value);
},"Email id already registered!");

$("form").validate( {
    rules: {
        check_company:"required",
        department_id:"required",
        employee_name:"required", 
        employee_email: {
            required:  true, 
            email:  true,
            uniqueEmail: true
        }
        , employee_phone: {
            required:  true, 
            phoneno:  true
        }, 
        employee_password: {
            required:  true, 
            minlength: 4
        }, 
        employee_conf_password: {
            required:  true, 
            minlength: 4, 
            passwordMatch:  true
        }, 
        employee_city:"required", 
        employee_country_id:"required", 
        employee_state_id:"required", 
        employee_zip_code:"required", 
        employee_address:"required"
    }, 
    messages: {
       check_company:"Please select company*", 
       department_id:"Please select department*", 
       employee_name:"Employee name is required*", 
       employee_email:{
        required:"Please enter a valid email address*", 
        uniqueEmail:"Email id already registered!" 
       },
       employee_phone:"Please specify a valid phone number*", 
       employee_password: {
            required: "Password is required*", 
            minlength: "Your password must contain more than 4 characters*"
        }, 
        employee_conf_password: {
            required: "Confirm password is required*", 
            minlength: "Your password must contain more than 4 characters*", 
            passwordMatch: "Employee password and confirm password must be same*"
        }, 
        employee_city:"City is required*", 
        employee_country_id:"Please select country*", 
        employee_state_id:"Please select state*", 
        employee_zip_code:"Zip code is required*", 
        employee_address:"Address is required*"
    }
});


function getStateList() {
    var str='country_id='+$('#employee_country_id').val();
    var PAGE=base_url+'employee/getStateList';
    jQuery.ajax( {
        type:"POST", url:PAGE, data:str, success:function(data) {
            if(data!="") {
                $('#employee_state_id').html(data)
            }
            else {
                $('#employee_state_id').html('<option value=""></option>')
            }
        }
    }
    )
}

$(document).ready(function(){
  enebled_add_employee($('#check_company').val());
  $('input:disabled, select:disabled, textarea:disabled').each(function () {
     if($('#check_company').val() == '')
     $(this).attr('title' , 'Please select company');
  });
});

function getDepartMentByCompany(str){
  
  $('.all_emp_fields').find('input:text, input:password, input:file, select, textarea')
  .each(function() {
    if(str != '')
    {
      $(this).attr('title' , 'Please select department'); 
      $(this).attr('disabled' , 'disabled');
    }
    else{
        $(this).attr('title' , 'Please select company');
        $(this).attr('disabled' , 'disabled');
    }
  });

  if(str == "")
  {
    $('#show_department').hide();
    $('#submit_employee').attr('disabled' , 'disabled');
    return false;
  }
  $('#submit_employee').removeAttr('disabled' , 'disabled');
  var dataString = 'company_id='+str;
  var PAGE = base_url+'employee/getDepartMentByCompanyId';
    
    jQuery.ajax({
        type :"POST",
        url  :PAGE,
        data : dataString,
        success:function(data)
        {       
            if(data != "")
            {
              $('#show_department').show();
              $('#department_id').html(data);
            }
            else
            {
              $('#show_department').hide();
              $('#department_id').html('<option value="">Select Department</option>');
            }
        } 
    });
}

function enebled_add_employee(str)
{
  $('.all_emp_fields').find('input:text, input:password, input:file, select, textarea')
  .each(function() {
    if($('#department_id').val() == '')
    {
      $(this).attr('title' , 'Please select department');
      $(this).attr('disabled' , 'disabled');
      $('#submit_employee').attr('disabled' , 'disabled');
    }
    else
    {
      $(this).removeAttr('title');
      $('#submit_employee').removeAttr('disabled' , 'disabled');
      $(this).removeAttr('disabled');
    }
  });
}


function show_change_password()
{
  $('#change_pass').show();
  $('#check_change_password').val('1');
  $('#change_pass_btn').html('<a href="javascript:;" onclick="cancel_cahange_pass()" >Cancel</a>');
}
   
function cancel_cahange_pass()
{
 $('#change_pass').hide();
 $('#check_change_password').val('');
 $('#change_pass_btn').html('<a href="javascript:;" onclick="show_change_password()" >Click To Change Password</a>');
}


function check_email_address(emailId)
{
  var response = true;
  var user_id = '';
  if($('#check_user_id').val() != undefined)
  user_id = $('#check_user_id').val();

  var action_check_emailId = 'check_email';       
  var check_dataString = 'action_check_emailId=' + action_check_emailId + '&employee_email=' + emailId + '&user_id=' + user_id;  
  var check_PAGE = base_url+'employee/checkCompanyEmailId'; 
  
  $.ajax({
    type: "POST",
    url: check_PAGE,
    data: check_dataString,
    cache: false,
    async:false,         
    success: function(check_data)
    {            
      if(check_data == 1)
      response = false;
    }
  });
  return response;
}


function validateEmail(email) 
{
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
return emailReg.test(email);
}

    