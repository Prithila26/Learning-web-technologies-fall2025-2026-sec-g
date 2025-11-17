let currentValue = '0';
let previousValue = null;
let operator = null;
let shouldResetDisplay = false;

const display = document.getElementById('display');

function updateDisplay() {
    display.textContent = currentValue;
}

function clearDisplay() {
    currentValue = '0';
    previousValue = null;
    operator = null;
    shouldResetDisplay = false;
    updateDisplay();
}

function setOperator(op) {
    if (operator !== null && !shouldResetDisplay) {
        calculate();
    }
    previousValue = currentValue;
    operator = op;
    shouldResetDisplay = true;
}

function appendNumber(num) {
    if (shouldResetDisplay) {
        currentValue = num;
        shouldResetDisplay = false;
    } else {
        if (currentValue === '0') {
            currentValue = num;
        } else {
            currentValue += num;
        }
    }
    updateDisplay();
}

function calculate() {

    if (operator === null || previousValue === null) {
        return;
    }

    const prev = parseFloat(previousValue);
    const current = parseFloat(currentValue);
    let result;

    switch (operator) {

        case '+':   
            result = prev + current;
            break;

    }



    currentValue = result.toString();
    operator = null;
    previousValue = null;
    shouldResetDisplay = true;
    updateDisplay();
}