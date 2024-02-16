function validateDates(starting_date, ending_date) {
    var regExp = /^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    if (starting_date != "")
    {
        if (!regExp.test(starting_date)) {
            alert("INVALID START DATE! (YYYY-MM-DD)");
            return false;
        }
    }
    if (ending_date != "")
    {
        if (!regExp.test(ending_date)) {
            alert("INVALID END DATE! (YYYY-MM-DD)");
            return false;
        }
    }
    if (starting_date != "" && ending_date != ""){
    var startsplit =starting_date.split('-');
    var date1 =new Date(startsplit[0], startsplit[1] - 1, startsplit[2]); 
    var endsplit =ending_date.split('-');
    var date2 =new Date(endsplit[0], endsplit[1] - 1, endsplit[2]); 
    if(date1 > date2)
    {
        alert('INVALID RESERVATION TIMING: END TIME IS BEFORE/SAME AS START TIME');
        return false;
    }}
    return true;
}
  
function validateBranch(branch) {
var stringRegExp = /^[A-Za-z]+$/;

if (branch !== "" && !stringRegExp.test(branch)) {
    alert ('INVALID BRANCH ENTRY: BRANCH FIELD MUST BE STRING');
    return false;
}

return true;  
}

function validateCategory(category) {
var stringRegExp = /^[A-Za-z]+$/;

if (category !== "" && !stringRegExp.test(category)) {
    alert ('INVALID CATEGORY ENTRY: CATEGORY FIELD MUST BE STRING');
    return false;
}

return true;
}

function validateSeats(number_of_seats) {
var positiveIntegerRegExp = /^[1-9]\d*$/;

if (number_of_seats !== "" && !positiveIntegerRegExp.test(number_of_seats)) {
    alert ('INVALID NUMBER OF SEATS: NUMBER OF SEATS FIELD MUST BE INTEGER GREATER THAN ZERO');
    return false;
}

return true;  
}

function validatePrice(price) {
var numericRegExp = /^\d*\.?\d*$/;

if (price !== "" && !numericRegExp.test(price)) {
    alert ('INVALID PRICE ENTRY: PRICE FIELD MUST BE NUMERIC');
    return false;
}

return true;
}

// Attach the functions to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validationFunctions = {
        validateDates,
        validateBranch,
        validateCategory,
        validateSeats,
        validatePrice,
    };
}
// Export using module.exports when running in a Node.js environment (like Jest).
else {
    module.exports = {
        validateDates,
        validateBranch,
        validateCategory,
        validateSeats,
        validatePrice,
    };
}