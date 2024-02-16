// Export all functions
const {
    validateDates,
    validateBranch,
    validateCategory,
    validateSeats,
    validatePrice,
  } = require('../scripts/reservations_table_info');

global.alert = jest.fn();

// Test cases for validateDates
test('Empty date range', () => {
    expect(validateDates('', '')).toBe(true);
  });
  
test('Empty start date', () => {
    expect(validateDates('', '2023-12-15')).toBe(true);
});

test('Empty end date', () => {
    expect(validateDates('2023-12-01', '')).toBe(true);
});

test('Valid date range', () => {
    expect(validateDates('2023-12-01', '2023-12-15')).toBe(true);
});
  
test('Invalid date range (end date before start date)', () => {
    expect(validateDates('2023-12-15', '2023-12-01')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID RESERVATION TIMING: END TIME IS BEFORE/SAME AS START TIME');
});
  
// Test cases for validateBranch
test('Empty branch', () => {
    expect(validateBranch('')).toBe(true);
});

test('Valid branch', () => {
    expect(validateBranch('MainBranch')).toBe(true);
});

test('Invalid branch (numeric characters)', () => {
    expect(validateBranch('123')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID BRANCH ENTRY: BRANCH FIELD MUST BE STRING');
});
  
  
// Test cases for validateCategory
test('Empty category', () => {
    expect(validateCategory('')).toBe(true);
});

test('Valid category', () => {
    expect(validateCategory('standard')).toBe(true);
});

test('Invalid category (numeric characters)', () => {
    expect(validateCategory('123')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID CATEGORY ENTRY: CATEGORY FIELD MUST BE STRING');
});


// Test cases for validateSeats
test('Empty number of seats', () => {
    expect(validateSeats('')).toBe(true);
});

test('Valid number of seats', () => {
    expect(validateSeats('5')).toBe(true);
});

test('Invalid number of seats (zero)', () => {
    expect(validateSeats('0')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID NUMBER OF SEATS: NUMBER OF SEATS FIELD MUST BE INTEGER GREATER THAN ZERO');
});


// Test cases for validatePrice
test('Empty price', () => {
    expect(validatePrice('')).toBe(true);
});

test('Valid price', () => {
    expect(validatePrice('25.50')).toBe(true);
});

test('Invalid price (non-numeric)', () => {
    expect(validatePrice('abc')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID PRICE ENTRY: PRICE FIELD MUST BE NUMERIC');
});
  
