var form = document.getElementById("formval");

form.addEventListener('submit',(e) => {
        e.preventDefault();
        checkInput();
    });
    
    function checkInput(){
        resetErr();
        var fname = document.getElementById('fname').value;
        var lname = document.getElementById('lname').value;
        var email = document.getElementById('email').value;
        var mobileno = document.getElementById('mobileno').value;
        var password = document.getElementById('pass').value
        var Confpassword = document.getElementById('confpass').value
        var genderr =document.getElementsByName("Gender");
        var date = document.getElementById("dob").value;
        var educationn = document.getElementById('education').value;
        var checkbox = document.getElementById('checkbox').value;
        var emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var mobilenoregex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
         var dobregex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/;
        var countErr = 0;
        
        if(fname == "" || fname == null)
        {
        
            document.getElementById('fnameErr').innerHTML="please first name";
            countErr++;
        }
        else if(fname.length > 3){
            document.getElementById('fnameErr').innerHTML="length is too short ";
            countErr++;
            
        }
    
    

        if(lname == "" || lname == null)
        {
            document.getElementById('lnameErr').innerHTML="please fill this field";
            countErr++;            
        }
        
        else if(lname.length < 10){
            document.getElementById('lnameErr').innerHTML="length is too short ";
            countErr++;
        }
    
        if(!(email.match(emailregex)))
        {
            document.getElementById('emailErr').innerHTML="please fill your email address";
            countErr++;            
        }
    

         if(!mobileno.match(mobilenoregex))
         {
             document.getElementById('mobileErr').innerHTML="please fill your correct mobile no. ";

             countErr++;
        }

        if(password == "" || password == null)
        {
            document.getElementById('passErr').innerHTML="please fill this field";
            countErr++;            
        }
        
        if(!Confpassword === password)
        {
            document.getElementById('passErr').innerHTML="please fill this field";
            countErr++;            
        }
        
        
    
        //   alert(genderr[0].checked);
        // alert(genderr[1].checked);

          if ((genderr[0].checked || genderr[1].checked) == false)
        //  if (genderr[0].checked == false && genderr[1].checked == false)
         { 
            document.getElementById('genderErr').innerHTML="please fill your gender";

            countErr++;
        }
         
        
        if(!date.match(dobregex)){
        
            document.getElementById('dobErr').innerHTML="please fill the date of birth";
            countErr++;

        }   
    // alert(educationn.checked);
        if( educationn == "" || educationn== null){
            document.getElementById('educationErr').innerHTML="please fill your education qualification ";
            countErr++;
        }
       
       if(!checkbox.checked)
        {
            document.getElementById('checkboxErr').innerHTML="please check this field";
            countErr++;
        }
        
        if(countErr > 0){
            return false;
        }else{
            return true;
        };
     }
   function resetErr(){
    document.getElementById('fnameErr').innerHTML="";
    document.getElementById('lnameErr').innerHTML="";
    document.getElementById('emailErr').innerHTML="";
    document.getElementById('mobileErr').innerHTML="";
    document.getElementById('genderErr').innerHTML="";
    document.getElementById('dobErr').innerHTML="";
    document.getElementById('checkboxErr').innerHTML="";
    document.getElementById('educationErr').innerHTML="";
    };
    



