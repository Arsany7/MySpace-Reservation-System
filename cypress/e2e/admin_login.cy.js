describe('Admin Login and Logout', () => {
    it('should log in as an admin', () => {
        cy.visit('http://localhost/sw/index.html');
        cy.get('input[placeholder="Email Address..."]').type('admin@gmail.com')
        cy.get('input[placeholder="Password..."]').type('admin')
        cy.get('input[value="admin"]').click();
        cy.get('button[name="submit"]').click();  
        cy.url().should('include', 'http://localhost/sw/adminHome.html');
    });

    it('should allow for log out', () => {
        cy.visit('http://localhost/sw/adminHome.html');
        cy.contains('Log Out').click();
        cy.url().should('include', 'http://localhost/sw/index.html');
    });
  });