function validate(fname, lname, profession, mobile_no, email, password, confirm_password)
        {   
        regex =  /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        
        if (fname=="")
        {
            alert ('You must enter your first name!');
            return false;
        }
        else if (lname=="")
        {
            alert ('You must enter your last name!');
            return false;
        }
        else if (profession=="")
        {
            alert ('You must enter your profession!');
            return false;

        }
        else if (mobile_no=="")
        {
            alert ('You must enter your mobile number!');
            return false;

        }
        else if (email=="")
        {
            alert ('You must enter your email!');
            return false;

        }
        else if (password=="")
        {
            alert('You must enter your password!');
            return false;

        }  
        else if (confirm_password==""){
            alert('You must confirm your password!');
            return false;
        }
        else if (!email.match(regex))
        {
            alert("The Email you entered is not a correct one. It must in the form of 'ex12ple@ex45ple.com'");
            return false;
        }
        else if (password != confirm_password)
        {
            alert('Passwords are not matching!');
            return false;
        } 
        else
        {
            $.ajax({
                type: "POST",
                url: "store_user.php",
                data: { validate:"validate",fname:fname, lname:lname, profession:profession, mobile_no:mobile_no, email: email, password: password },
                success: function(response){
                    if (response == "success")
                    {
                        window.location="http://localhost/sw/customer_start.php";
                        return true;
                    }
                    else
                    {
                        alert("Email Already Exists!");
                        return false;
                    }
                }
            });
        }
        return false;     
        }
// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validate = validate;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = validate
}