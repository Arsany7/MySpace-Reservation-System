const validateDate = require('../scripts/table_status');

global.alert = jest.fn();

test('Valid date input', () => {
    expect(validateDate('2023-12-31')).toBe(true);
});
  
test('Empty date field', () => {
    expect(validateDate('')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('You must fill in the date field');
});
  
test('Invalid date format', () => {
    expect(validateDate('31-12-2023')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('Please enter date in this format (YYYY-MM-DD)');
});

test('Valid date input with leading zeros', () => {
    expect(validateDate('2023-01-05')).toBe(true);
});
  
test('Invalid date input with non-numeric characters', () => {
    expect(validateDate('2023-12-0A')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('Please enter date in this format (YYYY-MM-DD)');
});