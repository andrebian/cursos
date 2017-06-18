'use strict';

const assert = require('assert');
const calculator = require('./calculator');

describe('Testing calculator', function () {
    describe('Should return the sum of elements', function () {
        it('it should return the sum of elements', function () {
            assert.equal(2, calculator().sum(1,1));
        })
    });

    describe('Should return the sub of elements', function () {
        it('it should return the sub of elements', function () {
            assert.equal(0, calculator().sub(1,1));
        })
    })
});
