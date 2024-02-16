global.alert = jest.fn();

const validate = require('../scripts/addtable');

test('empty category', () => {
    validate('', '10', '12', '1');
    expect(global.alert).toHaveBeenCalledWith("You must enter the category!");
});

test('empty number of seats', () => {
    validate('luxury', '', '10', '1');
    expect(global.alert).toHaveBeenCalledWith("You must enter the number of seats!");
});

test('empty price per hour', () => {
    validate('luxury', '10', '', '1');
    expect(global.alert).toHaveBeenCalledWith("You must enter the price per hour for that table!");
});

test('', () => {
    validate('luxury', '10', '12', '');
    expect(global.alert).toHaveBeenCalledWith("You must enter the branch ID!");
});


