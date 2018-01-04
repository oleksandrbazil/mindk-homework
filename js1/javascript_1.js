/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/
 * result http://take.ms/yOxbw
 */

/**
 * The generate function
 * @param {number} start - initialized number to increase
 * @param {number} step - step to increase initialized number
 * @return {function} generator function
 */
function sequence(start, step) {
  var start = typeof start !== 'undefined' ? parseInt(start) || 0 : 0;
  var step = typeof step !== 'undefined' ? parseInt(step) || 1 : 1;
  var sequenceIsInited = false;

  return function() {
    if (!sequenceIsInited) {
      sequenceIsInited = true;
      return start;
    } else {
      return (start += step);
    }
  };
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=2
 * result http://take.ms/OYAgp
 */

/**
 * Function to handle execution results of fn function
 * @param {function} fn
 * @param {number} count
 * @return {array} - array of fn function result
 */
function take(fn, count) {
  var count = typeof count !== 'undefined' ? parseInt(count) || 1 : 1;
  var i = 0;
  var result = [];

  if (typeof fn == 'function') {
    for (i; i < count; i++) {
      result[result.length] = fn();
    }
  }
  return result;
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=3
 * result http://take.ms/495CY
 */

/**
 * Collecting results of fn execution for each item in array
 * @param {function} fn
 * @param {array} array
 * @return {array}
 */
function map(fn, array) {
  var array = typeof array !== 'undefined' && Array.isArray(array) ? array : [];
  if (typeof fn == 'function') {
    return array.map(function(item) {
      return fn(item);
    });
  } else {
    return array;
  }
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=4
 * result http://take.ms/01rnm
 */
/**
 * The function creates new type of generate function with start parameter as result of square function (square number)
 * @param {function} square - the squeare function
 * @param {function} gen - the generate function
 * @return {function}
 */
function fmap(square, gen) {
  var genArguments = arguments[1];
  return function(genArguments) {
    return square(gen.apply(this, arguments));
  };
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=5
 * result http://take.ms/dtzRm
 */
function partial(func) {
  var fixedArguments = [].slice.call(arguments, 1);
  return function() {
    return func.apply(this, fixedArguments.concat([].slice.call(arguments, 0)));
  };
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=6
 * result http://take.ms/3Fhu7
 */
function partialAny(func) {
  var fixedArguments = [].slice.call(arguments, 1);
  return function() {
    var flexArguments = [].slice.call(arguments, 0);
    var collectedArguments = fixedArguments.map(function(item) {
      if (typeof item == 'undefined') {
        item = flexArguments[0];
        flexArguments.shift(0);
      }
      return item;
    });
    return func.apply(this, [].concat(collectedArguments, flexArguments));
  };
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=7
 * result http://take.ms/7yzOB
 */
function bind(func, context) {
  return function() {
    return func.apply(context, arguments);
  };
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=8
 * result http://take.ms/B7wzo
 */
/**
 *
 * @param {array} objects
 * @param {string} fieldName
 * @return {array}
 */
function pluck(objects, fieldName) {
  return objects.map(function(item) {
    return item[fieldName];
  });
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=9
 * result http://take.ms/bvnnb
 */
/**
 * The filter function
 * @param {array} array
 * @param {function}
 * @return {array}
 */
function filter(array, func) {
  var result = [];
  array.forEach(function(item) {
    if (func(item)) {
      result[result.length] = item;
    }
  });
  return result;
}
// or
function filter(array, func) {
  return array.reduce(function(previousValue, currentValue) {
    if (func(currentValue)) {
      previousValue[previousValue.length] = currentValue;
    }
    return previousValue;
  }, []);
}

/**
 * ====================================================================================
 * task http://dkab.github.io/jasmine-tests/?spec=10
 * result http://take.ms/mFowK
 */

/**
 * Count object keys
 * @param {object}
 * @param {number}
 */
function count(object) {
  var countObjectKeys = 0;
  for (key in object) {
    if (object.hasOwnProperty(key)) {
      countObjectKeys++;
    }
  }
  return countObjectKeys;
}
