// const calculator = require('../calculator');

document.querySelectorAll('.btn-operation').forEach((element, key) => {
    element.addEventListener('click', (e) => {
        var operation = e.target.getAttribute('data-value');

        switch(operation) {
            case "equals": {
                var result = calculator.calculate();
                document.querySelector('.calc-screen').innerHTML = result;
                break;
            }
            case "clear": {
                calculator.clear();
                document.querySelector('.calc-screen').innerHTML = "0";
                break;
            }
            default: {
                calculator.setOperation(operation);
                if(calculator.getIndex() == 1) {
                    var result = calculator.getNumber(0);
                    document.querySelector('.calc-screen').innerHTML = result;
                }

                break;
            }
        }
    });
});

document.querySelectorAll('.btn-number').forEach((element, key) => {
    element.addEventListener('click', (e) => {
        var value = e.target.getAttribute('data-value');
        calculator.setNumber(value);

        var i = calculator.getIndex();
        document.querySelector('.calc-screen').innerHTML = calculator.getNumber(i);
    });
});