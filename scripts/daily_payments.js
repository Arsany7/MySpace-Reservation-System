function function2(start, end)
{
    var regExp=/^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    if (start != ""){
    if (!regExp.test(start)) {
            alert("INVALID START DATE! (YYYY-MM-DD)");
            return false;
    }}
    if (end != ""){
    if (!regExp.test(end)) {
            alert("INVALID END DATE! (YYYY-MM-DD)");
            return false;
    }}
    if (start != "" && end != ""){
    var startsplit =start.split('-');
    var date1 =new Date(startsplit[0], startsplit[1] - 1, startsplit[2]); 
    var endsplit =end.split('-');
    var date2 =new Date(endsplit[0], endsplit[1] - 1, endsplit[2]); 
    if(date1 > date2)
    {
        alert("INVALID DATES: END DATE IS BEFORE START DATE");
        return false;
    }}
    return true;
}
// Attach the function to the window object for use in the browser
if (typeof window !== 'undefined') {
    window.validateDate = function2;
}
// Export using module.exports when running in a Node.js environment (like Jest).
else{
    module.exports = function2
}

