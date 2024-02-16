describe('Admin Page', () => {
  it('should add a table', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Add Table")').click();
    cy.url().should('include', 'http://localhost/sw/addtable.html');
  
    cy.get('input[placeholder="Category..."]').type('standard');
    cy.get('input[placeholder="Number of seats..."]').type('4');
    cy.get('input[placeholder="Price per hour..."]').type('25');
    cy.get('input[placeholder="Branch ID..."]').type('3');
    cy.get('button:contains("Add Table")').click();
    cy.on('window:alert', (text) => {
      expect(text).to.equal('Table added successfully!'); 
    });
    cy.url().should('include', 'http://localhost/sw/adminHome.html');
  });
  
  it('should update table price', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Update Table Price")').click();
    cy.url().should('include', 'http://localhost/sw/changePrice.html');
  
    cy.get('input[placeholder="Table Id..."]').type('1');
    cy.get('input[placeholder="New Price..."]').type('45');
    cy.get('button:contains("Update")').click();
    cy.on('window:alert', (text) => {
      expect(text).to.equal('Price Updated to 45 EGP successfully!'); 
    });
    cy.url().should('include', 'http://localhost/sw/adminHome.html');
  });
  
  it('should search for reservations within a specific period', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Reservations"):first').click();
    cy.url().should('include', 'http://localhost/sw/reservations_table_cust.html');

    cy.get('input[placeholder="Date... (YYYY-MM-DD)"]').type('2023-12-30');
    cy.get('input[placeholder="Reservation Starts from... (HH 24-Hour-Format)"]').type('10');
    cy.get('input[placeholder="Reservation Ends at... (HH 24-Hour-Format)"]').type('15');

    cy.get('button:contains("Search")').click();

    cy.url().should('include', 'http://localhost/sw/reservations_table_cust.php');
  });

  it('should search for a table status at a specific date', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Table Status")').click();
    cy.url().should('include', 'http://localhost/sw/table_status.html');
  
    cy.get('input[placeholder="Day\'s date..."]').type('2023-12-30');
  
    cy.get('button:contains("Search")').click();
  });

  it('should search for reservations based on table information', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Table Reservations")').click();

    cy.url().should('include', 'http://localhost/sw/reservations_table_info.html');

    cy.get('input[placeholder="Start Date..."]').type('2023-12-01');
    cy.get('input[placeholder="End Date..."]').type('2023-12-31');
    cy.get('input[placeholder="Category..."]').type('standard');
    cy.get('input[placeholder="Number of seats..."]').type('2');
    cy.get('input[placeholder="Price per Hour..."]').type('20');
    cy.get('input[placeholder="Branch..."]').type('KafrAbdo');

    cy.get('button:contains("Search")').click();

    cy.url().should('include', 'http://localhost/sw/reservations_table_info.php');
  });

  it('should search reservations by customer with default values', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("Customer Reservations")').click();

    cy.url().should('include', 'http://localhost/sw/reservations_cust_info.html');

    cy.get('input[placeholder="Customer Id..."]').type('1');
    cy.get('input[placeholder="First Name..."]').type('John');
    cy.get('input[placeholder="Last Name..."]').type('Doe');
    cy.get('input[placeholder="Email..."]').type('john.doe@example.com');

    cy.get('button:contains("Search")').click();
    cy.url().should('include', 'http://localhost/sw/reservations_cust_info.php');
  });
  
  it('should navigate to View Customers page', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("View Customers")').click();
    cy.url().should('include', 'http://localhost/sw/customers.php');
  });

  it('should navigate to View Tables page', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("View Tables")').click();
    cy.url().should('include', 'http://localhost/sw/tables.php');
  });

  it('should navigate to View Branches page', () => {
    cy.visit('http://localhost/sw/adminHome.html');
    cy.get('button:contains("View Branches")').click();
    cy.url().should('include', 'http://localhost/sw/branches.php');
  });

  it('should search for daily payments within a specific period', () => {
    cy.visit('http://localhost/sw/adminHome.html'); // Replace with the actual path
    cy.get('button:contains("Daily Payments")').click();
    cy.url().should('include', 'http://localhost/sw/daily_payments.html');

    cy.get('input[placeholder="Start Date..."]').type('2023-01-01'); // Replace with the desired start date
    cy.get('input[placeholder="End Date..."]').type('2023-12-31'); // Replace with the desired start date

    cy.get('button:contains("Search")').click();
    cy.url().should('include', 'daily_payments.php');
  });
});
