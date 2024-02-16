const validateCustomer = require('../scripts/reservations_cust_info');

global.alert = jest.fn();

test('validateCustomer with valid input', () => {
    expect(validateCustomer('John', 'Doe', 'john.doe@example.com')).toBe(true);
});

test('validateCustomer with empty inputs', () => {
    expect(validateCustomer('', '', '')).toBe(true);
});

test('validateCustomer with invalid email format', () => {
    expect(validateCustomer('Jane', 'Smith', 'invalid_email')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('THE EMAIL YOU ENTERED IS NOT A CORRECT ONE. IT MUST BE IN THE FORM OF "EX12PLE@EX45PLE.COM"');
});

test('validateCustomer with invalid first name format', () => {
    expect(validateCustomer('123', 'Doe', 'john.doe@example.com')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID FIRST NAME ENTRY: FIRST NAME FIELD MUST BE STRING');
});

test('validateCustomer with invalid last name format', () => {
    expect(validateCustomer('John', '123', 'john.doe@example.com')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID LAST NAME ENTRY: LAST NAME FIELD MUST BE STRING');
});