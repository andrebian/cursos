'use strict';

const assert = require('assert');

describe('Test case 1', function () {
    describe('Value exists', function () {
        it('should return -1 when the value is not present', function () {
            assert.equal(-1, [1, 2, 3].indexOf(5));
            assert.equal(-1, [1, 23].indexOf(0));
        });
    });
});