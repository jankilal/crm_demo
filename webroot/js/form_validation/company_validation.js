jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");
jQuery.validator.addMethod("checkQuteUnit", function(e, a) {
    return e<=$("#company_budget").val()
}

, "Cost value must be less then or equal to company budget*"),
jQuery.validator.addMethod("passwordMatch", function(e, a) {
    return $("#company_password").val()==$("#company_conf_password").val()
}

, "Company password and confirm password must be same*"),
$("form").validate( {
    rules: {
        company_name:"required", company_email: {
            required: !0, email: !0
        }
        , company_phone: {
            required: !0, phoneno: !0
        }
        , company_budget:"required", quote_per_employee: {
            required: !0, checkQuteUnit: !0
        }
        , company_password: {
            required: !0, minlength: 4
        }
        , company_conf_password: {
            required: !0, minlength: 4, passwordMatch: !0
        }
        , company_city:"required", company_country_id:"required", company_state_id:"required", company_zip_code:"required", company_address:"required"
    }
    , messages: {
       company_name:"Company name is required*", company_email:"Please enter a valid email address*", company_phone:"Please specify a valid phone number*", company_password: {
            required: "Password is required*", minlength: "Your password must contain more than 4 characters*"
        }
        , company_conf_password: {
            required: "Confirm password is required*", minlength: "Your password must contain more than 4 characters*", passwordMatch: "Company password and confirm password must be same*"
        }
        , company_budget:"Company budget is required*", company_city:"City is required*", company_country_id:"Please select country*", company_state_id:"Please select state*", company_zip_code:"Zip code is required*", company_address:"Address is required*"
    }
});
function getStateList(country_id) {
    var str='country_id='+country_id;
    var PAGE=base_url+'company/getStateList';
    jQuery.ajax( {
        type:"POST", url:PAGE, data:str, success:function(data) {
            if(data!="") {
                $('#company_state_id').html(data)
            }
            else {
                $('#company_state_id').html('<option value=""></option>')
            }
        }
    }
    )
}
