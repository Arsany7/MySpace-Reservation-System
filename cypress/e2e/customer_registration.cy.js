describe('Registration', () => {
    it('should register a new user', () => {
        cy.visit('http://localhost/sw/index.html');
        cy.contains('Register').click();
        cy.url().should('include', 'http://localhost/sw/register.html');

        cy.get('input[placeholder="First Name..."]').type('Test');
        cy.get('input[placeholder="Last Name..."]').type('User');
        cy.get('input[placeholder="Profession..."]').type('Tester');
        cy.get('input[placeholder="Mobile Number..."]').type('9876543210');
        cy.get('input[placeholder="Email Address..."]').type('test.user@example.com');
        cy.get('input[placeholder="Password..."]').type('testpassword123');
        cy.get('input[placeholder="Confirm Password..."]').type('testpassword123');
        cy.get('button[name="submit"]').click();

        cy.url().should('include', 'http://localhost/sw/customer_start.php');
        cy.contains('Welcome Test !'); 
    });
  });
  