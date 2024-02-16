function validateDateTime(reservation_date, reservation_hour_from, reservation_hour_to) {
    var regExp = /^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    var hourRegExp = /^(0[9]|1[0-9]|2[0-3])$/;
  
    if (reservation_date === "") {
      alert ('YOU MUST ENTER THE RESERVATION DATE');
      return false;
    }

    if (reservation_hour_from === "") {
        alert ('YOU MUST ENTER THE RESERVATION START HOUR');
        return false;
    }

    if (reservation_hour_to === "") {
        alert ('YOU MUST ENTER THE RESERVATION END HOUR');
        return false;
    }

    if (!regExp.test(reservation_date)) {
      alert ('INVALID RESERVATION DATE!');
      return false;
    }
  
    if (reservation_hour_from !== "" && !hourRegExp.test(reservation_hour_from)) {
      alert ('INVALID STARTING TIME ENTRY: STARTING TIME FIELD MUST BE 2 DIGITS FROM 09 to 23');
      return false;
    }
  
    if (reservation_hour_to !== "" && !hourRegExp.test(reservation_hour_to)) {
      alert('INVALID ENDING TIME ENTRY: ENDING TIME FIELD MUST BE 2 DIGITS FROM 09 to 23');
      return false;
    }
  
    var reservation_date_split = reservation_date.split('-');
    var date1 = new Date(reservation_date_split[0], reservation_date_split[1] - 1, reservation_date_split[2], reservation_hour_from);
    var date2 = new Date(reservation_date_split[0], reservation_date_split[1] - 1, reservation_date_split[2], reservation_hour_to);
  
    if (date1 >= date2) {
      alert ('INVALID RESERVATION TIMING: END TIME IS BEFORE/SAME AS START TIME');
      return false;
    }

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
    validateDateTime,
    validateBranch,
    validateCategory,
    validateSeats,
    validatePrice,
  };
}
// Export using module.exports when running in a Node.js environment (like Jest).
else {
  module.exports = {
    validateDateTime,
    validateBranch,
    validateCategory,
    validateSeats,
    validatePrice,
  };
}