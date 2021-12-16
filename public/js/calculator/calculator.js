const calculator = (() => {
    var index = 0;
    var mem   = [];
    var operation = null;

    // var setNumber = (no) => {
    //     if(mem[index] == undefined) {
    //         mem[index] = [];
    //     }

    //     mem[index].push(no);
    // }

    var getNumbers = () => {
        return mem;
    }

    var getNumber = (i) => {
        try {
            return parseFloat(mem[i].join(''));
        } catch(error) {
            throw new Error('Undefined stack index.');
        }
    }

    var setOperation = (op) => {
        if(mem.length == 0) {
            return;
        }

        if(['equals', 'clear'].includes(op)) {
            return;
        }

        if(index == 1) {
            calculate();
        }

        operation = op;
        if(index < 1) index++;
    }

    var getOperation = () => {
        return operation;
    }

    var getIndex = () => {
        return index;
    }

    var calculate = () => {
        if(mem.length == 2) {
            var x = parseFloat(mem[0].join(''));
            var y = parseFloat(mem[1].join(''));

            var total = 0;
            switch(operation) {
                case 'add': {
                    total = add(x, y);
                    break;
                }
                case 'subtract': {
                    total = subtract(x, y);
                    break;
                }
                case 'multiply': {
                    total = multiply(x, y);
                    break;
                }
                case 'divide': {
                    total = divide(x, y);
                    break;
                }
            }

            mem[0] = [total];
            mem[1] = [];

            index = 1;
            return total;
        }

        return 0;
    }

    var add = (x, y) => {
        return x + y;
    }

    var subtract = (x, y) => {
        return x - y;
    }

    var multiply = (x, y) => {
        return x * y;
    }

    var divide = (x, y) => {
        return x / y;
    }

    var clear = () => {
        index = 0;
        mem   = [];
        operation = null;

        return 0;
    }

    return {
        // setNumber, 
        getNumbers,
        getNumber,
        setOperation, 
        getOperation,
        getIndex,
        calculate,
        add, 
        subtract, 
        multiply, 
        divide,
        clear,
    }
})();

module.exports = calculator;