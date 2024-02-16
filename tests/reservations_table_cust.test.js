const validateDateTime = require('../scripts/reservations_table_cust.js');

global.alert = jest.fn();

test('Valid input', () => {
    expect(validateDateTime('2023-12-31', '12', '18')).toBe(true);
});
  
test('Invalid date format', () => {
    expect(validateDateTime('31-12-2023', '12', '18')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID DATE! (YYYY-MM-DD)');
});
  
test('Invalid start time format', () => {
    expect(validateDateTime('2023-12-31', '25', '18')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID START TIME! (HH 24-Hour-Format)');
});
  
test('Invalid end time format', () => {
    expect(validateDateTime('2023-12-31', '12', '30')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID END TIME! (HH 24-Hour-Format)');
});
  
test('Invalid entry: Date must be specified if start or end times are entered', () => {
    expect(validateDateTime('', '12', '18')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID ENTRY: DATE MUST BE SPECIFIED IF START OR END TIMES ARE ENTERED');
});
  
test('Invalid dates: End date is before start date', () => {
    expect(validateDateTime('2023-12-31', '18', '12')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID DATES: END DATE IS BEFORE START DATE');
});
  