function validateDate(day) {
    var regex=/^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    if (day=="")
    {
        alert('You must fill in the date field');
        return false;
    }
    if (!day.match(regex))
        {
            alert('Please enter date in this format (YYYY-MM-DD)');
            return false;
        }
    return true;
}

// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validateDate = validateDate;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = validateDate
}