const {
    validateDateTime,
    validateBranch,
    validateCategory,
    validateSeats,
    validatePrice,
  } = require('../scripts/customer_start');

global.alert = jest.fn();

  test('validateDateTime with valid input', () => {
    expect(validateDateTime('2023-12-12', '12', '15')).toBe(true);
  });
  
  test('validateDateTime with empty reservation date', () => {
    expect(validateDateTime('', '12', '15')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('YOU MUST ENTER THE RESERVATION DATE');
  });
  
  test('validateDateTime with invalid reservation date format', () => {
    expect(validateDateTime('12.12.2023', '12', '15')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID RESERVATION DATE!');
  });
  
  test('validateDateTime with invalid starting time format', () => {
    expect(validateDateTime('2023-12-12', '25', '15')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID STARTING TIME ENTRY: STARTING TIME FIELD MUST BE 2 DIGITS FROM 09 to 23');
  });
  
  test('validateDateTime with invalid ending time format', () => {
    expect(validateDateTime('2023-12-12', '12', '30')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID ENDING TIME ENTRY: ENDING TIME FIELD MUST BE 2 DIGITS FROM 09 to 23');
  });
  
  test('validateDateTime with end time before start time', () => {
    expect(validateDateTime('2023-12-12', '15', '12')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID RESERVATION TIMING: END TIME IS BEFORE/SAME AS START TIME');
  });

  test('validateBranch with valid branch', () => {
    expect(validateBranch('MainBranch')).toBe(true);
  });
  
  test('validateBranch with empty branch', () => {
    expect(validateBranch('')).toBe(true);
  });
  
  test('validateBranch with invalid branch (numeric characters)', () => {
    expect(validateBranch('123')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID BRANCH ENTRY: BRANCH FIELD MUST BE STRING');
  });
  
  test('validateBranch with invalid branch (special characters)', () => {
    expect(validateBranch('Branch@1')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID BRANCH ENTRY: BRANCH FIELD MUST BE STRING');
  });

  test('validateCategory with valid category', () => {
    expect(validateCategory('standard')).toBe(true);
  });
  
  test('validateCategory with empty category', () => {
    expect(validateCategory('')).toBe(true);
  });
  
  test('validateCategory with invalid category (numeric characters)', () => {
    expect(validateCategory('123')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID CATEGORY ENTRY: CATEGORY FIELD MUST BE STRING');
  });
  
  test('validateCategory with invalid category (special characters)', () => {
    expect(validateCategory('Category@1')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID CATEGORY ENTRY: CATEGORY FIELD MUST BE STRING');
  });

  test('validateSeats with valid number of seats', () => {
    expect(validateSeats('5')).toBe(true);
  });
  
  test('validateSeats with empty number of seats', () => {
    expect(validateSeats('')).toBe(true);
  });
  
  test('validateSeats with invalid number of seats (zero)', () => {
    expect(validateSeats('0')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID NUMBER OF SEATS: NUMBER OF SEATS FIELD MUST BE INTEGER GREATER THAN ZERO');
  });
  
  test('validateSeats with invalid number of seats (non-integer)', () => {
    expect(validateSeats('5.5')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID NUMBER OF SEATS: NUMBER OF SEATS FIELD MUST BE INTEGER GREATER THAN ZERO');
  });

  test('validatePrice with valid price', () => {
    expect(validatePrice('25.50')).toBe(true);
  });
  
  test('validatePrice with empty price', () => {
    expect(validatePrice('')).toBe(true);
  });
  
  test('validatePrice with invalid price (non-numeric)', () => {
    expect(validatePrice('abc')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID PRICE ENTRY: PRICE FIELD MUST BE NUMERIC');
  });
  
  test('validatePrice with invalid price (negative value)', () => {
    expect(validatePrice('-10.99')).toBe(false);
    expect(global.alert).toHaveBeenCalledWith('INVALID PRICE ENTRY: PRICE FIELD MUST BE NUMERIC');
  });
  
