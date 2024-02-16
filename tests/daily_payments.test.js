const function2 = require('../scripts/daily_payments');

// Mock the alert function for the testing environment
global.alert = jest.fn();

test('entering wrong start date format', () => {
    function2('12.12.2023', '');
    expect(global.alert).toHaveBeenCalledWith("INVALID START DATE! (YYYY-MM-DD)");
});

test('entering wrong end date format', () => {
    function2('', '2023%12%12');
    expect(global.alert).toHaveBeenCalledWith("INVALID END DATE! (YYYY-MM-DD)");
});

test('entering wrong start date format', () => {
    function2('12.12.2023', '');
    expect(global.alert).toHaveBeenCalledWith("INVALID START DATE! (YYYY-MM-DD)");
});

test('entering a start date that is after the end date', () => {
    function2('2023-12-10', '2023-10-18');
    expect(global.alert).toHaveBeenCalledWith("INVALID DATES: END DATE IS BEFORE START DATE");
});

test('entering a correct input', () => {
    expect(function2('2023-12-10', '2023-12-11')).toBe(true);
});

test('entering the start and end date to get daily payments on a specific day.', () => {
    expect(function2('2023-12-10', '2023-12-10')).toBe(true);
});
