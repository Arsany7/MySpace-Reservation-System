global.alert = jest.fn();
  
const validate = require('../scripts/index');

test('Empty Email', () => {
    validate('', '12345', true, false);
    expect(global.alert).toHaveBeenCalledWith("You must enter your email!");
});

test('Empty Password', () => {
    validate('admin@gmail.com', '', false, true);
    expect(global.alert).toHaveBeenCalledWith("You must enter your password!");
});

test('Unspecified Role', () => {
    validate('admin@gmail.com', 'admin', false, false);
    expect(global.alert).toHaveBeenCalledWith("Please specify your role!");
});

test('Wrong Email', () => {
    validate('admin2@gmail.com', 'admin', true, false);
    expect(global.alert).toHaveBeenCalledWith("Incorrect email!");
});

