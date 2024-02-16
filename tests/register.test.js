global.alert = jest.fn();

const validate = require('../scripts/register');

test('empty fname validation', () => {
    validate('', 'Doe', 'Engineer', '1234567890', 'valid@email.com', 'password', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your first name!");
});
test('empty lname validation', () => {
    validate('John', '', 'Engineer', '1234567890', 'valid@email.com', 'password', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your last name!");
});
test('empty profession validation', () => {
    validate('John', 'Doe', '', '1234567890', 'valid@email.com', 'password', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your profession!");
});
test('empty phone number validation', () => {
    validate('John', 'Doe', 'Engineer', '', 'valid@email.com', 'password', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your mobile number!");
});
test('empty email validation', () => {
    validate('John', 'Doe', 'Engineer', '1234567890', '', 'password', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your email!");
});
test('empty password validation', () => {
    validate('John', 'Doe', 'Engineer', '1234567890', 'valid@email.com', '', 'password')
    expect(global.alert).toHaveBeenCalledWith("You must enter your password!");
});
test('empty confirmation password validation', () => {
    validate('John', 'Doe', 'Engineer', '1234567890', 'valid@email.com', 'password', '')
    expect(global.alert).toHaveBeenCalledWith("You must confirm your password!");
});
test('invalid email validation', () => {
    validate('John', 'Doe', 'Engineer', '1234567890', 'invalid-email', 'password', 'password');
    expect(global.alert).toHaveBeenCalledWith("The Email you entered is not a correct one. It must in the form of 'ex12ple@ex45ple.com'");
});
test('mismatched password validation', () => {
    validate('John', 'Doe', 'Engineer', '1234567890', 'valid@email.com', 'password', 'mismatched');
    expect(global.alert).toHaveBeenCalledWith("Passwords are not matching!");

});
