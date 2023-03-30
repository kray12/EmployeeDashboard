$(document).ready(function()
{
   function resetErr(){ 
        $('#fnameErr').hide();
        $('#lnameErr').hide();
        $('#emailErr').hide();
        $('#mobileErr').hide();
        $('#passErr').hide();
        $('#confpassErr').hide();
        $('#genderErr').hide();
        $('#dobErr').hide();
        $('#checkboxErr').hide();
        $('#educationErr').hide();
        $("#imgErr").hide();

    };
    
    // var tmppath = URL.createObjectURL(event.target.files[0]);
    // if (tmppath != "") {
    //     var imgSizeVal = event.target.files[0].size;

  
     function validateinput(){
        var fnameVal = $("#fname").val();
        var lnameVal = $("#lname").val();
        var emailVal = $("#email").val();
        var mobileVal = $("#mobileno").val();
        var passVal = $("#pass").val();
        var confpassVal = $("#confpass").val();
        var dobVal = $("#datepicker").val();
        // var genderVal = $("#gender").val();
        // var radiocheck = $("input[name='gender']:checked").val();
        var genderVal = $("input:radio[name=gender]").is(":checked");
        var educationVal = $("#education").val();
        var checkboxVal = $("input:checkbox[name=checkbox]").prop("checked");
        var images= $('#output').val();
        var emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var mobileregex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        // alert(image);
        var countErr = 0;
        // console.log(radio.check);
        if (fnameVal == "" || fnameVal== null ){
            $("#fnameErr").html("**please fill first name");
            $("#fnameErr").show();
            countErr++;
        }else if (fnameVal.length<5 || fnameVal.length>10){
            $("#fnameErr").html("**length of fname must be between 5 and 10");
            $("#fnameErr").show();
            countErr++;
        }
        
         if (lnameVal == "" || lnameVal== null ){
            $("#lnameErr").html("**please fill first name");
            $("#lnameErr").show();
            countErr++;
        }else if (lnameVal.length<5 || lnameVal.length>10){
            $("#lnameErr").html("**length of lname must be between 5 and 10");
            $("#lnameErr").show();
            countErr++;
        }
                   
        if (emailVal == "" || emailVal== null ){
            $("#emailErr").html("<p>**please fill email address</p>");
            $("#emailErr").show();
            countErr++;
            }else if (!emailVal.match(emailregex)){
            $("#emailErr").html("**please fill correct email address");
            $("#emailErr").show();
            countErr++;
        }
                            
        if (mobileVal == "" || mobileVal== null ){
            $("#mobileErr").html("**please fill mobile no.");
            $("#mobileErr").show();
            countErr++;
            }else if (!mobileVal.match(mobileregex)){
            $("#mobileErr").html("**please fill correct mobile no.");
            $("#mobileErr").show();
            countErr++;           
            }      
            
            if ( passVal == ""){
                $("#passErr").html("**please fill password");
                $("#passErr").show();
                countErr++;
            
            }
            // console.log((confpassVal ==passVal));
             if ( confpassVal=="" || confpassVal==null ){
                $("#confpassErr").html("**fill your confirm password");
                $("#confpassErr").show();
                countErr++;
            }
             else if ((confpassVal != passVal )){
                $("#confpassErr").html("**confirm password dosnt match");
                $("#confpassErr").show();
                countErr++;
            }
            
         if (dobVal == ""){
            $("#dobErr").html("**please fill date of birth");
            $("#dobErr").show();
            countErr++;
         }
         
         if (genderVal== false){
            $("#genderErr").html("**please fill your gender");
            $("#genderErr").show();
            countErr++;
         }

         if (educationVal == "" ){
            $("#educationErr").html("**please fill your educational qualification");
            $("#educationErr").show();
            countErr++;
         }
        //  console.log(checkboxVal.checked)
         if (checkboxVal== false){
            $("#checkboxErr").html("**please fill terms and conditions");
            $("#checkboxErr").show();
            countErr++;
         }
        //  alert(images);
        // $(document).on('change', '#img', function(event) {

        //     var tmppath = URL.createObjectURL(event.target.files[0]);
        //     console.log(event.target.files[0].size);
        //     if($images !==""){
        //         $("#imgErr").html("**upload your image");
        //         $("#imgErr").show();
        //     }else if (tmppath != "") {
        //         var imgSizeVal = event.target.files[0].size;
        //         console.log(event.target.files[0]);
        //         $("#imgErr").html("**upload your image");
        //         $("#imgErr").show();
        //         $('#output').attr('src', tmppath);
        //         $('#output').attr('height', "100px");
        //         $('#output').attr('width', "100px");
        //         $('#output').show();
        //     }  
        //     else if (imgSizeVal > 20000) {
        //         $('#output').hide();
        //         $("#imgErr").html("**image size must be less than 2kb");
        //         $("#imgErr").show();
        //         return false;
                
        //     } else {
        //         $('#output').hide();
        //         $("#imgErr").hide();
    
        //     }
    
        // })
    
        


        if(countErr > 0){
            // alert(countErr);
            return false;
        }else{
            // alert("enter else");
            $("#formVal").submit();
            return true;
        }           
    };
    $(document).on('click','#saveBtn',function (e) {

        e.preventDefault();
        // alert();
        //  $("#formVal").submit();
        resetErr();
        validateinput();


    });

        
});