const calculator = require('../calculator/calculator');

describe('a calculator', () => {

    beforeEach(() => {
        calculator.clear();
    });

    it('adds a number to stack - 1', () => {
        calculator.setNumber(1);
        var stack = calculator.getNumbers().flat();
    
        expect(stack).toContain(1);
    });

    it('adds a number to stack - 27', () => {
        calculator.setNumber(2);
        calculator.setNumber(7);

        var stack = calculator.getNumber(0);
    
        expect(stack).toBe(27);
    });

    it('sets operation to divide', () => {
        calculator.setNumber(2);
        calculator.setOperation('divide');

        expect(calculator.getOperation()).toMatch('divide');
    });

    it('nothing happens when setting operation before clicking a number', () => {
        calculator.setOperation('multiply');
        expect(calculator.getOperation()).toBeNull();
    });

    it('accepts floating number', () => {
        calculator.setNumber(3);
        calculator.setNumber('.');
        calculator.setNumber(9);

        expect(calculator.getNumber(0)).toBe(3.9);
    });

    it('adds 7 and 55', () => {
        calculator.setNumber(7);
        calculator.setOperation('add');
        calculator.setNumber(55);
        var result = calculator.calculate();

        expect(result).toBe(62);
    });

    it('adds 34, 9, and 72', () => {
        calculator.setNumber(34);
        calculator.setOperation('add');
        calculator.setNumber(9);
        calculator.setOperation('add');
        calculator.setNumber(72);
        var result = calculator.calculate();

        expect(result).toBe(115);
    });

    it('subtracts 56 and 24', () => {
        calculator.setNumber(56);
        calculator.setOperation('subtract');
        calculator.setNumber(24);
        var result = calculator.calculate();

        expect(result).toBe(32);
    });

    it('multiplies 4 and 4', () => {
        calculator.setNumber(4);
        calculator.setOperation('multiply');
        calculator.setNumber(4);

        var result = calculator.calculate();

        expect(result).toBe(16);
    });

    it('divides 124 to 2', () => {
        calculator.setNumber(124);
        calculator.setOperation('divide');
        calculator.setNumber(2);

        var result = calculator.calculate();

        expect(result).toBe(62);
    });
});
