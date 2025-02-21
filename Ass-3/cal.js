let display = document.getElementById("result");
let expression = "";

function appendCharacter(char) {
    if (display.innerText === "0" && char !== ".") {
        expression = "";
    }
    expression += char;
    display.innerText = expression;
}

function clearAll() {
    expression = "";
    display.innerText = "0";
}

function deleteLast() {
    expression = expression.slice(0, -1);
    display.innerText = expression || "0";
}

function calculateResult() {
    try {
        expression = eval(expression).toString();
        display.innerText = expression;
    } catch {
        display.innerText = "Error";
        expression = "";
    }
}
