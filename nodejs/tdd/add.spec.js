'use strict';

const assert = require('assert');
const add = require('./add');

assert.equal(3, add(1,2), 'A calculadora falhou');
assert.equal(5, add(1,2,2), 'A calculadora falhou');
assert.equal(10, add(1,2,2,4,1), 'A calculadora falhou');
