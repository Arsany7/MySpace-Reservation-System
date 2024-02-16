global.alert = jest.fn();
  
const validate = require('../scripts/changeprice');

test('Empty Table ID', () => {
    validate('', '10');
    expect(global.alert).toHaveBeenCalledWith("You must enter the table ID!");
});

test('empty price', () => {
    validate('10', '');
    expect(global.alert).toHaveBeenCalledWith("You must enter the price!");
});
