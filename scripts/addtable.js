function validate(category, number_of_seats, price_per_hour, branch_id)
{            
    // Validate empty inputs
    if (category=="")
    {
        alert('You must enter the category!');
        return false;
    }
    else if (number_of_seats=="")
    {
        alert('You must enter the number of seats!');
        return false;
    }
    else if (price_per_hour=="")
    {
        alert('You must enter the price per hour for that table!');
        return false;
    }
    else if (branch_id=="")
    {
        alert('You must enter the branch ID!');
        return false;
    }
    $.ajax({
        type: "POST",
        url: "store_table.php",
        data: { validate:"validate",category:category, number_of_seats: number_of_seats, price_per_hour: price_per_hour, branch_id: branch_id },
        success: function(response){
            if (response == "success")
            {
                alert("Table added successfully!");
                window.location="http://localhost/sw/adminHome.html";
                return true;
            }
            else if (response =="fail") {
                alert("Branch ID doesn't exist!\nMake sure you enter a valid branch ID");
                return false;
            }
        }
    });
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
