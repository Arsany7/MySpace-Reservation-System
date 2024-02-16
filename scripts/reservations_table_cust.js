function validateDateTime(date, start_time, end_time)
{
    const regex_date=/^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    const regex_time = /^(0[0-9]|1[0-9]|2[0-3])$/;
    
    if (date != ""){
        if (!regex_date.test(date)) {
                alert("INVALID DATE! (YYYY-MM-DD)");
                return false;
        }}
    if (start_time != ""){
    if (!regex_time.test(start_time)) {
            alert("INVALID START TIME! (HH 24-Hour-Format)");
            return false;
    }}
    if (end_time != ""){
    if (!regex_time.test(end_time)) {
            alert("INVALID END TIME! (HH 24-Hour-Format)");
            return false;
    }}
    if (date == "" && start_time != "" && end_time != ""){
        alert("INVALID ENTRY: DATE MUST BE SPECIFIED IF START OR END TIMES ARE ENTERED");
        return false;
    }
    if (start_time != "" && end_time != ""){
    if(start_time > end_time)
    {
        alert("INVALID DATES: END DATE IS BEFORE START DATE");
        return false;
    }}
    return true;
}

// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validateDateTime = validateDateTime;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = validateDateTime
}