# Running Jest Unit Tests

This repository includes Jest for running unit tests. Follow these steps to run the tests:

### Step 1: Initialize NPM

Run the following command to initialize a `package.json` file:

```bash
npm init -y
```

### Step 2: Set Jest as the Test Script
Open the package.json file and set the "test" script to use Jest:
```json
{
  "scripts": {
    "test": "jest"
  }
}
```

### Step 3: Install the Jest testing framework as a development dependency the project
Execute the following command:
```bash
npm i jest -D
```

### Step 4: Run Jest Tests
Execute the following command to run Jest tests:
```bash
npm test
```

# Running Cypress End-to-End (E2E) Tests
To run Cypress E2E tests, use the following steps:

```bash
npx cypress open
```
Cypress will prompt you to install the necessary packages if they are not available. Follow the prompts to complete the installation.

Once Cypress is set up, you can select and run your E2E tests from the Cypress Test Runner interface.

For more information on configuring and writing Cypress tests, refer to the Cypress Documentation.

## To run the cypress test, run the following command:
```bash
npx cypress run
```
