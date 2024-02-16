describe('Customer Page', () => {
    it('should navigate to the customer page, search for a table, and reserve it', () => {
        cy.visit('http://localhost/sw/index.html');
        cy.get('input[placeholder="Email Address..."]').type('john.doe@example.com')
        cy.get('input[placeholder="Password..."]').type('john')
        cy.get('input[value="user"]').click();
        cy.get('button[name="submit"]').click();
        cy.url().should('include', 'http://localhost/sw/customer_start.php');
        cy.contains('Welcome John !'); 
        
        cy.get('input[placeholder="Reservation Date (YYYY-MM-DD)"]').type('2023-12-31');
        cy.get('input[placeholder="Start Time (HH - 24-hour format)"]').type('14');
        cy.get('input[placeholder="End Time (HH - 24-hour format)"]').type('16');
        cy.get('input[placeholder="Branch..."]').type('KafrAbdo');
        cy.get('input[placeholder="Category..."]').type('luxury');
        cy.get('input[placeholder="Number of seats..."]').type('2');
        cy.get('input[placeholder="Minimum Price..."]').type('20');
        cy.get('input[placeholder="Maximum Price..."]').type('200');      
        cy.get('button:contains("Search")').click();
        cy.url().should('include', 'http://localhost/sw/available_tables.php');
        cy.get('body').then(($body) => {
            if ($body.find('input[name="reserve_btn"]').length) {
                cy.get('input[name="reserve_btn"]:first').click();
                cy.url().should('include', 'http://localhost/sw/payment.php');
                cy.get('input[name="pay"]').click();
                cy.url().should('include', 'http://localhost/sw/customer_start.php');
                cy.contains('Your reservation is confirmed!');
            } else {
                cy.log('No tables found matching specified criteria');
            }
        });
    });
});