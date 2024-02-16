function validate(table_id, price)
{            
    if (table_id=="")
    {
        alert('You must enter the table ID!');
        return false;
    }
    else if (price=="")
    {
        alert('You must enter the price!');
        return false
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "changePrice.php",
            data: { validate:"validate",table_id:table_id,price: price },
            success: function(response){
                if (response == "success")
                {
                    alert("Price Updated to " + price  + " EGP successfully!");
                    window.location="http://localhost/sw/adminHome.html";
                }
                else if (response =="fail") 
                {
                    alert("Table ID does not exist!\nMake sure you enter the correct table ID");
                }
            }
        });
    }
    return false;
}
// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validateDate = validate;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = validate
}
