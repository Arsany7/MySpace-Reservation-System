function validate(email, password, adminbox, userbox)
        {   
            if (email=="")
            {
                alert('You must enter your email!');
            }
            else if (password=="")
            {
                alert('You must enter your password!');
            }
           else if(!adminbox && !userbox) {
                alert('Please specify your role!');
            }
         else if(adminbox)
            {
                if (email != 'admin@gmail.com')
                {
                    alert('Incorrect email!')
                    return false; 
                }
                else if (password != 'admin')
                {
                    alert('Incorrect Password!')
                    return false; 
                } 
                else
                {
                    window.location="http://localhost/sw/adminHome.html";
                }  
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "get_user.php",
                    data: { validate:"validate",email: email, password: password },
                    success: function(response){
                        if (response == "success")
                        {
                            window.location="http://localhost/sw/customer_start.php";
                        }
                        else
                        {
                            alert("Incorrect Email or Password!");
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