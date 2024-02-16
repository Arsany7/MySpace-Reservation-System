function validateCustomer(fname, lname, email) {
    var emailRegExp =  /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    var stringRegExp = /^[A-Za-z]+$/;

    if (email !== "" && !email.match(emailRegExp))
    {
        alert('THE EMAIL YOU ENTERED IS NOT A CORRECT ONE. IT MUST BE IN THE FORM OF "EX12PLE@EX45PLE.COM"');
        return false;
    }

    if (fname !== "" && !stringRegExp.test(fname)) {
        alert ('INVALID FIRST NAME ENTRY: FIRST NAME FIELD MUST BE STRING');
        return false;
    }
     
    if (lname !== "" && !stringRegExp.test(lname)) {
        alert ('INVALID LAST NAME ENTRY: LAST NAME FIELD MUST BE STRING');
        return false;
    }
    return true;
}
// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validateDate = validateCustomer;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = validateCustomer
}