var PusherPushNotifications = (function (exports) {
	'use strict';

	function unwrapExports (x) {
		return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
	}

	function createCommonjsModule(fn, module) {
		return module = { exports: {} }, fn(module, module.exports), module.exports;
	}

	var _typeof_1 = createCommonjsModule(function (module) {
	function _typeof(obj) {
	  "@babel/helpers - typeof";

	  return (module.exports = _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
	    return typeof obj;
	  } : function (obj) {
	    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
	  }, module.exports.__esModule = true, module.exports["default"] = module.exports), _typeof(obj);
	}
	module.exports = _typeof, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _typeof = unwrapExports(_typeof_1);

	var arrayLikeToArray = createCommonjsModule(function (module) {
	function _arrayLikeToArray(arr, len) {
	  if (len == null || len > arr.length) len = arr.length;
	  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];
	  return arr2;
	}
	module.exports = _arrayLikeToArray, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(arrayLikeToArray);

	var arrayWithoutHoles = createCommonjsModule(function (module) {
	function _arrayWithoutHoles(arr) {
	  if (Array.isArray(arr)) return arrayLikeToArray(arr);
	}
	module.exports = _arrayWithoutHoles, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(arrayWithoutHoles);

	var iterableToArray = createCommonjsModule(function (module) {
	function _iterableToArray(iter) {
	  if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
	}
	module.exports = _iterableToArray, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(iterableToArray);

	var unsupportedIterableToArray = createCommonjsModule(function (module) {
	function _unsupportedIterableToArray(o, minLen) {
	  if (!o) return;
	  if (typeof o === "string") return arrayLikeToArray(o, minLen);
	  var n = Object.prototype.toString.call(o).slice(8, -1);
	  if (n === "Object" && o.constructor) n = o.constructor.name;
	  if (n === "Map" || n === "Set") return Array.from(o);
	  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
	}
	module.exports = _unsupportedIterableToArray, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(unsupportedIterableToArray);

	var nonIterableSpread = createCommonjsModule(function (module) {
	function _nonIterableSpread() {
	  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
	}
	module.exports = _nonIterableSpread, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(nonIterableSpread);

	var toConsumableArray = createCommonjsModule(function (module) {
	function _toConsumableArray(arr) {
	  return arrayWithoutHoles(arr) || iterableToArray(arr) || unsupportedIterableToArray(arr) || nonIterableSpread();
	}
	module.exports = _toConsumableArray, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _toConsumableArray = unwrapExports(toConsumableArray);

	var toPrimitive = createCommonjsModule(function (module) {
	var _typeof = _typeof_1["default"];
	function _toPrimitive(input, hint) {
	  if (_typeof(input) !== "object" || input === null) return input;
	  var prim = input[Symbol.toPrimitive];
	  if (prim !== undefined) {
	    var res = prim.call(input, hint || "default");
	    if (_typeof(res) !== "object") return res;
	    throw new TypeError("@@toPrimitive must return a primitive value.");
	  }
	  return (hint === "string" ? String : Number)(input);
	}
	module.exports = _toPrimitive, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(toPrimitive);

	var toPropertyKey = createCommonjsModule(function (module) {
	var _typeof = _typeof_1["default"];

	function _toPropertyKey(arg) {
	  var key = toPrimitive(arg, "string");
	  return _typeof(key) === "symbol" ? key : String(key);
	}
	module.exports = _toPropertyKey, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	unwrapExports(toPropertyKey);

	var defineProperty = createCommonjsModule(function (module) {
	function _defineProperty(obj, key, value) {
	  key = toPropertyKey(key);
	  if (key in obj) {
	    Object.defineProperty(obj, key, {
	      value: value,
	      enumerable: true,
	      configurable: true,
	      writable: true
	    });
	  } else {
	    obj[key] = value;
	  }
	  return obj;
	}
	module.exports = _defineProperty, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _defineProperty = unwrapExports(defineProperty);

	var asyncToGenerator = createCommonjsModule(function (module) {
	function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
	  try {
	    var info = gen[key](arg);
	    var value = info.value;
	  } catch (error) {
	    reject(error);
	    return;
	  }
	  if (info.done) {
	    resolve(value);
	  } else {
	    Promise.resolve(value).then(_next, _throw);
	  }
	}
	function _asyncToGenerator(fn) {
	  return function () {
	    var self = this,
	      args = arguments;
	    return new Promise(function (resolve, reject) {
	      var gen = fn.apply(self, args);
	      function _next(value) {
	        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
	      }
	      function _throw(err) {
	        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
	      }
	      _next(undefined);
	    });
	  };
	}
	module.exports = _asyncToGenerator, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _asyncToGenerator = unwrapExports(asyncToGenerator);

	var classCallCheck = createCommonjsModule(function (module) {
	function _classCallCheck(instance, Constructor) {
	  if (!(instance instanceof Constructor)) {
	    throw new TypeError("Cannot call a class as a function");
	  }
	}
	module.exports = _classCallCheck, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _classCallCheck = unwrapExports(classCallCheck);

	var createClass = createCommonjsModule(function (module) {
	function _defineProperties(target, props) {
	  for (var i = 0; i < props.length; i++) {
	    var descriptor = props[i];
	    descriptor.enumerable = descriptor.enumerable || false;
	    descriptor.configurable = true;
	    if ("value" in descriptor) descriptor.writable = true;
	    Object.defineProperty(target, toPropertyKey(descriptor.key), descriptor);
	  }
	}
	function _createClass(Constructor, protoProps, staticProps) {
	  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
	  if (staticProps) _defineProperties(Constructor, staticProps);
	  Object.defineProperty(Constructor, "prototype", {
	    writable: false
	  });
	  return Constructor;
	}
	module.exports = _createClass, module.exports.__esModule = true, module.exports["default"] = module.exports;
	});

	var _createClass = unwrapExports(createClass);

	function _regeneratorRuntime() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
	function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
	function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
	function doRequest(_ref) {
	  var method = _ref.method,
	    path = _ref.path,
	    _ref$params = _ref.params,
	    params = _ref$params === void 0 ? {} : _ref$params,
	    _ref$body = _ref.body,
	    body = _ref$body === void 0 ? null : _ref$body,
	    _ref$headers = _ref.headers,
	    headers = _ref$headers === void 0 ? {} : _ref$headers,
	    _ref$credentials = _ref.credentials,
	    credentials = _ref$credentials === void 0 ? 'same-origin' : _ref$credentials;
	  var options = {
	    method: method,
	    headers: headers,
	    credentials: credentials
	  };
	  if (!emptyParams(params)) {
	    // check for empty params obj
	    path += '?';
	    path += Object.entries(params).filter(function (x) {
	      return x[1];
	    }).map(function (pair) {
	      return pair.map(function (x) {
	        return encodeURIComponent(x);
	      }).join('=');
	    }).join('&');
	  }
	  if (body !== null) {
	    options.body = JSON.stringify(body);
	    options.headers = _objectSpread({
	      'Content-Type': 'application/json'
	    }, headers);
	  }
	  return fetch(path, options).then( /*#__PURE__*/function () {
	    var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(response) {
	      return _regeneratorRuntime().wrap(function _callee$(_context) {
	        while (1) switch (_context.prev = _context.next) {
	          case 0:
	            if (response.ok) {
	              _context.next = 3;
	              break;
	            }
	            _context.next = 3;
	            return handleError(response);
	          case 3:
	            _context.prev = 3;
	            _context.next = 6;
	            return response.json();
	          case 6:
	            return _context.abrupt("return", _context.sent);
	          case 9:
	            _context.prev = 9;
	            _context.t0 = _context["catch"](3);
	            return _context.abrupt("return", null);
	          case 12:
	          case "end":
	            return _context.stop();
	        }
	      }, _callee, null, [[3, 9]]);
	    }));
	    return function (_x) {
	      return _ref2.apply(this, arguments);
	    };
	  }());
	}
	function emptyParams(params) {
	  for (var i in params) return false;
	  return true;
	}
	function handleError(_x2) {
	  return _handleError.apply(this, arguments);
	}
	function _handleError() {
	  _handleError = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(response) {
	    var errorMessage, _yield$response$json, _yield$response$json$, error, _yield$response$json$2, description;
	    return _regeneratorRuntime().wrap(function _callee2$(_context2) {
	      while (1) switch (_context2.prev = _context2.next) {
	        case 0:
	          _context2.prev = 0;
	          _context2.next = 3;
	          return response.json();
	        case 3:
	          _yield$response$json = _context2.sent;
	          _yield$response$json$ = _yield$response$json.error;
	          error = _yield$response$json$ === void 0 ? 'Unknown error' : _yield$response$json$;
	          _yield$response$json$2 = _yield$response$json.description;
	          description = _yield$response$json$2 === void 0 ? 'No description' : _yield$response$json$2;
	          errorMessage = "Unexpected status code ".concat(response.status, ": ").concat(error, ", ").concat(description);
	          _context2.next = 14;
	          break;
	        case 11:
	          _context2.prev = 11;
	          _context2.t0 = _context2["catch"](0);
	          errorMessage = "Unexpected status code ".concat(response.status, ": Cannot parse error response");
	        case 14:
	          throw new Error(errorMessage);
	        case 15:
	        case "end":
	          return _context2.stop();
	      }
	    }, _callee2, null, [[0, 11]]);
	  }));
	  return _handleError.apply(this, arguments);
	}

	function _regeneratorRuntime$1() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime$1 = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
	function ownKeys$1(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
	function _objectSpread$1(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$1(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$1(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
	var TokenProvider = /*#__PURE__*/function () {
	  function TokenProvider() {
	    var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
	      url = _ref.url,
	      queryParams = _ref.queryParams,
	      headers = _ref.headers,
	      credentials = _ref.credentials;
	    _classCallCheck(this, TokenProvider);
	    this.url = url;
	    this.queryParams = queryParams;
	    this.headers = headers;
	    this.credentials = credentials;
	  }
	  _createClass(TokenProvider, [{
	    key: "fetchToken",
	    value: function () {
	      var _fetchToken = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$1().mark(function _callee(userId) {
	        var queryParams, encodedParams, options, response;
	        return _regeneratorRuntime$1().wrap(function _callee$(_context) {
	          while (1) switch (_context.prev = _context.next) {
	            case 0:
	              queryParams = _objectSpread$1({
	                user_id: userId
	              }, this.queryParams);
	              encodedParams = Object.entries(queryParams).map(function (kv) {
	                return kv.map(encodeURIComponent).join('=');
	              }).join('&');
	              options = {
	                method: 'GET',
	                path: "".concat(this.url, "?").concat(encodedParams),
	                headers: this.headers,
	                credentials: this.credentials
	              };
	              _context.next = 5;
	              return doRequest(options);
	            case 5:
	              response = _context.sent;
	              return _context.abrupt("return", response);
	            case 7:
	            case "end":
	              return _context.stop();
	          }
	        }, _callee, this);
	      }));
	      function fetchToken(_x) {
	        return _fetchToken.apply(this, arguments);
	      }
	      return fetchToken;
	    }()
	  }]);
	  return TokenProvider;
	}();

	function _regeneratorRuntime$2() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime$2 = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
	var DeviceStateStore = /*#__PURE__*/function () {
	  function DeviceStateStore(instanceId) {
	    _classCallCheck(this, DeviceStateStore);
	    this._instanceId = instanceId;
	    this._dbConn = null;
	  }
	  _createClass(DeviceStateStore, [{
	    key: "_dbName",
	    get: function get() {
	      return "beams-".concat(this._instanceId);
	    }
	  }, {
	    key: "isConnected",
	    get: function get() {
	      return this._dbConn !== null;
	    }
	  }, {
	    key: "connect",
	    value: function connect() {
	      var _this = this;
	      return new Promise(function (resolve, reject) {
	        var request = indexedDB.open(_this._dbName);
	        request.onsuccess = function (event) {
	          var db = event.target.result;
	          _this._dbConn = db;
	          _this._readState().then(function (state) {
	            return state === null ? _this.clear() : Promise.resolve();
	          }).then(resolve);
	        };
	        request.onupgradeneeded = function (event) {
	          var db = event.target.result;
	          db.createObjectStore('beams', {
	            keyPath: 'instance_id'
	          });
	        };
	        request.onerror = function (event) {
	          var error = new Error("Database error: ".concat(event.target.error));
	          reject(error);
	        };
	      });
	    }
	  }, {
	    key: "clear",
	    value: function clear() {
	      return this._writeState({
	        instance_id: this._instanceId,
	        device_id: null,
	        token: null,
	        user_id: null
	      });
	    }
	  }, {
	    key: "_readState",
	    value: function _readState() {
	      var _this2 = this;
	      if (!this.isConnected) {
	        throw new Error('Cannot read value: DeviceStateStore not connected to IndexedDB');
	      }
	      return new Promise(function (resolve, reject) {
	        var request = _this2._dbConn.transaction('beams').objectStore('beams').get(_this2._instanceId);
	        request.onsuccess = function (event) {
	          var state = event.target.result;
	          if (!state) {
	            resolve(null);
	          }
	          resolve(state);
	        };
	        request.onerror = function (event) {
	          reject(event.target.error);
	        };
	      });
	    }
	  }, {
	    key: "_readProperty",
	    value: function () {
	      var _readProperty2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$2().mark(function _callee(name) {
	        var state;
	        return _regeneratorRuntime$2().wrap(function _callee$(_context) {
	          while (1) switch (_context.prev = _context.next) {
	            case 0:
	              _context.next = 2;
	              return this._readState();
	            case 2:
	              state = _context.sent;
	              if (!(state === null)) {
	                _context.next = 5;
	                break;
	              }
	              return _context.abrupt("return", null);
	            case 5:
	              return _context.abrupt("return", state[name] || null);
	            case 6:
	            case "end":
	              return _context.stop();
	          }
	        }, _callee, this);
	      }));
	      function _readProperty(_x) {
	        return _readProperty2.apply(this, arguments);
	      }
	      return _readProperty;
	    }()
	  }, {
	    key: "_writeState",
	    value: function _writeState(state) {
	      var _this3 = this;
	      if (!this.isConnected) {
	        throw new Error('Cannot write value: DeviceStateStore not connected to IndexedDB');
	      }
	      return new Promise(function (resolve, reject) {
	        var request = _this3._dbConn.transaction('beams', 'readwrite').objectStore('beams').put(state);
	        request.onsuccess = function (_) {
	          resolve();
	        };
	        request.onerror = function (event) {
	          reject(event.target.error);
	        };
	      });
	    }
	  }, {
	    key: "_writeProperty",
	    value: function () {
	      var _writeProperty2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$2().mark(function _callee2(name, value) {
	        var state;
	        return _regeneratorRuntime$2().wrap(function _callee2$(_context2) {
	          while (1) switch (_context2.prev = _context2.next) {
	            case 0:
	              _context2.next = 2;
	              return this._readState();
	            case 2:
	              state = _context2.sent;
	              state[name] = value;
	              _context2.next = 6;
	              return this._writeState(state);
	            case 6:
	            case "end":
	              return _context2.stop();
	          }
	        }, _callee2, this);
	      }));
	      function _writeProperty(_x2, _x3) {
	        return _writeProperty2.apply(this, arguments);
	      }
	      return _writeProperty;
	    }()
	  }, {
	    key: "getToken",
	    value: function getToken() {
	      return this._readProperty('token');
	    }
	  }, {
	    key: "setToken",
	    value: function setToken(token) {
	      return this._writeProperty('token', token);
	    }
	  }, {
	    key: "getDeviceId",
	    value: function getDeviceId() {
	      return this._readProperty('device_id');
	    }
	  }, {
	    key: "setDeviceId",
	    value: function setDeviceId(deviceId) {
	      return this._writeProperty('device_id', deviceId);
	    }
	  }, {
	    key: "getUserId",
	    value: function getUserId() {
	      return this._readProperty('user_id');
	    }
	  }, {
	    key: "setUserId",
	    value: function setUserId(userId) {
	      return this._writeProperty('user_id', userId);
	    }
	  }, {
	    key: "getLastSeenSdkVersion",
	    value: function getLastSeenSdkVersion() {
	      return this._readProperty('last_seen_sdk_version');
	    }
	  }, {
	    key: "setLastSeenSdkVersion",
	    value: function setLastSeenSdkVersion(sdkVersion) {
	      return this._writeProperty('last_seen_sdk_version', sdkVersion);
	    }
	  }, {
	    key: "getLastSeenUserAgent",
	    value: function getLastSeenUserAgent() {
	      return this._readProperty('last_seen_user_agent');
	    }
	  }, {
	    key: "setLastSeenUserAgent",
	    value: function setLastSeenUserAgent(userAgent) {
	      return this._writeProperty('last_seen_user_agent', userAgent);
	    }
	  }]);
	  return DeviceStateStore;
	}();

	var version = "2.0.0";

	function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
	function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
	function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
	function ownKeys$2(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
	function _objectSpread$2(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$2(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$2(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
	function _regeneratorRuntime$3() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime$3 = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
	var INTERESTS_REGEX = new RegExp('^(_|\\-|=|@|,|\\.|;|[A-Z]|[a-z]|[0-9])*$');
	var MAX_INTEREST_LENGTH = 164;
	var MAX_INTERESTS_NUM = 5000;
	var SERVICE_WORKER_URL = "/service-worker.js?pusherBeamsWebSDKVersion=".concat(version);
	var RegistrationState = Object.freeze({
	  PERMISSION_PROMPT_REQUIRED: 'PERMISSION_PROMPT_REQUIRED',
	  PERMISSION_GRANTED_NOT_REGISTERED_WITH_BEAMS: 'PERMISSION_GRANTED_NOT_REGISTERED_WITH_BEAMS',
	  PERMISSION_GRANTED_REGISTERED_WITH_BEAMS: 'PERMISSION_GRANTED_REGISTERED_WITH_BEAMS',
	  PERMISSION_DENIED: 'PERMISSION_DENIED'
	});
	var Client = /*#__PURE__*/function () {
	  function Client(config) {
	    _classCallCheck(this, Client);
	    if (!config) {
	      throw new Error('Config object required');
	    }
	    var instanceId = config.instanceId,
	      _config$endpointOverr = config.endpointOverride,
	      endpointOverride = _config$endpointOverr === void 0 ? null : _config$endpointOverr,
	      _config$serviceWorker = config.serviceWorkerRegistration,
	      serviceWorkerRegistration = _config$serviceWorker === void 0 ? null : _config$serviceWorker;
	    if (instanceId === undefined) {
	      throw new Error('Instance ID is required');
	    }
	    if (typeof instanceId !== 'string') {
	      throw new Error('Instance ID must be a string');
	    }
	    if (instanceId.length === 0) {
	      throw new Error('Instance ID cannot be empty');
	    }
	    if (!('indexedDB' in window)) {
	      throw new Error('Pusher Beams does not support this browser version (IndexedDB not supported)');
	    }
	    if (!window.isSecureContext) {
	      throw new Error('Pusher Beams relies on Service Workers, which only work in secure contexts. Check that your page is being served from localhost/over HTTPS');
	    }
	    if (!('serviceWorker' in navigator)) {
	      throw new Error('Pusher Beams does not support this browser version (Service Workers not supported)');
	    }
	    if (!('PushManager' in window)) {
	      throw new Error('Pusher Beams does not support this browser version (Web Push not supported)');
	    }
	    if (serviceWorkerRegistration) {
	      var serviceWorkerScope = serviceWorkerRegistration.scope;
	      var currentURL = window.location.href;
	      var scopeMatchesCurrentPage = currentURL.startsWith(serviceWorkerScope);
	      if (!scopeMatchesCurrentPage) {
	        throw new Error("Could not initialize Pusher web push: current page not in serviceWorkerRegistration scope (".concat(serviceWorkerScope, ")"));
	      }
	    }
	    this.instanceId = instanceId;
	    this._deviceId = null;
	    this._token = null;
	    this._userId = null;
	    this._serviceWorkerRegistration = serviceWorkerRegistration;
	    this._deviceStateStore = new DeviceStateStore(instanceId);
	    this._endpoint = endpointOverride; // Internal only

	    this._ready = this._init();
	  }
	  _createClass(Client, [{
	    key: "_init",
	    value: function () {
	      var _init2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee() {
	        return _regeneratorRuntime$3().wrap(function _callee$(_context) {
	          while (1) switch (_context.prev = _context.next) {
	            case 0:
	              if (!(this._deviceId !== null)) {
	                _context.next = 2;
	                break;
	              }
	              return _context.abrupt("return");
	            case 2:
	              _context.next = 4;
	              return this._deviceStateStore.connect();
	            case 4:
	              if (!this._serviceWorkerRegistration) {
	                _context.next = 9;
	                break;
	              }
	              _context.next = 7;
	              return window.navigator.serviceWorker.ready;
	            case 7:
	              _context.next = 12;
	              break;
	            case 9:
	              _context.next = 11;
	              return getServiceWorkerRegistration();
	            case 11:
	              this._serviceWorkerRegistration = _context.sent;
	            case 12:
	              _context.next = 14;
	              return this._detectSubscriptionChange();
	            case 14:
	              _context.next = 16;
	              return this._deviceStateStore.getDeviceId();
	            case 16:
	              this._deviceId = _context.sent;
	              _context.next = 19;
	              return this._deviceStateStore.getToken();
	            case 19:
	              this._token = _context.sent;
	              _context.next = 22;
	              return this._deviceStateStore.getUserId();
	            case 22:
	              this._userId = _context.sent;
	            case 23:
	            case "end":
	              return _context.stop();
	          }
	        }, _callee, this);
	      }));
	      function _init() {
	        return _init2.apply(this, arguments);
	      }
	      return _init;
	    }() // Ensure SDK is loaded and is consistent
	  }, {
	    key: "_resolveSDKState",
	    value: function () {
	      var _resolveSDKState2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee2() {
	        return _regeneratorRuntime$3().wrap(function _callee2$(_context2) {
	          while (1) switch (_context2.prev = _context2.next) {
	            case 0:
	              _context2.next = 2;
	              return this._ready;
	            case 2:
	              _context2.next = 4;
	              return this._detectSubscriptionChange();
	            case 4:
	            case "end":
	              return _context2.stop();
	          }
	        }, _callee2, this);
	      }));
	      function _resolveSDKState() {
	        return _resolveSDKState2.apply(this, arguments);
	      }
	      return _resolveSDKState;
	    }()
	  }, {
	    key: "_detectSubscriptionChange",
	    value: function () {
	      var _detectSubscriptionChange2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee3() {
	        var storedToken, actualToken, pushTokenHasChanged;
	        return _regeneratorRuntime$3().wrap(function _callee3$(_context3) {
	          while (1) switch (_context3.prev = _context3.next) {
	            case 0:
	              _context3.next = 2;
	              return this._deviceStateStore.getToken();
	            case 2:
	              storedToken = _context3.sent;
	              _context3.next = 5;
	              return getWebPushToken(this._serviceWorkerRegistration);
	            case 5:
	              actualToken = _context3.sent;
	              pushTokenHasChanged = storedToken !== actualToken;
	              if (!pushTokenHasChanged) {
	                _context3.next = 13;
	                break;
	              }
	              _context3.next = 10;
	              return this._deviceStateStore.clear();
	            case 10:
	              this._deviceId = null;
	              this._token = null;
	              this._userId = null;
	            case 13:
	            case "end":
	              return _context3.stop();
	          }
	        }, _callee3, this);
	      }));
	      function _detectSubscriptionChange() {
	        return _detectSubscriptionChange2.apply(this, arguments);
	      }
	      return _detectSubscriptionChange;
	    }()
	  }, {
	    key: "getDeviceId",
	    value: function () {
	      var _getDeviceId = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee4() {
	        var _this = this;
	        return _regeneratorRuntime$3().wrap(function _callee4$(_context4) {
	          while (1) switch (_context4.prev = _context4.next) {
	            case 0:
	              _context4.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              return _context4.abrupt("return", this._ready.then(function () {
	                return _this._deviceId;
	              }));
	            case 3:
	            case "end":
	              return _context4.stop();
	          }
	        }, _callee4, this);
	      }));
	      function getDeviceId() {
	        return _getDeviceId.apply(this, arguments);
	      }
	      return getDeviceId;
	    }()
	  }, {
	    key: "getToken",
	    value: function () {
	      var _getToken = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee5() {
	        var _this2 = this;
	        return _regeneratorRuntime$3().wrap(function _callee5$(_context5) {
	          while (1) switch (_context5.prev = _context5.next) {
	            case 0:
	              _context5.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              return _context5.abrupt("return", this._ready.then(function () {
	                return _this2._token;
	              }));
	            case 3:
	            case "end":
	              return _context5.stop();
	          }
	        }, _callee5, this);
	      }));
	      function getToken() {
	        return _getToken.apply(this, arguments);
	      }
	      return getToken;
	    }()
	  }, {
	    key: "getUserId",
	    value: function () {
	      var _getUserId = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee6() {
	        var _this3 = this;
	        return _regeneratorRuntime$3().wrap(function _callee6$(_context6) {
	          while (1) switch (_context6.prev = _context6.next) {
	            case 0:
	              _context6.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              return _context6.abrupt("return", this._ready.then(function () {
	                return _this3._userId;
	              }));
	            case 3:
	            case "end":
	              return _context6.stop();
	          }
	        }, _callee6, this);
	      }));
	      function getUserId() {
	        return _getUserId.apply(this, arguments);
	      }
	      return getUserId;
	    }()
	  }, {
	    key: "_baseURL",
	    get: function get() {
	      if (this._endpoint !== null) {
	        return this._endpoint;
	      }
	      return "https://".concat(this.instanceId, ".pushnotifications.pusher.com");
	    }
	  }, {
	    key: "_throwIfNotStarted",
	    value: function _throwIfNotStarted(message) {
	      if (!this._deviceId) {
	        throw new Error("".concat(message, ". SDK not registered with Beams. Did you call .start?"));
	      }
	    }
	  }, {
	    key: "start",
	    value: function () {
	      var _start = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee7() {
	        var _yield$this$_getPubli, publicKey, token, deviceId;
	        return _regeneratorRuntime$3().wrap(function _callee7$(_context7) {
	          while (1) switch (_context7.prev = _context7.next) {
	            case 0:
	              _context7.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              if (isSupportedBrowser()) {
	                _context7.next = 4;
	                break;
	              }
	              return _context7.abrupt("return", this);
	            case 4:
	              if (!(this._deviceId !== null)) {
	                _context7.next = 6;
	                break;
	              }
	              return _context7.abrupt("return", this);
	            case 6:
	              _context7.next = 8;
	              return this._getPublicKey();
	            case 8:
	              _yield$this$_getPubli = _context7.sent;
	              publicKey = _yield$this$_getPubli.vapidPublicKey;
	              _context7.next = 12;
	              return this._getPushToken(publicKey);
	            case 12:
	              token = _context7.sent;
	              _context7.next = 15;
	              return this._registerDevice(token);
	            case 15:
	              deviceId = _context7.sent;
	              _context7.next = 18;
	              return this._deviceStateStore.setToken(token);
	            case 18:
	              _context7.next = 20;
	              return this._deviceStateStore.setDeviceId(deviceId);
	            case 20:
	              _context7.next = 22;
	              return this._deviceStateStore.setLastSeenSdkVersion(version);
	            case 22:
	              _context7.next = 24;
	              return this._deviceStateStore.setLastSeenUserAgent(window.navigator.userAgent);
	            case 24:
	              this._token = token;
	              this._deviceId = deviceId;
	              return _context7.abrupt("return", this);
	            case 27:
	            case "end":
	              return _context7.stop();
	          }
	        }, _callee7, this);
	      }));
	      function start() {
	        return _start.apply(this, arguments);
	      }
	      return start;
	    }()
	  }, {
	    key: "getRegistrationState",
	    value: function () {
	      var _getRegistrationState = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee8() {
	        return _regeneratorRuntime$3().wrap(function _callee8$(_context8) {
	          while (1) switch (_context8.prev = _context8.next) {
	            case 0:
	              _context8.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              if (!(Notification.permission === 'denied')) {
	                _context8.next = 4;
	                break;
	              }
	              return _context8.abrupt("return", RegistrationState.PERMISSION_DENIED);
	            case 4:
	              if (!(Notification.permission === 'granted' && this._deviceId !== null)) {
	                _context8.next = 6;
	                break;
	              }
	              return _context8.abrupt("return", RegistrationState.PERMISSION_GRANTED_REGISTERED_WITH_BEAMS);
	            case 6:
	              if (!(Notification.permission === 'granted' && this._deviceId === null)) {
	                _context8.next = 8;
	                break;
	              }
	              return _context8.abrupt("return", RegistrationState.PERMISSION_GRANTED_NOT_REGISTERED_WITH_BEAMS);
	            case 8:
	              return _context8.abrupt("return", RegistrationState.PERMISSION_PROMPT_REQUIRED);
	            case 9:
	            case "end":
	              return _context8.stop();
	          }
	        }, _callee8, this);
	      }));
	      function getRegistrationState() {
	        return _getRegistrationState.apply(this, arguments);
	      }
	      return getRegistrationState;
	    }()
	  }, {
	    key: "addDeviceInterest",
	    value: function () {
	      var _addDeviceInterest = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee9(interest) {
	        var path, options;
	        return _regeneratorRuntime$3().wrap(function _callee9$(_context9) {
	          while (1) switch (_context9.prev = _context9.next) {
	            case 0:
	              _context9.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              this._throwIfNotStarted('Could not add Device Interest');
	              validateInterestName(interest);
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/interests/").concat(encodeURIComponent(interest));
	              options = {
	                method: 'POST',
	                path: path
	              };
	              _context9.next = 8;
	              return doRequest(options);
	            case 8:
	            case "end":
	              return _context9.stop();
	          }
	        }, _callee9, this);
	      }));
	      function addDeviceInterest(_x) {
	        return _addDeviceInterest.apply(this, arguments);
	      }
	      return addDeviceInterest;
	    }()
	  }, {
	    key: "removeDeviceInterest",
	    value: function () {
	      var _removeDeviceInterest = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee10(interest) {
	        var path, options;
	        return _regeneratorRuntime$3().wrap(function _callee10$(_context10) {
	          while (1) switch (_context10.prev = _context10.next) {
	            case 0:
	              _context10.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              this._throwIfNotStarted('Could not remove Device Interest');
	              validateInterestName(interest);
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/interests/").concat(encodeURIComponent(interest));
	              options = {
	                method: 'DELETE',
	                path: path
	              };
	              _context10.next = 8;
	              return doRequest(options);
	            case 8:
	            case "end":
	              return _context10.stop();
	          }
	        }, _callee10, this);
	      }));
	      function removeDeviceInterest(_x2) {
	        return _removeDeviceInterest.apply(this, arguments);
	      }
	      return removeDeviceInterest;
	    }()
	  }, {
	    key: "getDeviceInterests",
	    value: function () {
	      var _getDeviceInterests = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee11() {
	        var limit,
	          cursor,
	          path,
	          options,
	          res,
	          _args11 = arguments;
	        return _regeneratorRuntime$3().wrap(function _callee11$(_context11) {
	          while (1) switch (_context11.prev = _context11.next) {
	            case 0:
	              limit = _args11.length > 0 && _args11[0] !== undefined ? _args11[0] : 100;
	              cursor = _args11.length > 1 && _args11[1] !== undefined ? _args11[1] : null;
	              _context11.next = 4;
	              return this._resolveSDKState();
	            case 4:
	              this._throwIfNotStarted('Could not get Device Interests');
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/interests");
	              options = {
	                method: 'GET',
	                path: path,
	                params: {
	                  limit: limit,
	                  cursor: cursor
	                }
	              };
	              _context11.next = 9;
	              return doRequest(options);
	            case 9:
	              res = _context11.sent;
	              res = _objectSpread$2({
	                interests: res && res['interests'] || []
	              }, res && res.responseMetadata || {});
	              return _context11.abrupt("return", res);
	            case 12:
	            case "end":
	              return _context11.stop();
	          }
	        }, _callee11, this);
	      }));
	      function getDeviceInterests() {
	        return _getDeviceInterests.apply(this, arguments);
	      }
	      return getDeviceInterests;
	    }()
	  }, {
	    key: "setDeviceInterests",
	    value: function () {
	      var _setDeviceInterests = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee12(interests) {
	        var _iterator, _step, interest, uniqueInterests, path, options;
	        return _regeneratorRuntime$3().wrap(function _callee12$(_context12) {
	          while (1) switch (_context12.prev = _context12.next) {
	            case 0:
	              _context12.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              this._throwIfNotStarted('Could not set Device Interests');
	              if (!(interests === undefined || interests === null)) {
	                _context12.next = 5;
	                break;
	              }
	              throw new Error('interests argument is required');
	            case 5:
	              if (Array.isArray(interests)) {
	                _context12.next = 7;
	                break;
	              }
	              throw new Error('interests argument must be an array');
	            case 7:
	              if (!(interests.length > MAX_INTERESTS_NUM)) {
	                _context12.next = 9;
	                break;
	              }
	              throw new Error("Number of interests (".concat(interests.length, ") exceeds maximum of ").concat(MAX_INTERESTS_NUM));
	            case 9:
	              _iterator = _createForOfIteratorHelper(interests);
	              try {
	                for (_iterator.s(); !(_step = _iterator.n()).done;) {
	                  interest = _step.value;
	                  validateInterestName(interest);
	                }
	              } catch (err) {
	                _iterator.e(err);
	              } finally {
	                _iterator.f();
	              }
	              uniqueInterests = Array.from(new Set(interests));
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/interests");
	              options = {
	                method: 'PUT',
	                path: path,
	                body: {
	                  interests: uniqueInterests
	                }
	              };
	              _context12.next = 16;
	              return doRequest(options);
	            case 16:
	            case "end":
	              return _context12.stop();
	          }
	        }, _callee12, this);
	      }));
	      function setDeviceInterests(_x3) {
	        return _setDeviceInterests.apply(this, arguments);
	      }
	      return setDeviceInterests;
	    }()
	  }, {
	    key: "clearDeviceInterests",
	    value: function () {
	      var _clearDeviceInterests = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee13() {
	        return _regeneratorRuntime$3().wrap(function _callee13$(_context13) {
	          while (1) switch (_context13.prev = _context13.next) {
	            case 0:
	              _context13.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              this._throwIfNotStarted('Could not clear Device Interests');
	              _context13.next = 5;
	              return this.setDeviceInterests([]);
	            case 5:
	            case "end":
	              return _context13.stop();
	          }
	        }, _callee13, this);
	      }));
	      function clearDeviceInterests() {
	        return _clearDeviceInterests.apply(this, arguments);
	      }
	      return clearDeviceInterests;
	    }()
	  }, {
	    key: "setUserId",
	    value: function () {
	      var _setUserId = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee14(userId, tokenProvider) {
	        var error, path, _yield$tokenProvider$, beamsAuthToken, options;
	        return _regeneratorRuntime$3().wrap(function _callee14$(_context14) {
	          while (1) switch (_context14.prev = _context14.next) {
	            case 0:
	              _context14.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              if (isSupportedBrowser()) {
	                _context14.next = 4;
	                break;
	              }
	              return _context14.abrupt("return");
	            case 4:
	              if (!(this._deviceId === null)) {
	                _context14.next = 7;
	                break;
	              }
	              error = new Error('.start must be called before .setUserId');
	              return _context14.abrupt("return", Promise.reject(error));
	            case 7:
	              if (!(typeof userId !== 'string')) {
	                _context14.next = 9;
	                break;
	              }
	              throw new Error("User ID must be a string (was ".concat(userId, ")"));
	            case 9:
	              if (!(userId === '')) {
	                _context14.next = 11;
	                break;
	              }
	              throw new Error('User ID cannot be the empty string');
	            case 11:
	              if (!(this._userId !== null && this._userId !== userId)) {
	                _context14.next = 13;
	                break;
	              }
	              throw new Error('Changing the `userId` is not allowed.');
	            case 13:
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/user");
	              _context14.next = 16;
	              return tokenProvider.fetchToken(userId);
	            case 16:
	              _yield$tokenProvider$ = _context14.sent;
	              beamsAuthToken = _yield$tokenProvider$.token;
	              options = {
	                method: 'PUT',
	                path: path,
	                headers: {
	                  Authorization: "Bearer ".concat(beamsAuthToken)
	                }
	              };
	              _context14.next = 21;
	              return doRequest(options);
	            case 21:
	              this._userId = userId;
	              return _context14.abrupt("return", this._deviceStateStore.setUserId(userId));
	            case 23:
	            case "end":
	              return _context14.stop();
	          }
	        }, _callee14, this);
	      }));
	      function setUserId(_x4, _x5) {
	        return _setUserId.apply(this, arguments);
	      }
	      return setUserId;
	    }()
	  }, {
	    key: "stop",
	    value: function () {
	      var _stop = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee15() {
	        return _regeneratorRuntime$3().wrap(function _callee15$(_context15) {
	          while (1) switch (_context15.prev = _context15.next) {
	            case 0:
	              _context15.next = 2;
	              return this._resolveSDKState();
	            case 2:
	              if (isSupportedBrowser()) {
	                _context15.next = 4;
	                break;
	              }
	              return _context15.abrupt("return");
	            case 4:
	              if (!(this._deviceId === null)) {
	                _context15.next = 6;
	                break;
	              }
	              return _context15.abrupt("return");
	            case 6:
	              _context15.next = 8;
	              return this._deleteDevice();
	            case 8:
	              _context15.next = 10;
	              return this._deviceStateStore.clear();
	            case 10:
	              this._clearPushToken()["catch"](function () {}); // Not awaiting this, best effort.

	              this._deviceId = null;
	              this._token = null;
	              this._userId = null;
	            case 14:
	            case "end":
	              return _context15.stop();
	          }
	        }, _callee15, this);
	      }));
	      function stop() {
	        return _stop.apply(this, arguments);
	      }
	      return stop;
	    }()
	  }, {
	    key: "clearAllState",
	    value: function () {
	      var _clearAllState = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee16() {
	        return _regeneratorRuntime$3().wrap(function _callee16$(_context16) {
	          while (1) switch (_context16.prev = _context16.next) {
	            case 0:
	              if (isSupportedBrowser()) {
	                _context16.next = 2;
	                break;
	              }
	              return _context16.abrupt("return");
	            case 2:
	              _context16.next = 4;
	              return this.stop();
	            case 4:
	              _context16.next = 6;
	              return this.start();
	            case 6:
	            case "end":
	              return _context16.stop();
	          }
	        }, _callee16, this);
	      }));
	      function clearAllState() {
	        return _clearAllState.apply(this, arguments);
	      }
	      return clearAllState;
	    }()
	  }, {
	    key: "_getPublicKey",
	    value: function () {
	      var _getPublicKey2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee17() {
	        var path, options;
	        return _regeneratorRuntime$3().wrap(function _callee17$(_context17) {
	          while (1) switch (_context17.prev = _context17.next) {
	            case 0:
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/web-vapid-public-key");
	              options = {
	                method: 'GET',
	                path: path
	              };
	              return _context17.abrupt("return", doRequest(options));
	            case 3:
	            case "end":
	              return _context17.stop();
	          }
	        }, _callee17, this);
	      }));
	      function _getPublicKey() {
	        return _getPublicKey2.apply(this, arguments);
	      }
	      return _getPublicKey;
	    }()
	  }, {
	    key: "_getPushToken",
	    value: function () {
	      var _getPushToken2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee18(publicKey) {
	        var sub;
	        return _regeneratorRuntime$3().wrap(function _callee18$(_context18) {
	          while (1) switch (_context18.prev = _context18.next) {
	            case 0:
	              _context18.prev = 0;
	              _context18.next = 3;
	              return this._clearPushToken();
	            case 3:
	              _context18.next = 5;
	              return this._serviceWorkerRegistration.pushManager.subscribe({
	                userVisibleOnly: true,
	                applicationServerKey: urlBase64ToUInt8Array(publicKey)
	              });
	            case 5:
	              sub = _context18.sent;
	              return _context18.abrupt("return", btoa(JSON.stringify(sub)));
	            case 9:
	              _context18.prev = 9;
	              _context18.t0 = _context18["catch"](0);
	              return _context18.abrupt("return", Promise.reject(_context18.t0));
	            case 12:
	            case "end":
	              return _context18.stop();
	          }
	        }, _callee18, this, [[0, 9]]);
	      }));
	      function _getPushToken(_x6) {
	        return _getPushToken2.apply(this, arguments);
	      }
	      return _getPushToken;
	    }()
	  }, {
	    key: "_clearPushToken",
	    value: function () {
	      var _clearPushToken2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee19() {
	        return _regeneratorRuntime$3().wrap(function _callee19$(_context19) {
	          while (1) switch (_context19.prev = _context19.next) {
	            case 0:
	              return _context19.abrupt("return", navigator.serviceWorker.ready.then(function (reg) {
	                return reg.pushManager.getSubscription();
	              }).then(function (sub) {
	                if (sub) sub.unsubscribe();
	              }));
	            case 1:
	            case "end":
	              return _context19.stop();
	          }
	        }, _callee19);
	      }));
	      function _clearPushToken() {
	        return _clearPushToken2.apply(this, arguments);
	      }
	      return _clearPushToken;
	    }()
	  }, {
	    key: "_registerDevice",
	    value: function () {
	      var _registerDevice2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee20(token) {
	        var path, device, options, response;
	        return _regeneratorRuntime$3().wrap(function _callee20$(_context20) {
	          while (1) switch (_context20.prev = _context20.next) {
	            case 0:
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web");
	              device = {
	                token: token,
	                metadata: {
	                  sdkVersion: version
	                }
	              };
	              options = {
	                method: 'POST',
	                path: path,
	                body: device
	              };
	              _context20.next = 5;
	              return doRequest(options);
	            case 5:
	              response = _context20.sent;
	              return _context20.abrupt("return", response.id);
	            case 7:
	            case "end":
	              return _context20.stop();
	          }
	        }, _callee20, this);
	      }));
	      function _registerDevice(_x7) {
	        return _registerDevice2.apply(this, arguments);
	      }
	      return _registerDevice;
	    }()
	  }, {
	    key: "_deleteDevice",
	    value: function () {
	      var _deleteDevice2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee21() {
	        var path, options;
	        return _regeneratorRuntime$3().wrap(function _callee21$(_context21) {
	          while (1) switch (_context21.prev = _context21.next) {
	            case 0:
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(encodeURIComponent(this._deviceId));
	              options = {
	                method: 'DELETE',
	                path: path
	              };
	              _context21.next = 4;
	              return doRequest(options);
	            case 4:
	            case "end":
	              return _context21.stop();
	          }
	        }, _callee21, this);
	      }));
	      function _deleteDevice() {
	        return _deleteDevice2.apply(this, arguments);
	      }
	      return _deleteDevice;
	    }()
	    /**
	     * Submit SDK version and browser details (via the user agent) to Pusher Beams.
	     */
	  }, {
	    key: "_updateDeviceMetadata",
	    value: function () {
	      var _updateDeviceMetadata2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee22() {
	        var userAgent, storedUserAgent, storedSdkVersion, path, metadata, options;
	        return _regeneratorRuntime$3().wrap(function _callee22$(_context22) {
	          while (1) switch (_context22.prev = _context22.next) {
	            case 0:
	              userAgent = window.navigator.userAgent;
	              _context22.next = 3;
	              return this._deviceStateStore.getLastSeenUserAgent();
	            case 3:
	              storedUserAgent = _context22.sent;
	              _context22.next = 6;
	              return this._deviceStateStore.getLastSeenSdkVersion();
	            case 6:
	              storedSdkVersion = _context22.sent;
	              if (!(userAgent === storedUserAgent && version === storedSdkVersion)) {
	                _context22.next = 9;
	                break;
	              }
	              return _context22.abrupt("return");
	            case 9:
	              path = "".concat(this._baseURL, "/device_api/v1/instances/").concat(encodeURIComponent(this.instanceId), "/devices/web/").concat(this._deviceId, "/metadata");
	              metadata = {
	                sdkVersion: version
	              };
	              options = {
	                method: 'PUT',
	                path: path,
	                body: metadata
	              };
	              _context22.next = 14;
	              return doRequest(options);
	            case 14:
	              _context22.next = 16;
	              return this._deviceStateStore.setLastSeenSdkVersion(version);
	            case 16:
	              _context22.next = 18;
	              return this._deviceStateStore.setLastSeenUserAgent(userAgent);
	            case 18:
	            case "end":
	              return _context22.stop();
	          }
	        }, _callee22, this);
	      }));
	      function _updateDeviceMetadata() {
	        return _updateDeviceMetadata2.apply(this, arguments);
	      }
	      return _updateDeviceMetadata;
	    }()
	  }]);
	  return Client;
	}();
	var validateInterestName = function validateInterestName(interest) {
	  if (interest === undefined || interest === null) {
	    throw new Error('Interest name is required');
	  }
	  if (typeof interest !== 'string') {
	    throw new Error("Interest ".concat(interest, " is not a string"));
	  }
	  if (!INTERESTS_REGEX.test(interest)) {
	    throw new Error("interest \"".concat(interest, "\" contains a forbidden character. ") + 'Allowed characters are: ASCII upper/lower-case letters, ' + 'numbers or one of _-=@,.;');
	  }
	  if (interest.length > MAX_INTEREST_LENGTH) {
	    throw new Error("Interest is longer than the maximum of ".concat(MAX_INTEREST_LENGTH, " chars"));
	  }
	};
	function getServiceWorkerRegistration() {
	  return _getServiceWorkerRegistration.apply(this, arguments);
	}
	function _getServiceWorkerRegistration() {
	  _getServiceWorkerRegistration = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$3().mark(function _callee23() {
	    var _yield$fetch, swStatusCode;
	    return _regeneratorRuntime$3().wrap(function _callee23$(_context23) {
	      while (1) switch (_context23.prev = _context23.next) {
	        case 0:
	          _context23.next = 2;
	          return fetch(SERVICE_WORKER_URL);
	        case 2:
	          _yield$fetch = _context23.sent;
	          swStatusCode = _yield$fetch.status;
	          if (!(swStatusCode !== 200)) {
	            _context23.next = 6;
	            break;
	          }
	          throw new Error('Cannot start SDK, service worker missing: No file found at /service-worker.js');
	        case 6:
	          window.navigator.serviceWorker.register(SERVICE_WORKER_URL, {
	            // explicitly opting out of `importScripts` caching just in case our
	            // customers decides to host and serve the imported scripts and
	            // accidentally set `Cache-Control` to something other than `max-age=0`
	            updateViaCache: 'none'
	          });
	          return _context23.abrupt("return", window.navigator.serviceWorker.ready);
	        case 8:
	        case "end":
	          return _context23.stop();
	      }
	    }, _callee23);
	  }));
	  return _getServiceWorkerRegistration.apply(this, arguments);
	}
	function getWebPushToken(swReg) {
	  return swReg.pushManager.getSubscription().then(function (sub) {
	    return !sub ? null : encodeSubscription(sub);
	  });
	}
	function encodeSubscription(sub) {
	  return btoa(JSON.stringify(sub));
	}
	function urlBase64ToUInt8Array(base64String) {
	  var padding = '='.repeat((4 - base64String.length % 4) % 4);
	  var base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
	  var rawData = window.atob(base64);
	  return Uint8Array.from(_toConsumableArray(rawData).map(function (_char) {
	    return _char.charCodeAt(0);
	  }));
	}

	/**
	 * Modified from https://stackoverflow.com/questions/4565112
	 */
	function isSupportedBrowser() {
	  var winNav = window.navigator;
	  var vendorName = winNav.vendor;
	  var isChromium = window.chrome !== null && typeof window.chrome !== 'undefined';
	  var isOpera = winNav.userAgent.indexOf('OPR') > -1;
	  var isEdge = winNav.userAgent.indexOf('Edg') > -1;
	  var isFirefox = winNav.userAgent.indexOf('Firefox') > -1;
	  var isChrome = isChromium && vendorName === 'Google Inc.' && !isEdge && !isOpera;
	  var isSupported = isChrome || isOpera || isFirefox || isEdge;
	  if (!isSupported) {
	    console.warn('Pusher Web Push Notifications supports Chrome, Firefox, Edge and Opera.');
	  }
	  return isSupported;
	}

	exports.Client = Client;
	exports.RegistrationState = RegistrationState;
	exports.TokenProvider = TokenProvider;

	return exports;

}({}));


// /*!
//  * Pusher JavaScript Library v8.3.0
//  * https://pusher.com/
//  *
//  * Copyright 2020, Pusher
//  * Released under the MIT licence.
//  */

// (function webpackUniversalModuleDefinition(root, factory) {
// 	if(typeof exports === 'object' && typeof module === 'object')
// 		module.exports = factory();
// 	else if(typeof define === 'function' && define.amd)
// 		define([], factory);
// 	else if(typeof exports === 'object')
// 		exports["Pusher"] = factory();
// 	else
// 		root["Pusher"] = factory();
// })(window, function() {
// return /******/ (function(modules) { // webpackBootstrap
// /******/ 	// The module cache
// /******/ 	var installedModules = {};
// /******/
// /******/ 	// The require function
// /******/ 	function __webpack_require__(moduleId) {
// /******/
// /******/ 		// Check if module is in cache
// /******/ 		if(installedModules[moduleId]) {
// /******/ 			return installedModules[moduleId].exports;
// /******/ 		}
// /******/ 		// Create a new module (and put it into the cache)
// /******/ 		var module = installedModules[moduleId] = {
// /******/ 			i: moduleId,
// /******/ 			l: false,
// /******/ 			exports: {}
// /******/ 		};
// /******/
// /******/ 		// Execute the module function
// /******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
// /******/
// /******/ 		// Flag the module as loaded
// /******/ 		module.l = true;
// /******/
// /******/ 		// Return the exports of the module
// /******/ 		return module.exports;
// /******/ 	}
// /******/
// /******/
// /******/ 	// expose the modules object (__webpack_modules__)
// /******/ 	__webpack_require__.m = modules;
// /******/
// /******/ 	// expose the module cache
// /******/ 	__webpack_require__.c = installedModules;
// /******/
// /******/ 	// define getter function for harmony exports
// /******/ 	__webpack_require__.d = function(exports, name, getter) {
// /******/ 		if(!__webpack_require__.o(exports, name)) {
// /******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
// /******/ 		}
// /******/ 	};
// /******/
// /******/ 	// define __esModule on exports
// /******/ 	__webpack_require__.r = function(exports) {
// /******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
// /******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
// /******/ 		}
// /******/ 		Object.defineProperty(exports, '__esModule', { value: true });
// /******/ 	};
// /******/
// /******/ 	// create a fake namespace object
// /******/ 	// mode & 1: value is a module id, require it
// /******/ 	// mode & 2: merge all properties of value into the ns
// /******/ 	// mode & 4: return value when already ns object
// /******/ 	// mode & 8|1: behave like require
// /******/ 	__webpack_require__.t = function(value, mode) {
// /******/ 		if(mode & 1) value = __webpack_require__(value);
// /******/ 		if(mode & 8) return value;
// /******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
// /******/ 		var ns = Object.create(null);
// /******/ 		__webpack_require__.r(ns);
// /******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
// /******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
// /******/ 		return ns;
// /******/ 	};
// /******/
// /******/ 	// getDefaultExport function for compatibility with non-harmony modules
// /******/ 	__webpack_require__.n = function(module) {
// /******/ 		var getter = module && module.__esModule ?
// /******/ 			function getDefault() { return module['default']; } :
// /******/ 			function getModuleExports() { return module; };
// /******/ 		__webpack_require__.d(getter, 'a', getter);
// /******/ 		return getter;
// /******/ 	};
// /******/
// /******/ 	// Object.prototype.hasOwnProperty.call
// /******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
// /******/
// /******/ 	// __webpack_public_path__
// /******/ 	__webpack_require__.p = "";
// /******/
// /******/
// /******/ 	// Load entry module and return exports
// /******/ 	return __webpack_require__(__webpack_require__.s = 2);
// /******/ })
// /************************************************************************/
// /******/ ([
// /* 0 */
// /***/ (function(module, exports, __webpack_require__) {

// "use strict";

// // Copyright (C) 2016 Dmitry Chestnykh
// // MIT License. See LICENSE file for details.
// var __extends = (this && this.__extends) || (function () {
//     var extendStatics = function (d, b) {
//         extendStatics = Object.setPrototypeOf ||
//             ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
//             function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
//         return extendStatics(d, b);
//     };
//     return function (d, b) {
//         extendStatics(d, b);
//         function __() { this.constructor = d; }
//         d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
//     };
// })();
// Object.defineProperty(exports, "__esModule", { value: true });
// /**
//  * Package base64 implements Base64 encoding and decoding.
//  */
// // Invalid character used in decoding to indicate
// // that the character to decode is out of range of
// // alphabet and cannot be decoded.
// var INVALID_BYTE = 256;
// /**
//  * Implements standard Base64 encoding.
//  *
//  * Operates in constant time.
//  */
// var Coder = /** @class */ (function () {
//     // TODO(dchest): methods to encode chunk-by-chunk.
//     function Coder(_paddingCharacter) {
//         if (_paddingCharacter === void 0) { _paddingCharacter = "="; }
//         this._paddingCharacter = _paddingCharacter;
//     }
//     Coder.prototype.encodedLength = function (length) {
//         if (!this._paddingCharacter) {
//             return (length * 8 + 5) / 6 | 0;
//         }
//         return (length + 2) / 3 * 4 | 0;
//     };
//     Coder.prototype.encode = function (data) {
//         var out = "";
//         var i = 0;
//         for (; i < data.length - 2; i += 3) {
//             var c = (data[i] << 16) | (data[i + 1] << 8) | (data[i + 2]);
//             out += this._encodeByte((c >>> 3 * 6) & 63);
//             out += this._encodeByte((c >>> 2 * 6) & 63);
//             out += this._encodeByte((c >>> 1 * 6) & 63);
//             out += this._encodeByte((c >>> 0 * 6) & 63);
//         }
//         var left = data.length - i;
//         if (left > 0) {
//             var c = (data[i] << 16) | (left === 2 ? data[i + 1] << 8 : 0);
//             out += this._encodeByte((c >>> 3 * 6) & 63);
//             out += this._encodeByte((c >>> 2 * 6) & 63);
//             if (left === 2) {
//                 out += this._encodeByte((c >>> 1 * 6) & 63);
//             }
//             else {
//                 out += this._paddingCharacter || "";
//             }
//             out += this._paddingCharacter || "";
//         }
//         return out;
//     };
//     Coder.prototype.maxDecodedLength = function (length) {
//         if (!this._paddingCharacter) {
//             return (length * 6 + 7) / 8 | 0;
//         }
//         return length / 4 * 3 | 0;
//     };
//     Coder.prototype.decodedLength = function (s) {
//         return this.maxDecodedLength(s.length - this._getPaddingLength(s));
//     };
//     Coder.prototype.decode = function (s) {
//         if (s.length === 0) {
//             return new Uint8Array(0);
//         }
//         var paddingLength = this._getPaddingLength(s);
//         var length = s.length - paddingLength;
//         var out = new Uint8Array(this.maxDecodedLength(length));
//         var op = 0;
//         var i = 0;
//         var haveBad = 0;
//         var v0 = 0, v1 = 0, v2 = 0, v3 = 0;
//         for (; i < length - 4; i += 4) {
//             v0 = this._decodeChar(s.charCodeAt(i + 0));
//             v1 = this._decodeChar(s.charCodeAt(i + 1));
//             v2 = this._decodeChar(s.charCodeAt(i + 2));
//             v3 = this._decodeChar(s.charCodeAt(i + 3));
//             out[op++] = (v0 << 2) | (v1 >>> 4);
//             out[op++] = (v1 << 4) | (v2 >>> 2);
//             out[op++] = (v2 << 6) | v3;
//             haveBad |= v0 & INVALID_BYTE;
//             haveBad |= v1 & INVALID_BYTE;
//             haveBad |= v2 & INVALID_BYTE;
//             haveBad |= v3 & INVALID_BYTE;
//         }
//         if (i < length - 1) {
//             v0 = this._decodeChar(s.charCodeAt(i));
//             v1 = this._decodeChar(s.charCodeAt(i + 1));
//             out[op++] = (v0 << 2) | (v1 >>> 4);
//             haveBad |= v0 & INVALID_BYTE;
//             haveBad |= v1 & INVALID_BYTE;
//         }
//         if (i < length - 2) {
//             v2 = this._decodeChar(s.charCodeAt(i + 2));
//             out[op++] = (v1 << 4) | (v2 >>> 2);
//             haveBad |= v2 & INVALID_BYTE;
//         }
//         if (i < length - 3) {
//             v3 = this._decodeChar(s.charCodeAt(i + 3));
//             out[op++] = (v2 << 6) | v3;
//             haveBad |= v3 & INVALID_BYTE;
//         }
//         if (haveBad !== 0) {
//             throw new Error("Base64Coder: incorrect characters for decoding");
//         }
//         return out;
//     };
//     // Standard encoding have the following encoded/decoded ranges,
//     // which we need to convert between.
//     //
//     // ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789  +   /
//     // Index:   0 - 25                    26 - 51              52 - 61   62  63
//     // ASCII:  65 - 90                    97 - 122             48 - 57   43  47
//     //
//     // Encode 6 bits in b into a new character.
//     Coder.prototype._encodeByte = function (b) {
//         // Encoding uses constant time operations as follows:
//         //
//         // 1. Define comparison of A with B using (A - B) >>> 8:
//         //          if A > B, then result is positive integer
//         //          if A <= B, then result is 0
//         //
//         // 2. Define selection of C or 0 using bitwise AND: X & C:
//         //          if X == 0, then result is 0
//         //          if X != 0, then result is C
//         //
//         // 3. Start with the smallest comparison (b >= 0), which is always
//         //    true, so set the result to the starting ASCII value (65).
//         //
//         // 4. Continue comparing b to higher ASCII values, and selecting
//         //    zero if comparison isn't true, otherwise selecting a value
//         //    to add to result, which:
//         //
//         //          a) undoes the previous addition
//         //          b) provides new value to add
//         //
//         var result = b;
//         // b >= 0
//         result += 65;
//         // b > 25
//         result += ((25 - b) >>> 8) & ((0 - 65) - 26 + 97);
//         // b > 51
//         result += ((51 - b) >>> 8) & ((26 - 97) - 52 + 48);
//         // b > 61
//         result += ((61 - b) >>> 8) & ((52 - 48) - 62 + 43);
//         // b > 62
//         result += ((62 - b) >>> 8) & ((62 - 43) - 63 + 47);
//         return String.fromCharCode(result);
//     };
//     // Decode a character code into a byte.
//     // Must return 256 if character is out of alphabet range.
//     Coder.prototype._decodeChar = function (c) {
//         // Decoding works similar to encoding: using the same comparison
//         // function, but now it works on ranges: result is always incremented
//         // by value, but this value becomes zero if the range is not
//         // satisfied.
//         //
//         // Decoding starts with invalid value, 256, which is then
//         // subtracted when the range is satisfied. If none of the ranges
//         // apply, the function returns 256, which is then checked by
//         // the caller to throw error.
//         var result = INVALID_BYTE; // start with invalid character
//         // c == 43 (c > 42 and c < 44)
//         result += (((42 - c) & (c - 44)) >>> 8) & (-INVALID_BYTE + c - 43 + 62);
//         // c == 47 (c > 46 and c < 48)
//         result += (((46 - c) & (c - 48)) >>> 8) & (-INVALID_BYTE + c - 47 + 63);
//         // c > 47 and c < 58
//         result += (((47 - c) & (c - 58)) >>> 8) & (-INVALID_BYTE + c - 48 + 52);
//         // c > 64 and c < 91
//         result += (((64 - c) & (c - 91)) >>> 8) & (-INVALID_BYTE + c - 65 + 0);
//         // c > 96 and c < 123
//         result += (((96 - c) & (c - 123)) >>> 8) & (-INVALID_BYTE + c - 97 + 26);
//         return result;
//     };
//     Coder.prototype._getPaddingLength = function (s) {
//         var paddingLength = 0;
//         if (this._paddingCharacter) {
//             for (var i = s.length - 1; i >= 0; i--) {
//                 if (s[i] !== this._paddingCharacter) {
//                     break;
//                 }
//                 paddingLength++;
//             }
//             if (s.length < 4 || paddingLength > 2) {
//                 throw new Error("Base64Coder: incorrect padding");
//             }
//         }
//         return paddingLength;
//     };
//     return Coder;
// }());
// exports.Coder = Coder;
// var stdCoder = new Coder();
// function encode(data) {
//     return stdCoder.encode(data);
// }
// exports.encode = encode;
// function decode(s) {
//     return stdCoder.decode(s);
// }
// exports.decode = decode;
// /**
//  * Implements URL-safe Base64 encoding.
//  * (Same as Base64, but '+' is replaced with '-', and '/' with '_').
//  *
//  * Operates in constant time.
//  */
// var URLSafeCoder = /** @class */ (function (_super) {
//     __extends(URLSafeCoder, _super);
//     function URLSafeCoder() {
//         return _super !== null && _super.apply(this, arguments) || this;
//     }
//     // URL-safe encoding have the following encoded/decoded ranges:
//     //
//     // ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789  -   _
//     // Index:   0 - 25                    26 - 51              52 - 61   62  63
//     // ASCII:  65 - 90                    97 - 122             48 - 57   45  95
//     //
//     URLSafeCoder.prototype._encodeByte = function (b) {
//         var result = b;
//         // b >= 0
//         result += 65;
//         // b > 25
//         result += ((25 - b) >>> 8) & ((0 - 65) - 26 + 97);
//         // b > 51
//         result += ((51 - b) >>> 8) & ((26 - 97) - 52 + 48);
//         // b > 61
//         result += ((61 - b) >>> 8) & ((52 - 48) - 62 + 45);
//         // b > 62
//         result += ((62 - b) >>> 8) & ((62 - 45) - 63 + 95);
//         return String.fromCharCode(result);
//     };
//     URLSafeCoder.prototype._decodeChar = function (c) {
//         var result = INVALID_BYTE;
//         // c == 45 (c > 44 and c < 46)
//         result += (((44 - c) & (c - 46)) >>> 8) & (-INVALID_BYTE + c - 45 + 62);
//         // c == 95 (c > 94 and c < 96)
//         result += (((94 - c) & (c - 96)) >>> 8) & (-INVALID_BYTE + c - 95 + 63);
//         // c > 47 and c < 58
//         result += (((47 - c) & (c - 58)) >>> 8) & (-INVALID_BYTE + c - 48 + 52);
//         // c > 64 and c < 91
//         result += (((64 - c) & (c - 91)) >>> 8) & (-INVALID_BYTE + c - 65 + 0);
//         // c > 96 and c < 123
//         result += (((96 - c) & (c - 123)) >>> 8) & (-INVALID_BYTE + c - 97 + 26);
//         return result;
//     };
//     return URLSafeCoder;
// }(Coder));
// exports.URLSafeCoder = URLSafeCoder;
// var urlSafeCoder = new URLSafeCoder();
// function encodeURLSafe(data) {
//     return urlSafeCoder.encode(data);
// }
// exports.encodeURLSafe = encodeURLSafe;
// function decodeURLSafe(s) {
//     return urlSafeCoder.decode(s);
// }
// exports.decodeURLSafe = decodeURLSafe;
// exports.encodedLength = function (length) {
//     return stdCoder.encodedLength(length);
// };
// exports.maxDecodedLength = function (length) {
//     return stdCoder.maxDecodedLength(length);
// };
// exports.decodedLength = function (s) {
//     return stdCoder.decodedLength(s);
// };


// /***/ }),
// /* 1 */
// /***/ (function(module, exports, __webpack_require__) {

// "use strict";

// // Copyright (C) 2016 Dmitry Chestnykh
// // MIT License. See LICENSE file for details.
// Object.defineProperty(exports, "__esModule", { value: true });
// /**
//  * Package utf8 implements UTF-8 encoding and decoding.
//  */
// var INVALID_UTF16 = "utf8: invalid string";
// var INVALID_UTF8 = "utf8: invalid source encoding";
// /**
//  * Encodes the given string into UTF-8 byte array.
//  * Throws if the source string has invalid UTF-16 encoding.
//  */
// function encode(s) {
//     // Calculate result length and allocate output array.
//     // encodedLength() also validates string and throws errors,
//     // so we don't need repeat validation here.
//     var arr = new Uint8Array(encodedLength(s));
//     var pos = 0;
//     for (var i = 0; i < s.length; i++) {
//         var c = s.charCodeAt(i);
//         if (c < 0x80) {
//             arr[pos++] = c;
//         }
//         else if (c < 0x800) {
//             arr[pos++] = 0xc0 | c >> 6;
//             arr[pos++] = 0x80 | c & 0x3f;
//         }
//         else if (c < 0xd800) {
//             arr[pos++] = 0xe0 | c >> 12;
//             arr[pos++] = 0x80 | (c >> 6) & 0x3f;
//             arr[pos++] = 0x80 | c & 0x3f;
//         }
//         else {
//             i++; // get one more character
//             c = (c & 0x3ff) << 10;
//             c |= s.charCodeAt(i) & 0x3ff;
//             c += 0x10000;
//             arr[pos++] = 0xf0 | c >> 18;
//             arr[pos++] = 0x80 | (c >> 12) & 0x3f;
//             arr[pos++] = 0x80 | (c >> 6) & 0x3f;
//             arr[pos++] = 0x80 | c & 0x3f;
//         }
//     }
//     return arr;
// }
// exports.encode = encode;
// /**
//  * Returns the number of bytes required to encode the given string into UTF-8.
//  * Throws if the source string has invalid UTF-16 encoding.
//  */
// function encodedLength(s) {
//     var result = 0;
//     for (var i = 0; i < s.length; i++) {
//         var c = s.charCodeAt(i);
//         if (c < 0x80) {
//             result += 1;
//         }
//         else if (c < 0x800) {
//             result += 2;
//         }
//         else if (c < 0xd800) {
//             result += 3;
//         }
//         else if (c <= 0xdfff) {
//             if (i >= s.length - 1) {
//                 throw new Error(INVALID_UTF16);
//             }
//             i++; // "eat" next character
//             result += 4;
//         }
//         else {
//             throw new Error(INVALID_UTF16);
//         }
//     }
//     return result;
// }
// exports.encodedLength = encodedLength;
// /**
//  * Decodes the given byte array from UTF-8 into a string.
//  * Throws if encoding is invalid.
//  */
// function decode(arr) {
//     var chars = [];
//     for (var i = 0; i < arr.length; i++) {
//         var b = arr[i];
//         if (b & 0x80) {
//             var min = void 0;
//             if (b < 0xe0) {
//                 // Need 1 more byte.
//                 if (i >= arr.length) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 var n1 = arr[++i];
//                 if ((n1 & 0xc0) !== 0x80) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 b = (b & 0x1f) << 6 | (n1 & 0x3f);
//                 min = 0x80;
//             }
//             else if (b < 0xf0) {
//                 // Need 2 more bytes.
//                 if (i >= arr.length - 1) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 var n1 = arr[++i];
//                 var n2 = arr[++i];
//                 if ((n1 & 0xc0) !== 0x80 || (n2 & 0xc0) !== 0x80) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 b = (b & 0x0f) << 12 | (n1 & 0x3f) << 6 | (n2 & 0x3f);
//                 min = 0x800;
//             }
//             else if (b < 0xf8) {
//                 // Need 3 more bytes.
//                 if (i >= arr.length - 2) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 var n1 = arr[++i];
//                 var n2 = arr[++i];
//                 var n3 = arr[++i];
//                 if ((n1 & 0xc0) !== 0x80 || (n2 & 0xc0) !== 0x80 || (n3 & 0xc0) !== 0x80) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 b = (b & 0x0f) << 18 | (n1 & 0x3f) << 12 | (n2 & 0x3f) << 6 | (n3 & 0x3f);
//                 min = 0x10000;
//             }
//             else {
//                 throw new Error(INVALID_UTF8);
//             }
//             if (b < min || (b >= 0xd800 && b <= 0xdfff)) {
//                 throw new Error(INVALID_UTF8);
//             }
//             if (b >= 0x10000) {
//                 // Surrogate pair.
//                 if (b > 0x10ffff) {
//                     throw new Error(INVALID_UTF8);
//                 }
//                 b -= 0x10000;
//                 chars.push(String.fromCharCode(0xd800 | (b >> 10)));
//                 b = 0xdc00 | (b & 0x3ff);
//             }
//         }
//         chars.push(String.fromCharCode(b));
//     }
//     return chars.join("");
// }
// exports.decode = decode;


// /***/ }),
// /* 2 */
// /***/ (function(module, exports, __webpack_require__) {

// // required so we don't have to do require('pusher').default etc.
// module.exports = __webpack_require__(3).default;


// /***/ }),
// /* 3 */
// /***/ (function(module, __webpack_exports__, __webpack_require__) {

// "use strict";
// // ESM COMPAT FLAG
// __webpack_require__.r(__webpack_exports__);

// // CONCATENATED MODULE: ./src/runtimes/web/dom/script_receiver_factory.ts
// class ScriptReceiverFactory {
//     constructor(prefix, name) {
//         this.lastId = 0;
//         this.prefix = prefix;
//         this.name = name;
//     }
//     create(callback) {
//         this.lastId++;
//         var number = this.lastId;
//         var id = this.prefix + number;
//         var name = this.name + '[' + number + ']';
//         var called = false;
//         var callbackWrapper = function () {
//             if (!called) {
//                 callback.apply(null, arguments);
//                 called = true;
//             }
//         };
//         this[number] = callbackWrapper;
//         return { number: number, id: id, name: name, callback: callbackWrapper };
//     }
//     remove(receiver) {
//         delete this[receiver.number];
//     }
// }
// var ScriptReceivers = new ScriptReceiverFactory('_pusher_script_', 'Pusher.ScriptReceivers');

// // CONCATENATED MODULE: ./src/core/defaults.ts
// var Defaults = {
//     VERSION: "8.3.0",
//     PROTOCOL: 7,
//     wsPort: 80,
//     wssPort: 443,
//     wsPath: '',
//     httpHost: 'sockjs.pusher.com',
//     httpPort: 80,
//     httpsPort: 443,
//     httpPath: '/pusher',
//     stats_host: 'stats.pusher.com',
//     authEndpoint: '/pusher/auth',
//     authTransport: 'ajax',
//     activityTimeout: 120000,
//     pongTimeout: 30000,
//     unavailableTimeout: 10000,
//     userAuthentication: {
//         endpoint: '/pusher/user-auth',
//         transport: 'ajax'
//     },
//     channelAuthorization: {
//         endpoint: '/pusher/auth',
//         transport: 'ajax'
//     },
//     cdn_http: "http://js.pusher.com",
//     cdn_https: "https://js.pusher.com",
//     dependency_suffix: ""
// };
// /* harmony default export */ var defaults = (Defaults);

// // CONCATENATED MODULE: ./src/runtimes/web/dom/dependency_loader.ts


// class dependency_loader_DependencyLoader {
//     constructor(options) {
//         this.options = options;
//         this.receivers = options.receivers || ScriptReceivers;
//         this.loading = {};
//     }
//     load(name, options, callback) {
//         var self = this;
//         if (self.loading[name] && self.loading[name].length > 0) {
//             self.loading[name].push(callback);
//         }
//         else {
//             self.loading[name] = [callback];
//             var request = runtime.createScriptRequest(self.getPath(name, options));
//             var receiver = self.receivers.create(function (error) {
//                 self.receivers.remove(receiver);
//                 if (self.loading[name]) {
//                     var callbacks = self.loading[name];
//                     delete self.loading[name];
//                     var successCallback = function (wasSuccessful) {
//                         if (!wasSuccessful) {
//                             request.cleanup();
//                         }
//                     };
//                     for (var i = 0; i < callbacks.length; i++) {
//                         callbacks[i](error, successCallback);
//                     }
//                 }
//             });
//             request.send(receiver);
//         }
//     }
//     getRoot(options) {
//         var cdn;
//         var protocol = runtime.getDocument().location.protocol;
//         if ((options && options.useTLS) || protocol === 'https:') {
//             cdn = this.options.cdn_https;
//         }
//         else {
//             cdn = this.options.cdn_http;
//         }
//         return cdn.replace(/\/*$/, '') + '/' + this.options.version;
//     }
//     getPath(name, options) {
//         return this.getRoot(options) + '/' + name + this.options.suffix + '.js';
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/web/dom/dependencies.ts



// var DependenciesReceivers = new ScriptReceiverFactory('_pusher_dependencies', 'Pusher.DependenciesReceivers');
// var Dependencies = new dependency_loader_DependencyLoader({
//     cdn_http: defaults.cdn_http,
//     cdn_https: defaults.cdn_https,
//     version: defaults.VERSION,
//     suffix: defaults.dependency_suffix,
//     receivers: DependenciesReceivers
// });

// // CONCATENATED MODULE: ./src/core/utils/url_store.ts
// const urlStore = {
//     baseUrl: 'https://pusher.com',
//     urls: {
//         authenticationEndpoint: {
//             path: '/docs/channels/server_api/authenticating_users'
//         },
//         authorizationEndpoint: {
//             path: '/docs/channels/server_api/authorizing-users/'
//         },
//         javascriptQuickStart: {
//             path: '/docs/javascript_quick_start'
//         },
//         triggeringClientEvents: {
//             path: '/docs/client_api_guide/client_events#trigger-events'
//         },
//         encryptedChannelSupport: {
//             fullUrl: 'https://github.com/pusher/pusher-js/tree/cc491015371a4bde5743d1c87a0fbac0feb53195#encrypted-channel-support'
//         }
//     }
// };
// const buildLogSuffix = function (key) {
//     const urlPrefix = 'See:';
//     const urlObj = urlStore.urls[key];
//     if (!urlObj)
//         return '';
//     let url;
//     if (urlObj.fullUrl) {
//         url = urlObj.fullUrl;
//     }
//     else if (urlObj.path) {
//         url = urlStore.baseUrl + urlObj.path;
//     }
//     if (!url)
//         return '';
//     return `${urlPrefix} ${url}`;
// };
// /* harmony default export */ var url_store = ({ buildLogSuffix });

// // CONCATENATED MODULE: ./src/core/auth/options.ts
// var AuthRequestType;
// (function (AuthRequestType) {
//     AuthRequestType["UserAuthentication"] = "user-authentication";
//     AuthRequestType["ChannelAuthorization"] = "channel-authorization";
// })(AuthRequestType || (AuthRequestType = {}));

// // CONCATENATED MODULE: ./src/core/errors.ts
// class BadEventName extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class BadChannelName extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class RequestTimedOut extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class TransportPriorityTooLow extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class TransportClosed extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class UnsupportedFeature extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class UnsupportedTransport extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class UnsupportedStrategy extends Error {
//     constructor(msg) {
//         super(msg);
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }
// class HTTPAuthError extends Error {
//     constructor(status, msg) {
//         super(msg);
//         this.status = status;
//         Object.setPrototypeOf(this, new.target.prototype);
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/isomorphic/auth/xhr_auth.ts




// const ajax = function (context, query, authOptions, authRequestType, callback) {
//     const xhr = runtime.createXHR();
//     xhr.open('POST', authOptions.endpoint, true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     for (var headerName in authOptions.headers) {
//         xhr.setRequestHeader(headerName, authOptions.headers[headerName]);
//     }
//     if (authOptions.headersProvider != null) {
//         let dynamicHeaders = authOptions.headersProvider();
//         for (var headerName in dynamicHeaders) {
//             xhr.setRequestHeader(headerName, dynamicHeaders[headerName]);
//         }
//     }
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4) {
//             if (xhr.status === 200) {
//                 let data;
//                 let parsed = false;
//                 try {
//                     data = JSON.parse(xhr.responseText);
//                     parsed = true;
//                 }
//                 catch (e) {
//                     callback(new HTTPAuthError(200, `JSON returned from ${authRequestType.toString()} endpoint was invalid, yet status code was 200. Data was: ${xhr.responseText}`), null);
//                 }
//                 if (parsed) {
//                     callback(null, data);
//                 }
//             }
//             else {
//                 let suffix = '';
//                 switch (authRequestType) {
//                     case AuthRequestType.UserAuthentication:
//                         suffix = url_store.buildLogSuffix('authenticationEndpoint');
//                         break;
//                     case AuthRequestType.ChannelAuthorization:
//                         suffix = `Clients must be authorized to join private or presence channels. ${url_store.buildLogSuffix('authorizationEndpoint')}`;
//                         break;
//                 }
//                 callback(new HTTPAuthError(xhr.status, `Unable to retrieve auth string from ${authRequestType.toString()} endpoint - ` +
//                     `received status: ${xhr.status} from ${authOptions.endpoint}. ${suffix}`), null);
//             }
//         }
//     };
//     xhr.send(query);
//     return xhr;
// };
// /* harmony default export */ var xhr_auth = (ajax);

// // CONCATENATED MODULE: ./src/core/base64.ts
// function encode(s) {
//     return btoa(utob(s));
// }
// var fromCharCode = String.fromCharCode;
// var b64chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
// var b64tab = {};
// for (var base64_i = 0, l = b64chars.length; base64_i < l; base64_i++) {
//     b64tab[b64chars.charAt(base64_i)] = base64_i;
// }
// var cb_utob = function (c) {
//     var cc = c.charCodeAt(0);
//     return cc < 0x80
//         ? c
//         : cc < 0x800
//             ? fromCharCode(0xc0 | (cc >>> 6)) + fromCharCode(0x80 | (cc & 0x3f))
//             : fromCharCode(0xe0 | ((cc >>> 12) & 0x0f)) +
//                 fromCharCode(0x80 | ((cc >>> 6) & 0x3f)) +
//                 fromCharCode(0x80 | (cc & 0x3f));
// };
// var utob = function (u) {
//     return u.replace(/[^\x00-\x7F]/g, cb_utob);
// };
// var cb_encode = function (ccc) {
//     var padlen = [0, 2, 1][ccc.length % 3];
//     var ord = (ccc.charCodeAt(0) << 16) |
//         ((ccc.length > 1 ? ccc.charCodeAt(1) : 0) << 8) |
//         (ccc.length > 2 ? ccc.charCodeAt(2) : 0);
//     var chars = [
//         b64chars.charAt(ord >>> 18),
//         b64chars.charAt((ord >>> 12) & 63),
//         padlen >= 2 ? '=' : b64chars.charAt((ord >>> 6) & 63),
//         padlen >= 1 ? '=' : b64chars.charAt(ord & 63)
//     ];
//     return chars.join('');
// };
// var btoa = window.btoa ||
//     function (b) {
//         return b.replace(/[\s\S]{1,3}/g, cb_encode);
//     };

// // CONCATENATED MODULE: ./src/core/utils/timers/abstract_timer.ts
// class Timer {
//     constructor(set, clear, delay, callback) {
//         this.clear = clear;
//         this.timer = set(() => {
//             if (this.timer) {
//                 this.timer = callback(this.timer);
//             }
//         }, delay);
//     }
//     isRunning() {
//         return this.timer !== null;
//     }
//     ensureAborted() {
//         if (this.timer) {
//             this.clear(this.timer);
//             this.timer = null;
//         }
//     }
// }
// /* harmony default export */ var abstract_timer = (Timer);

// // CONCATENATED MODULE: ./src/core/utils/timers/index.ts

// function timers_clearTimeout(timer) {
//     window.clearTimeout(timer);
// }
// function timers_clearInterval(timer) {
//     window.clearInterval(timer);
// }
// class timers_OneOffTimer extends abstract_timer {
//     constructor(delay, callback) {
//         super(setTimeout, timers_clearTimeout, delay, function (timer) {
//             callback();
//             return null;
//         });
//     }
// }
// class timers_PeriodicTimer extends abstract_timer {
//     constructor(delay, callback) {
//         super(setInterval, timers_clearInterval, delay, function (timer) {
//             callback();
//             return timer;
//         });
//     }
// }

// // CONCATENATED MODULE: ./src/core/util.ts

// var Util = {
//     now() {
//         if (Date.now) {
//             return Date.now();
//         }
//         else {
//             return new Date().valueOf();
//         }
//     },
//     defer(callback) {
//         return new timers_OneOffTimer(0, callback);
//     },
//     method(name, ...args) {
//         var boundArguments = Array.prototype.slice.call(arguments, 1);
//         return function (object) {
//             return object[name].apply(object, boundArguments.concat(arguments));
//         };
//     }
// };
// /* harmony default export */ var util = (Util);

// // CONCATENATED MODULE: ./src/core/utils/collections.ts


// function extend(target, ...sources) {
//     for (var i = 0; i < sources.length; i++) {
//         var extensions = sources[i];
//         for (var property in extensions) {
//             if (extensions[property] &&
//                 extensions[property].constructor &&
//                 extensions[property].constructor === Object) {
//                 target[property] = extend(target[property] || {}, extensions[property]);
//             }
//             else {
//                 target[property] = extensions[property];
//             }
//         }
//     }
//     return target;
// }
// function stringify() {
//     var m = ['Pusher'];
//     for (var i = 0; i < arguments.length; i++) {
//         if (typeof arguments[i] === 'string') {
//             m.push(arguments[i]);
//         }
//         else {
//             m.push(safeJSONStringify(arguments[i]));
//         }
//     }
//     return m.join(' : ');
// }
// function arrayIndexOf(array, item) {
//     var nativeIndexOf = Array.prototype.indexOf;
//     if (array === null) {
//         return -1;
//     }
//     if (nativeIndexOf && array.indexOf === nativeIndexOf) {
//         return array.indexOf(item);
//     }
//     for (var i = 0, l = array.length; i < l; i++) {
//         if (array[i] === item) {
//             return i;
//         }
//     }
//     return -1;
// }
// function objectApply(object, f) {
//     for (var key in object) {
//         if (Object.prototype.hasOwnProperty.call(object, key)) {
//             f(object[key], key, object);
//         }
//     }
// }
// function keys(object) {
//     var keys = [];
//     objectApply(object, function (_, key) {
//         keys.push(key);
//     });
//     return keys;
// }
// function values(object) {
//     var values = [];
//     objectApply(object, function (value) {
//         values.push(value);
//     });
//     return values;
// }
// function apply(array, f, context) {
//     for (var i = 0; i < array.length; i++) {
//         f.call(context || window, array[i], i, array);
//     }
// }
// function map(array, f) {
//     var result = [];
//     for (var i = 0; i < array.length; i++) {
//         result.push(f(array[i], i, array, result));
//     }
//     return result;
// }
// function mapObject(object, f) {
//     var result = {};
//     objectApply(object, function (value, key) {
//         result[key] = f(value);
//     });
//     return result;
// }
// function filter(array, test) {
//     test =
//         test ||
//             function (value) {
//                 return !!value;
//             };
//     var result = [];
//     for (var i = 0; i < array.length; i++) {
//         if (test(array[i], i, array, result)) {
//             result.push(array[i]);
//         }
//     }
//     return result;
// }
// function filterObject(object, test) {
//     var result = {};
//     objectApply(object, function (value, key) {
//         if ((test && test(value, key, object, result)) || Boolean(value)) {
//             result[key] = value;
//         }
//     });
//     return result;
// }
// function flatten(object) {
//     var result = [];
//     objectApply(object, function (value, key) {
//         result.push([key, value]);
//     });
//     return result;
// }
// function any(array, test) {
//     for (var i = 0; i < array.length; i++) {
//         if (test(array[i], i, array)) {
//             return true;
//         }
//     }
//     return false;
// }
// function collections_all(array, test) {
//     for (var i = 0; i < array.length; i++) {
//         if (!test(array[i], i, array)) {
//             return false;
//         }
//     }
//     return true;
// }
// function encodeParamsObject(data) {
//     return mapObject(data, function (value) {
//         if (typeof value === 'object') {
//             value = safeJSONStringify(value);
//         }
//         return encodeURIComponent(encode(value.toString()));
//     });
// }
// function buildQueryString(data) {
//     var params = filterObject(data, function (value) {
//         return value !== undefined;
//     });
//     var query = map(flatten(encodeParamsObject(params)), util.method('join', '=')).join('&');
//     return query;
// }
// function decycleObject(object) {
//     var objects = [], paths = [];
//     return (function derez(value, path) {
//         var i, name, nu;
//         switch (typeof value) {
//             case 'object':
//                 if (!value) {
//                     return null;
//                 }
//                 for (i = 0; i < objects.length; i += 1) {
//                     if (objects[i] === value) {
//                         return { $ref: paths[i] };
//                     }
//                 }
//                 objects.push(value);
//                 paths.push(path);
//                 if (Object.prototype.toString.apply(value) === '[object Array]') {
//                     nu = [];
//                     for (i = 0; i < value.length; i += 1) {
//                         nu[i] = derez(value[i], path + '[' + i + ']');
//                     }
//                 }
//                 else {
//                     nu = {};
//                     for (name in value) {
//                         if (Object.prototype.hasOwnProperty.call(value, name)) {
//                             nu[name] = derez(value[name], path + '[' + JSON.stringify(name) + ']');
//                         }
//                     }
//                 }
//                 return nu;
//             case 'number':
//             case 'string':
//             case 'boolean':
//                 return value;
//         }
//     })(object, '$');
// }
// function safeJSONStringify(source) {
//     try {
//         return JSON.stringify(source);
//     }
//     catch (e) {
//         return JSON.stringify(decycleObject(source));
//     }
// }

// // CONCATENATED MODULE: ./src/core/logger.ts


// class logger_Logger {
//     constructor() {
//         this.globalLog = (message) => {
//             if (window.console && window.console.log) {
//                 window.console.log(message);
//             }
//         };
//     }
//     debug(...args) {
//         this.log(this.globalLog, args);
//     }
//     warn(...args) {
//         this.log(this.globalLogWarn, args);
//     }
//     error(...args) {
//         this.log(this.globalLogError, args);
//     }
//     globalLogWarn(message) {
//         if (window.console && window.console.warn) {
//             window.console.warn(message);
//         }
//         else {
//             this.globalLog(message);
//         }
//     }
//     globalLogError(message) {
//         if (window.console && window.console.error) {
//             window.console.error(message);
//         }
//         else {
//             this.globalLogWarn(message);
//         }
//     }
//     log(defaultLoggingFunction, ...args) {
//         var message = stringify.apply(this, arguments);
//         if (core_pusher.log) {
//             core_pusher.log(message);
//         }
//         else if (core_pusher.logToConsole) {
//             const log = defaultLoggingFunction.bind(this);
//             log(message);
//         }
//     }
// }
// /* harmony default export */ var logger = (new logger_Logger());

// // CONCATENATED MODULE: ./src/runtimes/web/auth/jsonp_auth.ts

// var jsonp = function (context, query, authOptions, authRequestType, callback) {
//     if (authOptions.headers !== undefined ||
//         authOptions.headersProvider != null) {
//         logger.warn(`To send headers with the ${authRequestType.toString()} request, you must use AJAX, rather than JSONP.`);
//     }
//     var callbackName = context.nextAuthCallbackID.toString();
//     context.nextAuthCallbackID++;
//     var document = context.getDocument();
//     var script = document.createElement('script');
//     context.auth_callbacks[callbackName] = function (data) {
//         callback(null, data);
//     };
//     var callback_name = "Pusher.auth_callbacks['" + callbackName + "']";
//     script.src =
//         authOptions.endpoint +
//             '?callback=' +
//             encodeURIComponent(callback_name) +
//             '&' +
//             query;
//     var head = document.getElementsByTagName('head')[0] || document.documentElement;
//     head.insertBefore(script, head.firstChild);
// };
// /* harmony default export */ var jsonp_auth = (jsonp);

// // CONCATENATED MODULE: ./src/runtimes/web/dom/script_request.ts
// class ScriptRequest {
//     constructor(src) {
//         this.src = src;
//     }
//     send(receiver) {
//         var self = this;
//         var errorString = 'Error loading ' + self.src;
//         self.script = document.createElement('script');
//         self.script.id = receiver.id;
//         self.script.src = self.src;
//         self.script.type = 'text/javascript';
//         self.script.charset = 'UTF-8';
//         if (self.script.addEventListener) {
//             self.script.onerror = function () {
//                 receiver.callback(errorString);
//             };
//             self.script.onload = function () {
//                 receiver.callback(null);
//             };
//         }
//         else {
//             self.script.onreadystatechange = function () {
//                 if (self.script.readyState === 'loaded' ||
//                     self.script.readyState === 'complete') {
//                     receiver.callback(null);
//                 }
//             };
//         }
//         if (self.script.async === undefined &&
//             document.attachEvent &&
//             /opera/i.test(navigator.userAgent)) {
//             self.errorScript = document.createElement('script');
//             self.errorScript.id = receiver.id + '_error';
//             self.errorScript.text = receiver.name + "('" + errorString + "');";
//             self.script.async = self.errorScript.async = false;
//         }
//         else {
//             self.script.async = true;
//         }
//         var head = document.getElementsByTagName('head')[0];
//         head.insertBefore(self.script, head.firstChild);
//         if (self.errorScript) {
//             head.insertBefore(self.errorScript, self.script.nextSibling);
//         }
//     }
//     cleanup() {
//         if (this.script) {
//             this.script.onload = this.script.onerror = null;
//             this.script.onreadystatechange = null;
//         }
//         if (this.script && this.script.parentNode) {
//             this.script.parentNode.removeChild(this.script);
//         }
//         if (this.errorScript && this.errorScript.parentNode) {
//             this.errorScript.parentNode.removeChild(this.errorScript);
//         }
//         this.script = null;
//         this.errorScript = null;
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/web/dom/jsonp_request.ts


// class jsonp_request_JSONPRequest {
//     constructor(url, data) {
//         this.url = url;
//         this.data = data;
//     }
//     send(receiver) {
//         if (this.request) {
//             return;
//         }
//         var query = buildQueryString(this.data);
//         var url = this.url + '/' + receiver.number + '?' + query;
//         this.request = runtime.createScriptRequest(url);
//         this.request.send(receiver);
//     }
//     cleanup() {
//         if (this.request) {
//             this.request.cleanup();
//         }
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/web/timeline/jsonp_timeline.ts


// var getAgent = function (sender, useTLS) {
//     return function (data, callback) {
//         var scheme = 'http' + (useTLS ? 's' : '') + '://';
//         var url = scheme + (sender.host || sender.options.host) + sender.options.path;
//         var request = runtime.createJSONPRequest(url, data);
//         var receiver = runtime.ScriptReceivers.create(function (error, result) {
//             ScriptReceivers.remove(receiver);
//             request.cleanup();
//             if (result && result.host) {
//                 sender.host = result.host;
//             }
//             if (callback) {
//                 callback(error, result);
//             }
//         });
//         request.send(receiver);
//     };
// };
// var jsonp_timeline_jsonp = {
//     name: 'jsonp',
//     getAgent
// };
// /* harmony default export */ var jsonp_timeline = (jsonp_timeline_jsonp);

// // CONCATENATED MODULE: ./src/core/transports/url_schemes.ts

// function getGenericURL(baseScheme, params, path) {
//     var scheme = baseScheme + (params.useTLS ? 's' : '');
//     var host = params.useTLS ? params.hostTLS : params.hostNonTLS;
//     return scheme + '://' + host + path;
// }
// function getGenericPath(key, queryString) {
//     var path = '/app/' + key;
//     var query = '?protocol=' +
//         defaults.PROTOCOL +
//         '&client=js' +
//         '&version=' +
//         defaults.VERSION +
//         (queryString ? '&' + queryString : '');
//     return path + query;
// }
// var ws = {
//     getInitial: function (key, params) {
//         var path = (params.httpPath || '') + getGenericPath(key, 'flash=false');
//         return getGenericURL('ws', params, path);
//     }
// };
// var http = {
//     getInitial: function (key, params) {
//         var path = (params.httpPath || '/pusher') + getGenericPath(key);
//         return getGenericURL('http', params, path);
//     }
// };
// var sockjs = {
//     getInitial: function (key, params) {
//         return getGenericURL('http', params, params.httpPath || '/pusher');
//     },
//     getPath: function (key, params) {
//         return getGenericPath(key);
//     }
// };

// // CONCATENATED MODULE: ./src/core/events/callback_registry.ts

// class callback_registry_CallbackRegistry {
//     constructor() {
//         this._callbacks = {};
//     }
//     get(name) {
//         return this._callbacks[prefix(name)];
//     }
//     add(name, callback, context) {
//         var prefixedEventName = prefix(name);
//         this._callbacks[prefixedEventName] =
//             this._callbacks[prefixedEventName] || [];
//         this._callbacks[prefixedEventName].push({
//             fn: callback,
//             context: context
//         });
//     }
//     remove(name, callback, context) {
//         if (!name && !callback && !context) {
//             this._callbacks = {};
//             return;
//         }
//         var names = name ? [prefix(name)] : keys(this._callbacks);
//         if (callback || context) {
//             this.removeCallback(names, callback, context);
//         }
//         else {
//             this.removeAllCallbacks(names);
//         }
//     }
//     removeCallback(names, callback, context) {
//         apply(names, function (name) {
//             this._callbacks[name] = filter(this._callbacks[name] || [], function (binding) {
//                 return ((callback && callback !== binding.fn) ||
//                     (context && context !== binding.context));
//             });
//             if (this._callbacks[name].length === 0) {
//                 delete this._callbacks[name];
//             }
//         }, this);
//     }
//     removeAllCallbacks(names) {
//         apply(names, function (name) {
//             delete this._callbacks[name];
//         }, this);
//     }
// }
// function prefix(name) {
//     return '_' + name;
// }

// // CONCATENATED MODULE: ./src/core/events/dispatcher.ts


// class dispatcher_Dispatcher {
//     constructor(failThrough) {
//         this.callbacks = new callback_registry_CallbackRegistry();
//         this.global_callbacks = [];
//         this.failThrough = failThrough;
//     }
//     bind(eventName, callback, context) {
//         this.callbacks.add(eventName, callback, context);
//         return this;
//     }
//     bind_global(callback) {
//         this.global_callbacks.push(callback);
//         return this;
//     }
//     unbind(eventName, callback, context) {
//         this.callbacks.remove(eventName, callback, context);
//         return this;
//     }
//     unbind_global(callback) {
//         if (!callback) {
//             this.global_callbacks = [];
//             return this;
//         }
//         this.global_callbacks = filter(this.global_callbacks || [], c => c !== callback);
//         return this;
//     }
//     unbind_all() {
//         this.unbind();
//         this.unbind_global();
//         return this;
//     }
//     emit(eventName, data, metadata) {
//         for (var i = 0; i < this.global_callbacks.length; i++) {
//             this.global_callbacks[i](eventName, data);
//         }
//         var callbacks = this.callbacks.get(eventName);
//         var args = [];
//         if (metadata) {
//             args.push(data, metadata);
//         }
//         else if (data) {
//             args.push(data);
//         }
//         if (callbacks && callbacks.length > 0) {
//             for (var i = 0; i < callbacks.length; i++) {
//                 callbacks[i].fn.apply(callbacks[i].context || window, args);
//             }
//         }
//         else if (this.failThrough) {
//             this.failThrough(eventName, data);
//         }
//         return this;
//     }
// }

// // CONCATENATED MODULE: ./src/core/transports/transport_connection.ts





// class transport_connection_TransportConnection extends dispatcher_Dispatcher {
//     constructor(hooks, name, priority, key, options) {
//         super();
//         this.initialize = runtime.transportConnectionInitializer;
//         this.hooks = hooks;
//         this.name = name;
//         this.priority = priority;
//         this.key = key;
//         this.options = options;
//         this.state = 'new';
//         this.timeline = options.timeline;
//         this.activityTimeout = options.activityTimeout;
//         this.id = this.timeline.generateUniqueID();
//     }
//     handlesActivityChecks() {
//         return Boolean(this.hooks.handlesActivityChecks);
//     }
//     supportsPing() {
//         return Boolean(this.hooks.supportsPing);
//     }
//     connect() {
//         if (this.socket || this.state !== 'initialized') {
//             return false;
//         }
//         var url = this.hooks.urls.getInitial(this.key, this.options);
//         try {
//             this.socket = this.hooks.getSocket(url, this.options);
//         }
//         catch (e) {
//             util.defer(() => {
//                 this.onError(e);
//                 this.changeState('closed');
//             });
//             return false;
//         }
//         this.bindListeners();
//         logger.debug('Connecting', { transport: this.name, url });
//         this.changeState('connecting');
//         return true;
//     }
//     close() {
//         if (this.socket) {
//             this.socket.close();
//             return true;
//         }
//         else {
//             return false;
//         }
//     }
//     send(data) {
//         if (this.state === 'open') {
//             util.defer(() => {
//                 if (this.socket) {
//                     this.socket.send(data);
//                 }
//             });
//             return true;
//         }
//         else {
//             return false;
//         }
//     }
//     ping() {
//         if (this.state === 'open' && this.supportsPing()) {
//             this.socket.ping();
//         }
//     }
//     onOpen() {
//         if (this.hooks.beforeOpen) {
//             this.hooks.beforeOpen(this.socket, this.hooks.urls.getPath(this.key, this.options));
//         }
//         this.changeState('open');
//         this.socket.onopen = undefined;
//     }
//     onError(error) {
//         this.emit('error', { type: 'WebSocketError', error: error });
//         this.timeline.error(this.buildTimelineMessage({ error: error.toString() }));
//     }
//     onClose(closeEvent) {
//         if (closeEvent) {
//             this.changeState('closed', {
//                 code: closeEvent.code,
//                 reason: closeEvent.reason,
//                 wasClean: closeEvent.wasClean
//             });
//         }
//         else {
//             this.changeState('closed');
//         }
//         this.unbindListeners();
//         this.socket = undefined;
//     }
//     onMessage(message) {
//         this.emit('message', message);
//     }
//     onActivity() {
//         this.emit('activity');
//     }
//     bindListeners() {
//         this.socket.onopen = () => {
//             this.onOpen();
//         };
//         this.socket.onerror = error => {
//             this.onError(error);
//         };
//         this.socket.onclose = closeEvent => {
//             this.onClose(closeEvent);
//         };
//         this.socket.onmessage = message => {
//             this.onMessage(message);
//         };
//         if (this.supportsPing()) {
//             this.socket.onactivity = () => {
//                 this.onActivity();
//             };
//         }
//     }
//     unbindListeners() {
//         if (this.socket) {
//             this.socket.onopen = undefined;
//             this.socket.onerror = undefined;
//             this.socket.onclose = undefined;
//             this.socket.onmessage = undefined;
//             if (this.supportsPing()) {
//                 this.socket.onactivity = undefined;
//             }
//         }
//     }
//     changeState(state, params) {
//         this.state = state;
//         this.timeline.info(this.buildTimelineMessage({
//             state: state,
//             params: params
//         }));
//         this.emit(state, params);
//     }
//     buildTimelineMessage(message) {
//         return extend({ cid: this.id }, message);
//     }
// }

// // CONCATENATED MODULE: ./src/core/transports/transport.ts

// class transport_Transport {
//     constructor(hooks) {
//         this.hooks = hooks;
//     }
//     isSupported(environment) {
//         return this.hooks.isSupported(environment);
//     }
//     createConnection(name, priority, key, options) {
//         return new transport_connection_TransportConnection(this.hooks, name, priority, key, options);
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/isomorphic/transports/transports.ts




// var WSTransport = new transport_Transport({
//     urls: ws,
//     handlesActivityChecks: false,
//     supportsPing: false,
//     isInitialized: function () {
//         return Boolean(runtime.getWebSocketAPI());
//     },
//     isSupported: function () {
//         return Boolean(runtime.getWebSocketAPI());
//     },
//     getSocket: function (url) {
//         return runtime.createWebSocket(url);
//     }
// });
// var httpConfiguration = {
//     urls: http,
//     handlesActivityChecks: false,
//     supportsPing: true,
//     isInitialized: function () {
//         return true;
//     }
// };
// var streamingConfiguration = extend({
//     getSocket: function (url) {
//         return runtime.HTTPFactory.createStreamingSocket(url);
//     }
// }, httpConfiguration);
// var pollingConfiguration = extend({
//     getSocket: function (url) {
//         return runtime.HTTPFactory.createPollingSocket(url);
//     }
// }, httpConfiguration);
// var xhrConfiguration = {
//     isSupported: function () {
//         return runtime.isXHRSupported();
//     }
// };
// var XHRStreamingTransport = new transport_Transport((extend({}, streamingConfiguration, xhrConfiguration)));
// var XHRPollingTransport = new transport_Transport(extend({}, pollingConfiguration, xhrConfiguration));
// var Transports = {
//     ws: WSTransport,
//     xhr_streaming: XHRStreamingTransport,
//     xhr_polling: XHRPollingTransport
// };
// /* harmony default export */ var transports = (Transports);

// // CONCATENATED MODULE: ./src/runtimes/web/transports/transports.ts






// var SockJSTransport = new transport_Transport({
//     file: 'sockjs',
//     urls: sockjs,
//     handlesActivityChecks: true,
//     supportsPing: false,
//     isSupported: function () {
//         return true;
//     },
//     isInitialized: function () {
//         return window.SockJS !== undefined;
//     },
//     getSocket: function (url, options) {
//         return new window.SockJS(url, null, {
//             js_path: Dependencies.getPath('sockjs', {
//                 useTLS: options.useTLS
//             }),
//             ignore_null_origin: options.ignoreNullOrigin
//         });
//     },
//     beforeOpen: function (socket, path) {
//         socket.send(JSON.stringify({
//             path: path
//         }));
//     }
// });
// var xdrConfiguration = {
//     isSupported: function (environment) {
//         var yes = runtime.isXDRSupported(environment.useTLS);
//         return yes;
//     }
// };
// var XDRStreamingTransport = new transport_Transport((extend({}, streamingConfiguration, xdrConfiguration)));
// var XDRPollingTransport = new transport_Transport(extend({}, pollingConfiguration, xdrConfiguration));
// transports.xdr_streaming = XDRStreamingTransport;
// transports.xdr_polling = XDRPollingTransport;
// transports.sockjs = SockJSTransport;
// /* harmony default export */ var transports_transports = (transports);

// // CONCATENATED MODULE: ./src/runtimes/web/net_info.ts

// class net_info_NetInfo extends dispatcher_Dispatcher {
//     constructor() {
//         super();
//         var self = this;
//         if (window.addEventListener !== undefined) {
//             window.addEventListener('online', function () {
//                 self.emit('online');
//             }, false);
//             window.addEventListener('offline', function () {
//                 self.emit('offline');
//             }, false);
//         }
//     }
//     isOnline() {
//         if (window.navigator.onLine === undefined) {
//             return true;
//         }
//         else {
//             return window.navigator.onLine;
//         }
//     }
// }
// var net_info_Network = new net_info_NetInfo();

// // CONCATENATED MODULE: ./src/core/transports/assistant_to_the_transport_manager.ts


// class assistant_to_the_transport_manager_AssistantToTheTransportManager {
//     constructor(manager, transport, options) {
//         this.manager = manager;
//         this.transport = transport;
//         this.minPingDelay = options.minPingDelay;
//         this.maxPingDelay = options.maxPingDelay;
//         this.pingDelay = undefined;
//     }
//     createConnection(name, priority, key, options) {
//         options = extend({}, options, {
//             activityTimeout: this.pingDelay
//         });
//         var connection = this.transport.createConnection(name, priority, key, options);
//         var openTimestamp = null;
//         var onOpen = function () {
//             connection.unbind('open', onOpen);
//             connection.bind('closed', onClosed);
//             openTimestamp = util.now();
//         };
//         var onClosed = closeEvent => {
//             connection.unbind('closed', onClosed);
//             if (closeEvent.code === 1002 || closeEvent.code === 1003) {
//                 this.manager.reportDeath();
//             }
//             else if (!closeEvent.wasClean && openTimestamp) {
//                 var lifespan = util.now() - openTimestamp;
//                 if (lifespan < 2 * this.maxPingDelay) {
//                     this.manager.reportDeath();
//                     this.pingDelay = Math.max(lifespan / 2, this.minPingDelay);
//                 }
//             }
//         };
//         connection.bind('open', onOpen);
//         return connection;
//     }
//     isSupported(environment) {
//         return this.manager.isAlive() && this.transport.isSupported(environment);
//     }
// }

// // CONCATENATED MODULE: ./src/core/connection/protocol/protocol.ts
// const Protocol = {
//     decodeMessage: function (messageEvent) {
//         try {
//             var messageData = JSON.parse(messageEvent.data);
//             var pusherEventData = messageData.data;
//             if (typeof pusherEventData === 'string') {
//                 try {
//                     pusherEventData = JSON.parse(messageData.data);
//                 }
//                 catch (e) { }
//             }
//             var pusherEvent = {
//                 event: messageData.event,
//                 channel: messageData.channel,
//                 data: pusherEventData
//             };
//             if (messageData.user_id) {
//                 pusherEvent.user_id = messageData.user_id;
//             }
//             return pusherEvent;
//         }
//         catch (e) {
//             throw { type: 'MessageParseError', error: e, data: messageEvent.data };
//         }
//     },
//     encodeMessage: function (event) {
//         return JSON.stringify(event);
//     },
//     processHandshake: function (messageEvent) {
//         var message = Protocol.decodeMessage(messageEvent);
//         if (message.event === 'pusher:connection_established') {
//             if (!message.data.activity_timeout) {
//                 throw 'No activity timeout specified in handshake';
//             }
//             return {
//                 action: 'connected',
//                 id: message.data.socket_id,
//                 activityTimeout: message.data.activity_timeout * 1000
//             };
//         }
//         else if (message.event === 'pusher:error') {
//             return {
//                 action: this.getCloseAction(message.data),
//                 error: this.getCloseError(message.data)
//             };
//         }
//         else {
//             throw 'Invalid handshake';
//         }
//     },
//     getCloseAction: function (closeEvent) {
//         if (closeEvent.code < 4000) {
//             if (closeEvent.code >= 1002 && closeEvent.code <= 1004) {
//                 return 'backoff';
//             }
//             else {
//                 return null;
//             }
//         }
//         else if (closeEvent.code === 4000) {
//             return 'tls_only';
//         }
//         else if (closeEvent.code < 4100) {
//             return 'refused';
//         }
//         else if (closeEvent.code < 4200) {
//             return 'backoff';
//         }
//         else if (closeEvent.code < 4300) {
//             return 'retry';
//         }
//         else {
//             return 'refused';
//         }
//     },
//     getCloseError: function (closeEvent) {
//         if (closeEvent.code !== 1000 && closeEvent.code !== 1001) {
//             return {
//                 type: 'PusherError',
//                 data: {
//                     code: closeEvent.code,
//                     message: closeEvent.reason || closeEvent.message
//                 }
//             };
//         }
//         else {
//             return null;
//         }
//     }
// };
// /* harmony default export */ var protocol_protocol = (Protocol);

// // CONCATENATED MODULE: ./src/core/connection/connection.ts




// class connection_Connection extends dispatcher_Dispatcher {
//     constructor(id, transport) {
//         super();
//         this.id = id;
//         this.transport = transport;
//         this.activityTimeout = transport.activityTimeout;
//         this.bindListeners();
//     }
//     handlesActivityChecks() {
//         return this.transport.handlesActivityChecks();
//     }
//     send(data) {
//         return this.transport.send(data);
//     }
//     send_event(name, data, channel) {
//         var event = { event: name, data: data };
//         if (channel) {
//             event.channel = channel;
//         }
//         logger.debug('Event sent', event);
//         return this.send(protocol_protocol.encodeMessage(event));
//     }
//     ping() {
//         if (this.transport.supportsPing()) {
//             this.transport.ping();
//         }
//         else {
//             this.send_event('pusher:ping', {});
//         }
//     }
//     close() {
//         this.transport.close();
//     }
//     bindListeners() {
//         var listeners = {
//             message: (messageEvent) => {
//                 var pusherEvent;
//                 try {
//                     pusherEvent = protocol_protocol.decodeMessage(messageEvent);
//                 }
//                 catch (e) {
//                     this.emit('error', {
//                         type: 'MessageParseError',
//                         error: e,
//                         data: messageEvent.data
//                     });
//                 }
//                 if (pusherEvent !== undefined) {
//                     logger.debug('Event recd', pusherEvent);
//                     switch (pusherEvent.event) {
//                         case 'pusher:error':
//                             this.emit('error', {
//                                 type: 'PusherError',
//                                 data: pusherEvent.data
//                             });
//                             break;
//                         case 'pusher:ping':
//                             this.emit('ping');
//                             break;
//                         case 'pusher:pong':
//                             this.emit('pong');
//                             break;
//                     }
//                     this.emit('message', pusherEvent);
//                 }
//             },
//             activity: () => {
//                 this.emit('activity');
//             },
//             error: error => {
//                 this.emit('error', error);
//             },
//             closed: closeEvent => {
//                 unbindListeners();
//                 if (closeEvent && closeEvent.code) {
//                     this.handleCloseEvent(closeEvent);
//                 }
//                 this.transport = null;
//                 this.emit('closed');
//             }
//         };
//         var unbindListeners = () => {
//             objectApply(listeners, (listener, event) => {
//                 this.transport.unbind(event, listener);
//             });
//         };
//         objectApply(listeners, (listener, event) => {
//             this.transport.bind(event, listener);
//         });
//     }
//     handleCloseEvent(closeEvent) {
//         var action = protocol_protocol.getCloseAction(closeEvent);
//         var error = protocol_protocol.getCloseError(closeEvent);
//         if (error) {
//             this.emit('error', error);
//         }
//         if (action) {
//             this.emit(action, { action: action, error: error });
//         }
//     }
// }

// // CONCATENATED MODULE: ./src/core/connection/handshake/index.ts



// class handshake_Handshake {
//     constructor(transport, callback) {
//         this.transport = transport;
//         this.callback = callback;
//         this.bindListeners();
//     }
//     close() {
//         this.unbindListeners();
//         this.transport.close();
//     }
//     bindListeners() {
//         this.onMessage = m => {
//             this.unbindListeners();
//             var result;
//             try {
//                 result = protocol_protocol.processHandshake(m);
//             }
//             catch (e) {
//                 this.finish('error', { error: e });
//                 this.transport.close();
//                 return;
//             }
//             if (result.action === 'connected') {
//                 this.finish('connected', {
//                     connection: new connection_Connection(result.id, this.transport),
//                     activityTimeout: result.activityTimeout
//                 });
//             }
//             else {
//                 this.finish(result.action, { error: result.error });
//                 this.transport.close();
//             }
//         };
//         this.onClosed = closeEvent => {
//             this.unbindListeners();
//             var action = protocol_protocol.getCloseAction(closeEvent) || 'backoff';
//             var error = protocol_protocol.getCloseError(closeEvent);
//             this.finish(action, { error: error });
//         };
//         this.transport.bind('message', this.onMessage);
//         this.transport.bind('closed', this.onClosed);
//     }
//     unbindListeners() {
//         this.transport.unbind('message', this.onMessage);
//         this.transport.unbind('closed', this.onClosed);
//     }
//     finish(action, params) {
//         this.callback(extend({ transport: this.transport, action: action }, params));
//     }
// }

// // CONCATENATED MODULE: ./src/core/timeline/timeline_sender.ts

// class timeline_sender_TimelineSender {
//     constructor(timeline, options) {
//         this.timeline = timeline;
//         this.options = options || {};
//     }
//     send(useTLS, callback) {
//         if (this.timeline.isEmpty()) {
//             return;
//         }
//         this.timeline.send(runtime.TimelineTransport.getAgent(this, useTLS), callback);
//     }
// }

// // CONCATENATED MODULE: ./src/core/channels/channel.ts





// class channel_Channel extends dispatcher_Dispatcher {
//     constructor(name, pusher) {
//         super(function (event, data) {
//             logger.debug('No callbacks on ' + name + ' for ' + event);
//         });
//         this.name = name;
//         this.pusher = pusher;
//         this.subscribed = false;
//         this.subscriptionPending = false;
//         this.subscriptionCancelled = false;
//     }
//     authorize(socketId, callback) {
//         return callback(null, { auth: '' });
//     }
//     trigger(event, data) {
//         if (event.indexOf('client-') !== 0) {
//             throw new BadEventName("Event '" + event + "' does not start with 'client-'");
//         }
//         if (!this.subscribed) {
//             var suffix = url_store.buildLogSuffix('triggeringClientEvents');
//             logger.warn(`Client event triggered before channel 'subscription_succeeded' event . ${suffix}`);
//         }
//         return this.pusher.send_event(event, data, this.name);
//     }
//     disconnect() {
//         this.subscribed = false;
//         this.subscriptionPending = false;
//     }
//     handleEvent(event) {
//         var eventName = event.event;
//         var data = event.data;
//         if (eventName === 'pusher_internal:subscription_succeeded') {
//             this.handleSubscriptionSucceededEvent(event);
//         }
//         else if (eventName === 'pusher_internal:subscription_count') {
//             this.handleSubscriptionCountEvent(event);
//         }
//         else if (eventName.indexOf('pusher_internal:') !== 0) {
//             var metadata = {};
//             this.emit(eventName, data, metadata);
//         }
//     }
//     handleSubscriptionSucceededEvent(event) {
//         this.subscriptionPending = false;
//         this.subscribed = true;
//         if (this.subscriptionCancelled) {
//             this.pusher.unsubscribe(this.name);
//         }
//         else {
//             this.emit('pusher:subscription_succeeded', event.data);
//         }
//     }
//     handleSubscriptionCountEvent(event) {
//         if (event.data.subscription_count) {
//             this.subscriptionCount = event.data.subscription_count;
//         }
//         this.emit('pusher:subscription_count', event.data);
//     }
//     subscribe() {
//         if (this.subscribed) {
//             return;
//         }
//         this.subscriptionPending = true;
//         this.subscriptionCancelled = false;
//         this.authorize(this.pusher.connection.socket_id, (error, data) => {
//             if (error) {
//                 this.subscriptionPending = false;
//                 logger.error(error.toString());
//                 this.emit('pusher:subscription_error', Object.assign({}, {
//                     type: 'AuthError',
//                     error: error.message
//                 }, error instanceof HTTPAuthError ? { status: error.status } : {}));
//             }
//             else {
//                 this.pusher.send_event('pusher:subscribe', {
//                     auth: data.auth,
//                     channel_data: data.channel_data,
//                     channel: this.name
//                 });
//             }
//         });
//     }
//     unsubscribe() {
//         this.subscribed = false;
//         this.pusher.send_event('pusher:unsubscribe', {
//             channel: this.name
//         });
//     }
//     cancelSubscription() {
//         this.subscriptionCancelled = true;
//     }
//     reinstateSubscription() {
//         this.subscriptionCancelled = false;
//     }
// }

// // CONCATENATED MODULE: ./src/core/channels/private_channel.ts

// class private_channel_PrivateChannel extends channel_Channel {
//     authorize(socketId, callback) {
//         return this.pusher.config.channelAuthorizer({
//             channelName: this.name,
//             socketId: socketId
//         }, callback);
//     }
// }

// // CONCATENATED MODULE: ./src/core/channels/members.ts

// class members_Members {
//     constructor() {
//         this.reset();
//     }
//     get(id) {
//         if (Object.prototype.hasOwnProperty.call(this.members, id)) {
//             return {
//                 id: id,
//                 info: this.members[id]
//             };
//         }
//         else {
//             return null;
//         }
//     }
//     each(callback) {
//         objectApply(this.members, (member, id) => {
//             callback(this.get(id));
//         });
//     }
//     setMyID(id) {
//         this.myID = id;
//     }
//     onSubscription(subscriptionData) {
//         this.members = subscriptionData.presence.hash;
//         this.count = subscriptionData.presence.count;
//         this.me = this.get(this.myID);
//     }
//     addMember(memberData) {
//         if (this.get(memberData.user_id) === null) {
//             this.count++;
//         }
//         this.members[memberData.user_id] = memberData.user_info;
//         return this.get(memberData.user_id);
//     }
//     removeMember(memberData) {
//         var member = this.get(memberData.user_id);
//         if (member) {
//             delete this.members[memberData.user_id];
//             this.count--;
//         }
//         return member;
//     }
//     reset() {
//         this.members = {};
//         this.count = 0;
//         this.myID = null;
//         this.me = null;
//     }
// }

// // CONCATENATED MODULE: ./src/core/channels/presence_channel.ts
// var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
//     function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
//     return new (P || (P = Promise))(function (resolve, reject) {
//         function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
//         function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
//         function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
//         step((generator = generator.apply(thisArg, _arguments || [])).next());
//     });
// };




// class presence_channel_PresenceChannel extends private_channel_PrivateChannel {
//     constructor(name, pusher) {
//         super(name, pusher);
//         this.members = new members_Members();
//     }
//     authorize(socketId, callback) {
//         super.authorize(socketId, (error, authData) => __awaiter(this, void 0, void 0, function* () {
//             if (!error) {
//                 authData = authData;
//                 if (authData.channel_data != null) {
//                     var channelData = JSON.parse(authData.channel_data);
//                     this.members.setMyID(channelData.user_id);
//                 }
//                 else {
//                     yield this.pusher.user.signinDonePromise;
//                     if (this.pusher.user.user_data != null) {
//                         this.members.setMyID(this.pusher.user.user_data.id);
//                     }
//                     else {
//                         let suffix = url_store.buildLogSuffix('authorizationEndpoint');
//                         logger.error(`Invalid auth response for channel '${this.name}', ` +
//                             `expected 'channel_data' field. ${suffix}, ` +
//                             `or the user should be signed in.`);
//                         callback('Invalid auth response');
//                         return;
//                     }
//                 }
//             }
//             callback(error, authData);
//         }));
//     }
//     handleEvent(event) {
//         var eventName = event.event;
//         if (eventName.indexOf('pusher_internal:') === 0) {
//             this.handleInternalEvent(event);
//         }
//         else {
//             var data = event.data;
//             var metadata = {};
//             if (event.user_id) {
//                 metadata.user_id = event.user_id;
//             }
//             this.emit(eventName, data, metadata);
//         }
//     }
//     handleInternalEvent(event) {
//         var eventName = event.event;
//         var data = event.data;
//         switch (eventName) {
//             case 'pusher_internal:subscription_succeeded':
//                 this.handleSubscriptionSucceededEvent(event);
//                 break;
//             case 'pusher_internal:subscription_count':
//                 this.handleSubscriptionCountEvent(event);
//                 break;
//             case 'pusher_internal:member_added':
//                 var addedMember = this.members.addMember(data);
//                 this.emit('pusher:member_added', addedMember);
//                 break;
//             case 'pusher_internal:member_removed':
//                 var removedMember = this.members.removeMember(data);
//                 if (removedMember) {
//                     this.emit('pusher:member_removed', removedMember);
//                 }
//                 break;
//         }
//     }
//     handleSubscriptionSucceededEvent(event) {
//         this.subscriptionPending = false;
//         this.subscribed = true;
//         if (this.subscriptionCancelled) {
//             this.pusher.unsubscribe(this.name);
//         }
//         else {
//             this.members.onSubscription(event.data);
//             this.emit('pusher:subscription_succeeded', this.members);
//         }
//     }
//     disconnect() {
//         this.members.reset();
//         super.disconnect();
//     }
// }

// // EXTERNAL MODULE: ./node_modules/@stablelib/utf8/lib/utf8.js
// var utf8 = __webpack_require__(1);

// // EXTERNAL MODULE: ./node_modules/@stablelib/base64/lib/base64.js
// var base64 = __webpack_require__(0);

// // CONCATENATED MODULE: ./src/core/channels/encrypted_channel.ts





// class encrypted_channel_EncryptedChannel extends private_channel_PrivateChannel {
//     constructor(name, pusher, nacl) {
//         super(name, pusher);
//         this.key = null;
//         this.nacl = nacl;
//     }
//     authorize(socketId, callback) {
//         super.authorize(socketId, (error, authData) => {
//             if (error) {
//                 callback(error, authData);
//                 return;
//             }
//             let sharedSecret = authData['shared_secret'];
//             if (!sharedSecret) {
//                 callback(new Error(`No shared_secret key in auth payload for encrypted channel: ${this.name}`), null);
//                 return;
//             }
//             this.key = Object(base64["decode"])(sharedSecret);
//             delete authData['shared_secret'];
//             callback(null, authData);
//         });
//     }
//     trigger(event, data) {
//         throw new UnsupportedFeature('Client events are not currently supported for encrypted channels');
//     }
//     handleEvent(event) {
//         var eventName = event.event;
//         var data = event.data;
//         if (eventName.indexOf('pusher_internal:') === 0 ||
//             eventName.indexOf('pusher:') === 0) {
//             super.handleEvent(event);
//             return;
//         }
//         this.handleEncryptedEvent(eventName, data);
//     }
//     handleEncryptedEvent(event, data) {
//         if (!this.key) {
//             logger.debug('Received encrypted event before key has been retrieved from the authEndpoint');
//             return;
//         }
//         if (!data.ciphertext || !data.nonce) {
//             logger.error('Unexpected format for encrypted event, expected object with `ciphertext` and `nonce` fields, got: ' +
//                 data);
//             return;
//         }
//         let cipherText = Object(base64["decode"])(data.ciphertext);
//         if (cipherText.length < this.nacl.secretbox.overheadLength) {
//             logger.error(`Expected encrypted event ciphertext length to be ${this.nacl.secretbox.overheadLength}, got: ${cipherText.length}`);
//             return;
//         }
//         let nonce = Object(base64["decode"])(data.nonce);
//         if (nonce.length < this.nacl.secretbox.nonceLength) {
//             logger.error(`Expected encrypted event nonce length to be ${this.nacl.secretbox.nonceLength}, got: ${nonce.length}`);
//             return;
//         }
//         let bytes = this.nacl.secretbox.open(cipherText, nonce, this.key);
//         if (bytes === null) {
//             logger.debug('Failed to decrypt an event, probably because it was encrypted with a different key. Fetching a new key from the authEndpoint...');
//             this.authorize(this.pusher.connection.socket_id, (error, authData) => {
//                 if (error) {
//                     logger.error(`Failed to make a request to the authEndpoint: ${authData}. Unable to fetch new key, so dropping encrypted event`);
//                     return;
//                 }
//                 bytes = this.nacl.secretbox.open(cipherText, nonce, this.key);
//                 if (bytes === null) {
//                     logger.error(`Failed to decrypt event with new key. Dropping encrypted event`);
//                     return;
//                 }
//                 this.emit(event, this.getDataToEmit(bytes));
//                 return;
//             });
//             return;
//         }
//         this.emit(event, this.getDataToEmit(bytes));
//     }
//     getDataToEmit(bytes) {
//         let raw = Object(utf8["decode"])(bytes);
//         try {
//             return JSON.parse(raw);
//         }
//         catch (_a) {
//             return raw;
//         }
//     }
// }

// // CONCATENATED MODULE: ./src/core/connection/connection_manager.ts





// class connection_manager_ConnectionManager extends dispatcher_Dispatcher {
//     constructor(key, options) {
//         super();
//         this.state = 'initialized';
//         this.connection = null;
//         this.key = key;
//         this.options = options;
//         this.timeline = this.options.timeline;
//         this.usingTLS = this.options.useTLS;
//         this.errorCallbacks = this.buildErrorCallbacks();
//         this.connectionCallbacks = this.buildConnectionCallbacks(this.errorCallbacks);
//         this.handshakeCallbacks = this.buildHandshakeCallbacks(this.errorCallbacks);
//         var Network = runtime.getNetwork();
//         Network.bind('online', () => {
//             this.timeline.info({ netinfo: 'online' });
//             if (this.state === 'connecting' || this.state === 'unavailable') {
//                 this.retryIn(0);
//             }
//         });
//         Network.bind('offline', () => {
//             this.timeline.info({ netinfo: 'offline' });
//             if (this.connection) {
//                 this.sendActivityCheck();
//             }
//         });
//         this.updateStrategy();
//     }
//     connect() {
//         if (this.connection || this.runner) {
//             return;
//         }
//         if (!this.strategy.isSupported()) {
//             this.updateState('failed');
//             return;
//         }
//         this.updateState('connecting');
//         this.startConnecting();
//         this.setUnavailableTimer();
//     }
//     send(data) {
//         if (this.connection) {
//             return this.connection.send(data);
//         }
//         else {
//             return false;
//         }
//     }
//     send_event(name, data, channel) {
//         if (this.connection) {
//             return this.connection.send_event(name, data, channel);
//         }
//         else {
//             return false;
//         }
//     }
//     disconnect() {
//         this.disconnectInternally();
//         this.updateState('disconnected');
//     }
//     isUsingTLS() {
//         return this.usingTLS;
//     }
//     startConnecting() {
//         var callback = (error, handshake) => {
//             if (error) {
//                 this.runner = this.strategy.connect(0, callback);
//             }
//             else {
//                 if (handshake.action === 'error') {
//                     this.emit('error', {
//                         type: 'HandshakeError',
//                         error: handshake.error
//                     });
//                     this.timeline.error({ handshakeError: handshake.error });
//                 }
//                 else {
//                     this.abortConnecting();
//                     this.handshakeCallbacks[handshake.action](handshake);
//                 }
//             }
//         };
//         this.runner = this.strategy.connect(0, callback);
//     }
//     abortConnecting() {
//         if (this.runner) {
//             this.runner.abort();
//             this.runner = null;
//         }
//     }
//     disconnectInternally() {
//         this.abortConnecting();
//         this.clearRetryTimer();
//         this.clearUnavailableTimer();
//         if (this.connection) {
//             var connection = this.abandonConnection();
//             connection.close();
//         }
//     }
//     updateStrategy() {
//         this.strategy = this.options.getStrategy({
//             key: this.key,
//             timeline: this.timeline,
//             useTLS: this.usingTLS
//         });
//     }
//     retryIn(delay) {
//         this.timeline.info({ action: 'retry', delay: delay });
//         if (delay > 0) {
//             this.emit('connecting_in', Math.round(delay / 1000));
//         }
//         this.retryTimer = new timers_OneOffTimer(delay || 0, () => {
//             this.disconnectInternally();
//             this.connect();
//         });
//     }
//     clearRetryTimer() {
//         if (this.retryTimer) {
//             this.retryTimer.ensureAborted();
//             this.retryTimer = null;
//         }
//     }
//     setUnavailableTimer() {
//         this.unavailableTimer = new timers_OneOffTimer(this.options.unavailableTimeout, () => {
//             this.updateState('unavailable');
//         });
//     }
//     clearUnavailableTimer() {
//         if (this.unavailableTimer) {
//             this.unavailableTimer.ensureAborted();
//         }
//     }
//     sendActivityCheck() {
//         this.stopActivityCheck();
//         this.connection.ping();
//         this.activityTimer = new timers_OneOffTimer(this.options.pongTimeout, () => {
//             this.timeline.error({ pong_timed_out: this.options.pongTimeout });
//             this.retryIn(0);
//         });
//     }
//     resetActivityCheck() {
//         this.stopActivityCheck();
//         if (this.connection && !this.connection.handlesActivityChecks()) {
//             this.activityTimer = new timers_OneOffTimer(this.activityTimeout, () => {
//                 this.sendActivityCheck();
//             });
//         }
//     }
//     stopActivityCheck() {
//         if (this.activityTimer) {
//             this.activityTimer.ensureAborted();
//         }
//     }
//     buildConnectionCallbacks(errorCallbacks) {
//         return extend({}, errorCallbacks, {
//             message: message => {
//                 this.resetActivityCheck();
//                 this.emit('message', message);
//             },
//             ping: () => {
//                 this.send_event('pusher:pong', {});
//             },
//             activity: () => {
//                 this.resetActivityCheck();
//             },
//             error: error => {
//                 this.emit('error', error);
//             },
//             closed: () => {
//                 this.abandonConnection();
//                 if (this.shouldRetry()) {
//                     this.retryIn(1000);
//                 }
//             }
//         });
//     }
//     buildHandshakeCallbacks(errorCallbacks) {
//         return extend({}, errorCallbacks, {
//             connected: (handshake) => {
//                 this.activityTimeout = Math.min(this.options.activityTimeout, handshake.activityTimeout, handshake.connection.activityTimeout || Infinity);
//                 this.clearUnavailableTimer();
//                 this.setConnection(handshake.connection);
//                 this.socket_id = this.connection.id;
//                 this.updateState('connected', { socket_id: this.socket_id });
//             }
//         });
//     }
//     buildErrorCallbacks() {
//         let withErrorEmitted = callback => {
//             return (result) => {
//                 if (result.error) {
//                     this.emit('error', { type: 'WebSocketError', error: result.error });
//                 }
//                 callback(result);
//             };
//         };
//         return {
//             tls_only: withErrorEmitted(() => {
//                 this.usingTLS = true;
//                 this.updateStrategy();
//                 this.retryIn(0);
//             }),
//             refused: withErrorEmitted(() => {
//                 this.disconnect();
//             }),
//             backoff: withErrorEmitted(() => {
//                 this.retryIn(1000);
//             }),
//             retry: withErrorEmitted(() => {
//                 this.retryIn(0);
//             })
//         };
//     }
//     setConnection(connection) {
//         this.connection = connection;
//         for (var event in this.connectionCallbacks) {
//             this.connection.bind(event, this.connectionCallbacks[event]);
//         }
//         this.resetActivityCheck();
//     }
//     abandonConnection() {
//         if (!this.connection) {
//             return;
//         }
//         this.stopActivityCheck();
//         for (var event in this.connectionCallbacks) {
//             this.connection.unbind(event, this.connectionCallbacks[event]);
//         }
//         var connection = this.connection;
//         this.connection = null;
//         return connection;
//     }
//     updateState(newState, data) {
//         var previousState = this.state;
//         this.state = newState;
//         if (previousState !== newState) {
//             var newStateDescription = newState;
//             if (newStateDescription === 'connected') {
//                 newStateDescription += ' with new socket ID ' + data.socket_id;
//             }
//             logger.debug('State changed', previousState + ' -> ' + newStateDescription);
//             this.timeline.info({ state: newState, params: data });
//             this.emit('state_change', { previous: previousState, current: newState });
//             this.emit(newState, data);
//         }
//     }
//     shouldRetry() {
//         return this.state === 'connecting' || this.state === 'connected';
//     }
// }

// // CONCATENATED MODULE: ./src/core/channels/channels.ts




// class channels_Channels {
//     constructor() {
//         this.channels = {};
//     }
//     add(name, pusher) {
//         if (!this.channels[name]) {
//             this.channels[name] = createChannel(name, pusher);
//         }
//         return this.channels[name];
//     }
//     all() {
//         return values(this.channels);
//     }
//     find(name) {
//         return this.channels[name];
//     }
//     remove(name) {
//         var channel = this.channels[name];
//         delete this.channels[name];
//         return channel;
//     }
//     disconnect() {
//         objectApply(this.channels, function (channel) {
//             channel.disconnect();
//         });
//     }
// }
// function createChannel(name, pusher) {
//     if (name.indexOf('private-encrypted-') === 0) {
//         if (pusher.config.nacl) {
//             return factory.createEncryptedChannel(name, pusher, pusher.config.nacl);
//         }
//         let errMsg = 'Tried to subscribe to a private-encrypted- channel but no nacl implementation available';
//         let suffix = url_store.buildLogSuffix('encryptedChannelSupport');
//         throw new UnsupportedFeature(`${errMsg}. ${suffix}`);
//     }
//     else if (name.indexOf('private-') === 0) {
//         return factory.createPrivateChannel(name, pusher);
//     }
//     else if (name.indexOf('presence-') === 0) {
//         return factory.createPresenceChannel(name, pusher);
//     }
//     else if (name.indexOf('#') === 0) {
//         throw new BadChannelName('Cannot create a channel with name "' + name + '".');
//     }
//     else {
//         return factory.createChannel(name, pusher);
//     }
// }

// // CONCATENATED MODULE: ./src/core/utils/factory.ts









// var Factory = {
//     createChannels() {
//         return new channels_Channels();
//     },
//     createConnectionManager(key, options) {
//         return new connection_manager_ConnectionManager(key, options);
//     },
//     createChannel(name, pusher) {
//         return new channel_Channel(name, pusher);
//     },
//     createPrivateChannel(name, pusher) {
//         return new private_channel_PrivateChannel(name, pusher);
//     },
//     createPresenceChannel(name, pusher) {
//         return new presence_channel_PresenceChannel(name, pusher);
//     },
//     createEncryptedChannel(name, pusher, nacl) {
//         return new encrypted_channel_EncryptedChannel(name, pusher, nacl);
//     },
//     createTimelineSender(timeline, options) {
//         return new timeline_sender_TimelineSender(timeline, options);
//     },
//     createHandshake(transport, callback) {
//         return new handshake_Handshake(transport, callback);
//     },
//     createAssistantToTheTransportManager(manager, transport, options) {
//         return new assistant_to_the_transport_manager_AssistantToTheTransportManager(manager, transport, options);
//     }
// };
// /* harmony default export */ var factory = (Factory);

// // CONCATENATED MODULE: ./src/core/transports/transport_manager.ts

// class transport_manager_TransportManager {
//     constructor(options) {
//         this.options = options || {};
//         this.livesLeft = this.options.lives || Infinity;
//     }
//     getAssistant(transport) {
//         return factory.createAssistantToTheTransportManager(this, transport, {
//             minPingDelay: this.options.minPingDelay,
//             maxPingDelay: this.options.maxPingDelay
//         });
//     }
//     isAlive() {
//         return this.livesLeft > 0;
//     }
//     reportDeath() {
//         this.livesLeft -= 1;
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/sequential_strategy.ts



// class sequential_strategy_SequentialStrategy {
//     constructor(strategies, options) {
//         this.strategies = strategies;
//         this.loop = Boolean(options.loop);
//         this.failFast = Boolean(options.failFast);
//         this.timeout = options.timeout;
//         this.timeoutLimit = options.timeoutLimit;
//     }
//     isSupported() {
//         return any(this.strategies, util.method('isSupported'));
//     }
//     connect(minPriority, callback) {
//         var strategies = this.strategies;
//         var current = 0;
//         var timeout = this.timeout;
//         var runner = null;
//         var tryNextStrategy = (error, handshake) => {
//             if (handshake) {
//                 callback(null, handshake);
//             }
//             else {
//                 current = current + 1;
//                 if (this.loop) {
//                     current = current % strategies.length;
//                 }
//                 if (current < strategies.length) {
//                     if (timeout) {
//                         timeout = timeout * 2;
//                         if (this.timeoutLimit) {
//                             timeout = Math.min(timeout, this.timeoutLimit);
//                         }
//                     }
//                     runner = this.tryStrategy(strategies[current], minPriority, { timeout, failFast: this.failFast }, tryNextStrategy);
//                 }
//                 else {
//                     callback(true);
//                 }
//             }
//         };
//         runner = this.tryStrategy(strategies[current], minPriority, { timeout: timeout, failFast: this.failFast }, tryNextStrategy);
//         return {
//             abort: function () {
//                 runner.abort();
//             },
//             forceMinPriority: function (p) {
//                 minPriority = p;
//                 if (runner) {
//                     runner.forceMinPriority(p);
//                 }
//             }
//         };
//     }
//     tryStrategy(strategy, minPriority, options, callback) {
//         var timer = null;
//         var runner = null;
//         if (options.timeout > 0) {
//             timer = new timers_OneOffTimer(options.timeout, function () {
//                 runner.abort();
//                 callback(true);
//             });
//         }
//         runner = strategy.connect(minPriority, function (error, handshake) {
//             if (error && timer && timer.isRunning() && !options.failFast) {
//                 return;
//             }
//             if (timer) {
//                 timer.ensureAborted();
//             }
//             callback(error, handshake);
//         });
//         return {
//             abort: function () {
//                 if (timer) {
//                     timer.ensureAborted();
//                 }
//                 runner.abort();
//             },
//             forceMinPriority: function (p) {
//                 runner.forceMinPriority(p);
//             }
//         };
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/best_connected_ever_strategy.ts


// class best_connected_ever_strategy_BestConnectedEverStrategy {
//     constructor(strategies) {
//         this.strategies = strategies;
//     }
//     isSupported() {
//         return any(this.strategies, util.method('isSupported'));
//     }
//     connect(minPriority, callback) {
//         return connect(this.strategies, minPriority, function (i, runners) {
//             return function (error, handshake) {
//                 runners[i].error = error;
//                 if (error) {
//                     if (allRunnersFailed(runners)) {
//                         callback(true);
//                     }
//                     return;
//                 }
//                 apply(runners, function (runner) {
//                     runner.forceMinPriority(handshake.transport.priority);
//                 });
//                 callback(null, handshake);
//             };
//         });
//     }
// }
// function connect(strategies, minPriority, callbackBuilder) {
//     var runners = map(strategies, function (strategy, i, _, rs) {
//         return strategy.connect(minPriority, callbackBuilder(i, rs));
//     });
//     return {
//         abort: function () {
//             apply(runners, abortRunner);
//         },
//         forceMinPriority: function (p) {
//             apply(runners, function (runner) {
//                 runner.forceMinPriority(p);
//             });
//         }
//     };
// }
// function allRunnersFailed(runners) {
//     return collections_all(runners, function (runner) {
//         return Boolean(runner.error);
//     });
// }
// function abortRunner(runner) {
//     if (!runner.error && !runner.aborted) {
//         runner.abort();
//         runner.aborted = true;
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/websocket_prioritized_cached_strategy.ts




// class websocket_prioritized_cached_strategy_WebSocketPrioritizedCachedStrategy {
//     constructor(strategy, transports, options) {
//         this.strategy = strategy;
//         this.transports = transports;
//         this.ttl = options.ttl || 1800 * 1000;
//         this.usingTLS = options.useTLS;
//         this.timeline = options.timeline;
//     }
//     isSupported() {
//         return this.strategy.isSupported();
//     }
//     connect(minPriority, callback) {
//         var usingTLS = this.usingTLS;
//         var info = fetchTransportCache(usingTLS);
//         var cacheSkipCount = info && info.cacheSkipCount ? info.cacheSkipCount : 0;
//         var strategies = [this.strategy];
//         if (info && info.timestamp + this.ttl >= util.now()) {
//             var transport = this.transports[info.transport];
//             if (transport) {
//                 if (['ws', 'wss'].includes(info.transport) || cacheSkipCount > 3) {
//                     this.timeline.info({
//                         cached: true,
//                         transport: info.transport,
//                         latency: info.latency
//                     });
//                     strategies.push(new sequential_strategy_SequentialStrategy([transport], {
//                         timeout: info.latency * 2 + 1000,
//                         failFast: true
//                     }));
//                 }
//                 else {
//                     cacheSkipCount++;
//                 }
//             }
//         }
//         var startTimestamp = util.now();
//         var runner = strategies
//             .pop()
//             .connect(minPriority, function cb(error, handshake) {
//             if (error) {
//                 flushTransportCache(usingTLS);
//                 if (strategies.length > 0) {
//                     startTimestamp = util.now();
//                     runner = strategies.pop().connect(minPriority, cb);
//                 }
//                 else {
//                     callback(error);
//                 }
//             }
//             else {
//                 storeTransportCache(usingTLS, handshake.transport.name, util.now() - startTimestamp, cacheSkipCount);
//                 callback(null, handshake);
//             }
//         });
//         return {
//             abort: function () {
//                 runner.abort();
//             },
//             forceMinPriority: function (p) {
//                 minPriority = p;
//                 if (runner) {
//                     runner.forceMinPriority(p);
//                 }
//             }
//         };
//     }
// }
// function getTransportCacheKey(usingTLS) {
//     return 'pusherTransport' + (usingTLS ? 'TLS' : 'NonTLS');
// }
// function fetchTransportCache(usingTLS) {
//     var storage = runtime.getLocalStorage();
//     if (storage) {
//         try {
//             var serializedCache = storage[getTransportCacheKey(usingTLS)];
//             if (serializedCache) {
//                 return JSON.parse(serializedCache);
//             }
//         }
//         catch (e) {
//             flushTransportCache(usingTLS);
//         }
//     }
//     return null;
// }
// function storeTransportCache(usingTLS, transport, latency, cacheSkipCount) {
//     var storage = runtime.getLocalStorage();
//     if (storage) {
//         try {
//             storage[getTransportCacheKey(usingTLS)] = safeJSONStringify({
//                 timestamp: util.now(),
//                 transport: transport,
//                 latency: latency,
//                 cacheSkipCount: cacheSkipCount
//             });
//         }
//         catch (e) {
//         }
//     }
// }
// function flushTransportCache(usingTLS) {
//     var storage = runtime.getLocalStorage();
//     if (storage) {
//         try {
//             delete storage[getTransportCacheKey(usingTLS)];
//         }
//         catch (e) {
//         }
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/delayed_strategy.ts

// class delayed_strategy_DelayedStrategy {
//     constructor(strategy, { delay: number }) {
//         this.strategy = strategy;
//         this.options = { delay: number };
//     }
//     isSupported() {
//         return this.strategy.isSupported();
//     }
//     connect(minPriority, callback) {
//         var strategy = this.strategy;
//         var runner;
//         var timer = new timers_OneOffTimer(this.options.delay, function () {
//             runner = strategy.connect(minPriority, callback);
//         });
//         return {
//             abort: function () {
//                 timer.ensureAborted();
//                 if (runner) {
//                     runner.abort();
//                 }
//             },
//             forceMinPriority: function (p) {
//                 minPriority = p;
//                 if (runner) {
//                     runner.forceMinPriority(p);
//                 }
//             }
//         };
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/if_strategy.ts
// class IfStrategy {
//     constructor(test, trueBranch, falseBranch) {
//         this.test = test;
//         this.trueBranch = trueBranch;
//         this.falseBranch = falseBranch;
//     }
//     isSupported() {
//         var branch = this.test() ? this.trueBranch : this.falseBranch;
//         return branch.isSupported();
//     }
//     connect(minPriority, callback) {
//         var branch = this.test() ? this.trueBranch : this.falseBranch;
//         return branch.connect(minPriority, callback);
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/first_connected_strategy.ts
// class FirstConnectedStrategy {
//     constructor(strategy) {
//         this.strategy = strategy;
//     }
//     isSupported() {
//         return this.strategy.isSupported();
//     }
//     connect(minPriority, callback) {
//         var runner = this.strategy.connect(minPriority, function (error, handshake) {
//             if (handshake) {
//                 runner.abort();
//             }
//             callback(error, handshake);
//         });
//         return runner;
//     }
// }

// // CONCATENATED MODULE: ./src/runtimes/web/default_strategy.ts







// function testSupportsStrategy(strategy) {
//     return function () {
//         return strategy.isSupported();
//     };
// }
// var getDefaultStrategy = function (config, baseOptions, defineTransport) {
//     var definedTransports = {};
//     function defineTransportStrategy(name, type, priority, options, manager) {
//         var transport = defineTransport(config, name, type, priority, options, manager);
//         definedTransports[name] = transport;
//         return transport;
//     }
//     var ws_options = Object.assign({}, baseOptions, {
//         hostNonTLS: config.wsHost + ':' + config.wsPort,
//         hostTLS: config.wsHost + ':' + config.wssPort,
//         httpPath: config.wsPath
//     });
//     var wss_options = Object.assign({}, ws_options, {
//         useTLS: true
//     });
//     var sockjs_options = Object.assign({}, baseOptions, {
//         hostNonTLS: config.httpHost + ':' + config.httpPort,
//         hostTLS: config.httpHost + ':' + config.httpsPort,
//         httpPath: config.httpPath
//     });
//     var timeouts = {
//         loop: true,
//         timeout: 15000,
//         timeoutLimit: 60000
//     };
//     var ws_manager = new transport_manager_TransportManager({
//         minPingDelay: 10000,
//         maxPingDelay: config.activityTimeout
//     });
//     var streaming_manager = new transport_manager_TransportManager({
//         lives: 2,
//         minPingDelay: 10000,
//         maxPingDelay: config.activityTimeout
//     });
//     var ws_transport = defineTransportStrategy('ws', 'ws', 3, ws_options, ws_manager);
//     var wss_transport = defineTransportStrategy('wss', 'ws', 3, wss_options, ws_manager);
//     var sockjs_transport = defineTransportStrategy('sockjs', 'sockjs', 1, sockjs_options);
//     var xhr_streaming_transport = defineTransportStrategy('xhr_streaming', 'xhr_streaming', 1, sockjs_options, streaming_manager);
//     var xdr_streaming_transport = defineTransportStrategy('xdr_streaming', 'xdr_streaming', 1, sockjs_options, streaming_manager);
//     var xhr_polling_transport = defineTransportStrategy('xhr_polling', 'xhr_polling', 1, sockjs_options);
//     var xdr_polling_transport = defineTransportStrategy('xdr_polling', 'xdr_polling', 1, sockjs_options);
//     var ws_loop = new sequential_strategy_SequentialStrategy([ws_transport], timeouts);
//     var wss_loop = new sequential_strategy_SequentialStrategy([wss_transport], timeouts);
//     var sockjs_loop = new sequential_strategy_SequentialStrategy([sockjs_transport], timeouts);
//     var streaming_loop = new sequential_strategy_SequentialStrategy([
//         new IfStrategy(testSupportsStrategy(xhr_streaming_transport), xhr_streaming_transport, xdr_streaming_transport)
//     ], timeouts);
//     var polling_loop = new sequential_strategy_SequentialStrategy([
//         new IfStrategy(testSupportsStrategy(xhr_polling_transport), xhr_polling_transport, xdr_polling_transport)
//     ], timeouts);
//     var http_loop = new sequential_strategy_SequentialStrategy([
//         new IfStrategy(testSupportsStrategy(streaming_loop), new best_connected_ever_strategy_BestConnectedEverStrategy([
//             streaming_loop,
//             new delayed_strategy_DelayedStrategy(polling_loop, { delay: 4000 })
//         ]), polling_loop)
//     ], timeouts);
//     var http_fallback_loop = new IfStrategy(testSupportsStrategy(http_loop), http_loop, sockjs_loop);
//     var wsStrategy;
//     if (baseOptions.useTLS) {
//         wsStrategy = new best_connected_ever_strategy_BestConnectedEverStrategy([
//             ws_loop,
//             new delayed_strategy_DelayedStrategy(http_fallback_loop, { delay: 2000 })
//         ]);
//     }
//     else {
//         wsStrategy = new best_connected_ever_strategy_BestConnectedEverStrategy([
//             ws_loop,
//             new delayed_strategy_DelayedStrategy(wss_loop, { delay: 2000 }),
//             new delayed_strategy_DelayedStrategy(http_fallback_loop, { delay: 5000 })
//         ]);
//     }
//     return new websocket_prioritized_cached_strategy_WebSocketPrioritizedCachedStrategy(new FirstConnectedStrategy(new IfStrategy(testSupportsStrategy(ws_transport), wsStrategy, http_fallback_loop)), definedTransports, {
//         ttl: 1800000,
//         timeline: baseOptions.timeline,
//         useTLS: baseOptions.useTLS
//     });
// };
// /* harmony default export */ var default_strategy = (getDefaultStrategy);

// // CONCATENATED MODULE: ./src/runtimes/web/transports/transport_connection_initializer.ts

// /* harmony default export */ var transport_connection_initializer = (function () {
//     var self = this;
//     self.timeline.info(self.buildTimelineMessage({
//         transport: self.name + (self.options.useTLS ? 's' : '')
//     }));
//     if (self.hooks.isInitialized()) {
//         self.changeState('initialized');
//     }
//     else if (self.hooks.file) {
//         self.changeState('initializing');
//         Dependencies.load(self.hooks.file, { useTLS: self.options.useTLS }, function (error, callback) {
//             if (self.hooks.isInitialized()) {
//                 self.changeState('initialized');
//                 callback(true);
//             }
//             else {
//                 if (error) {
//                     self.onError(error);
//                 }
//                 self.onClose();
//                 callback(false);
//             }
//         });
//     }
//     else {
//         self.onClose();
//     }
// });

// // CONCATENATED MODULE: ./src/runtimes/web/http/http_xdomain_request.ts

// var http_xdomain_request_hooks = {
//     getRequest: function (socket) {
//         var xdr = new window.XDomainRequest();
//         xdr.ontimeout = function () {
//             socket.emit('error', new RequestTimedOut());
//             socket.close();
//         };
//         xdr.onerror = function (e) {
//             socket.emit('error', e);
//             socket.close();
//         };
//         xdr.onprogress = function () {
//             if (xdr.responseText && xdr.responseText.length > 0) {
//                 socket.onChunk(200, xdr.responseText);
//             }
//         };
//         xdr.onload = function () {
//             if (xdr.responseText && xdr.responseText.length > 0) {
//                 socket.onChunk(200, xdr.responseText);
//             }
//             socket.emit('finished', 200);
//             socket.close();
//         };
//         return xdr;
//     },
//     abortRequest: function (xdr) {
//         xdr.ontimeout = xdr.onerror = xdr.onprogress = xdr.onload = null;
//         xdr.abort();
//     }
// };
// /* harmony default export */ var http_xdomain_request = (http_xdomain_request_hooks);

// // CONCATENATED MODULE: ./src/core/http/http_request.ts


// const MAX_BUFFER_LENGTH = 256 * 1024;
// class http_request_HTTPRequest extends dispatcher_Dispatcher {
//     constructor(hooks, method, url) {
//         super();
//         this.hooks = hooks;
//         this.method = method;
//         this.url = url;
//     }
//     start(payload) {
//         this.position = 0;
//         this.xhr = this.hooks.getRequest(this);
//         this.unloader = () => {
//             this.close();
//         };
//         runtime.addUnloadListener(this.unloader);
//         this.xhr.open(this.method, this.url, true);
//         if (this.xhr.setRequestHeader) {
//             this.xhr.setRequestHeader('Content-Type', 'application/json');
//         }
//         this.xhr.send(payload);
//     }
//     close() {
//         if (this.unloader) {
//             runtime.removeUnloadListener(this.unloader);
//             this.unloader = null;
//         }
//         if (this.xhr) {
//             this.hooks.abortRequest(this.xhr);
//             this.xhr = null;
//         }
//     }
//     onChunk(status, data) {
//         while (true) {
//             var chunk = this.advanceBuffer(data);
//             if (chunk) {
//                 this.emit('chunk', { status: status, data: chunk });
//             }
//             else {
//                 break;
//             }
//         }
//         if (this.isBufferTooLong(data)) {
//             this.emit('buffer_too_long');
//         }
//     }
//     advanceBuffer(buffer) {
//         var unreadData = buffer.slice(this.position);
//         var endOfLinePosition = unreadData.indexOf('\n');
//         if (endOfLinePosition !== -1) {
//             this.position += endOfLinePosition + 1;
//             return unreadData.slice(0, endOfLinePosition);
//         }
//         else {
//             return null;
//         }
//     }
//     isBufferTooLong(buffer) {
//         return this.position === buffer.length && buffer.length > MAX_BUFFER_LENGTH;
//     }
// }

// // CONCATENATED MODULE: ./src/core/http/state.ts
// var State;
// (function (State) {
//     State[State["CONNECTING"] = 0] = "CONNECTING";
//     State[State["OPEN"] = 1] = "OPEN";
//     State[State["CLOSED"] = 3] = "CLOSED";
// })(State || (State = {}));
// /* harmony default export */ var state = (State);

// // CONCATENATED MODULE: ./src/core/http/http_socket.ts



// var autoIncrement = 1;
// class http_socket_HTTPSocket {
//     constructor(hooks, url) {
//         this.hooks = hooks;
//         this.session = randomNumber(1000) + '/' + randomString(8);
//         this.location = getLocation(url);
//         this.readyState = state.CONNECTING;
//         this.openStream();
//     }
//     send(payload) {
//         return this.sendRaw(JSON.stringify([payload]));
//     }
//     ping() {
//         this.hooks.sendHeartbeat(this);
//     }
//     close(code, reason) {
//         this.onClose(code, reason, true);
//     }
//     sendRaw(payload) {
//         if (this.readyState === state.OPEN) {
//             try {
//                 runtime.createSocketRequest('POST', getUniqueURL(getSendURL(this.location, this.session))).start(payload);
//                 return true;
//             }
//             catch (e) {
//                 return false;
//             }
//         }
//         else {
//             return false;
//         }
//     }
//     reconnect() {
//         this.closeStream();
//         this.openStream();
//     }
//     onClose(code, reason, wasClean) {
//         this.closeStream();
//         this.readyState = state.CLOSED;
//         if (this.onclose) {
//             this.onclose({
//                 code: code,
//                 reason: reason,
//                 wasClean: wasClean
//             });
//         }
//     }
//     onChunk(chunk) {
//         if (chunk.status !== 200) {
//             return;
//         }
//         if (this.readyState === state.OPEN) {
//             this.onActivity();
//         }
//         var payload;
//         var type = chunk.data.slice(0, 1);
//         switch (type) {
//             case 'o':
//                 payload = JSON.parse(chunk.data.slice(1) || '{}');
//                 this.onOpen(payload);
//                 break;
//             case 'a':
//                 payload = JSON.parse(chunk.data.slice(1) || '[]');
//                 for (var i = 0; i < payload.length; i++) {
//                     this.onEvent(payload[i]);
//                 }
//                 break;
//             case 'm':
//                 payload = JSON.parse(chunk.data.slice(1) || 'null');
//                 this.onEvent(payload);
//                 break;
//             case 'h':
//                 this.hooks.onHeartbeat(this);
//                 break;
//             case 'c':
//                 payload = JSON.parse(chunk.data.slice(1) || '[]');
//                 this.onClose(payload[0], payload[1], true);
//                 break;
//         }
//     }
//     onOpen(options) {
//         if (this.readyState === state.CONNECTING) {
//             if (options && options.hostname) {
//                 this.location.base = replaceHost(this.location.base, options.hostname);
//             }
//             this.readyState = state.OPEN;
//             if (this.onopen) {
//                 this.onopen();
//             }
//         }
//         else {
//             this.onClose(1006, 'Server lost session', true);
//         }
//     }
//     onEvent(event) {
//         if (this.readyState === state.OPEN && this.onmessage) {
//             this.onmessage({ data: event });
//         }
//     }
//     onActivity() {
//         if (this.onactivity) {
//             this.onactivity();
//         }
//     }
//     onError(error) {
//         if (this.onerror) {
//             this.onerror(error);
//         }
//     }
//     openStream() {
//         this.stream = runtime.createSocketRequest('POST', getUniqueURL(this.hooks.getReceiveURL(this.location, this.session)));
//         this.stream.bind('chunk', chunk => {
//             this.onChunk(chunk);
//         });
//         this.stream.bind('finished', status => {
//             this.hooks.onFinished(this, status);
//         });
//         this.stream.bind('buffer_too_long', () => {
//             this.reconnect();
//         });
//         try {
//             this.stream.start();
//         }
//         catch (error) {
//             util.defer(() => {
//                 this.onError(error);
//                 this.onClose(1006, 'Could not start streaming', false);
//             });
//         }
//     }
//     closeStream() {
//         if (this.stream) {
//             this.stream.unbind_all();
//             this.stream.close();
//             this.stream = null;
//         }
//     }
// }
// function getLocation(url) {
//     var parts = /([^\?]*)\/*(\??.*)/.exec(url);
//     return {
//         base: parts[1],
//         queryString: parts[2]
//     };
// }
// function getSendURL(url, session) {
//     return url.base + '/' + session + '/xhr_send';
// }
// function getUniqueURL(url) {
//     var separator = url.indexOf('?') === -1 ? '?' : '&';
//     return url + separator + 't=' + +new Date() + '&n=' + autoIncrement++;
// }
// function replaceHost(url, hostname) {
//     var urlParts = /(https?:\/\/)([^\/:]+)((\/|:)?.*)/.exec(url);
//     return urlParts[1] + hostname + urlParts[3];
// }
// function randomNumber(max) {
//     return runtime.randomInt(max);
// }
// function randomString(length) {
//     var result = [];
//     for (var i = 0; i < length; i++) {
//         result.push(randomNumber(32).toString(32));
//     }
//     return result.join('');
// }
// /* harmony default export */ var http_socket = (http_socket_HTTPSocket);

// // CONCATENATED MODULE: ./src/core/http/http_streaming_socket.ts
// var http_streaming_socket_hooks = {
//     getReceiveURL: function (url, session) {
//         return url.base + '/' + session + '/xhr_streaming' + url.queryString;
//     },
//     onHeartbeat: function (socket) {
//         socket.sendRaw('[]');
//     },
//     sendHeartbeat: function (socket) {
//         socket.sendRaw('[]');
//     },
//     onFinished: function (socket, status) {
//         socket.onClose(1006, 'Connection interrupted (' + status + ')', false);
//     }
// };
// /* harmony default export */ var http_streaming_socket = (http_streaming_socket_hooks);

// // CONCATENATED MODULE: ./src/core/http/http_polling_socket.ts
// var http_polling_socket_hooks = {
//     getReceiveURL: function (url, session) {
//         return url.base + '/' + session + '/xhr' + url.queryString;
//     },
//     onHeartbeat: function () {
//     },
//     sendHeartbeat: function (socket) {
//         socket.sendRaw('[]');
//     },
//     onFinished: function (socket, status) {
//         if (status === 200) {
//             socket.reconnect();
//         }
//         else {
//             socket.onClose(1006, 'Connection interrupted (' + status + ')', false);
//         }
//     }
// };
// /* harmony default export */ var http_polling_socket = (http_polling_socket_hooks);

// // CONCATENATED MODULE: ./src/runtimes/isomorphic/http/http_xhr_request.ts

// var http_xhr_request_hooks = {
//     getRequest: function (socket) {
//         var Constructor = runtime.getXHRAPI();
//         var xhr = new Constructor();
//         xhr.onreadystatechange = xhr.onprogress = function () {
//             switch (xhr.readyState) {
//                 case 3:
//                     if (xhr.responseText && xhr.responseText.length > 0) {
//                         socket.onChunk(xhr.status, xhr.responseText);
//                     }
//                     break;
//                 case 4:
//                     if (xhr.responseText && xhr.responseText.length > 0) {
//                         socket.onChunk(xhr.status, xhr.responseText);
//                     }
//                     socket.emit('finished', xhr.status);
//                     socket.close();
//                     break;
//             }
//         };
//         return xhr;
//     },
//     abortRequest: function (xhr) {
//         xhr.onreadystatechange = null;
//         xhr.abort();
//     }
// };
// /* harmony default export */ var http_xhr_request = (http_xhr_request_hooks);

// // CONCATENATED MODULE: ./src/runtimes/isomorphic/http/http.ts





// var HTTP = {
//     createStreamingSocket(url) {
//         return this.createSocket(http_streaming_socket, url);
//     },
//     createPollingSocket(url) {
//         return this.createSocket(http_polling_socket, url);
//     },
//     createSocket(hooks, url) {
//         return new http_socket(hooks, url);
//     },
//     createXHR(method, url) {
//         return this.createRequest(http_xhr_request, method, url);
//     },
//     createRequest(hooks, method, url) {
//         return new http_request_HTTPRequest(hooks, method, url);
//     }
// };
// /* harmony default export */ var http_http = (HTTP);

// // CONCATENATED MODULE: ./src/runtimes/web/http/http.ts


// http_http.createXDR = function (method, url) {
//     return this.createRequest(http_xdomain_request, method, url);
// };
// /* harmony default export */ var web_http_http = (http_http);

// // CONCATENATED MODULE: ./src/runtimes/web/runtime.ts












// var Runtime = {
//     nextAuthCallbackID: 1,
//     auth_callbacks: {},
//     ScriptReceivers: ScriptReceivers,
//     DependenciesReceivers: DependenciesReceivers,
//     getDefaultStrategy: default_strategy,
//     Transports: transports_transports,
//     transportConnectionInitializer: transport_connection_initializer,
//     HTTPFactory: web_http_http,
//     TimelineTransport: jsonp_timeline,
//     getXHRAPI() {
//         return window.XMLHttpRequest;
//     },
//     getWebSocketAPI() {
//         return window.WebSocket || window.MozWebSocket;
//     },
//     setup(PusherClass) {
//         window.Pusher = PusherClass;
//         var initializeOnDocumentBody = () => {
//             this.onDocumentBody(PusherClass.ready);
//         };
//         if (!window.JSON) {
//             Dependencies.load('json2', {}, initializeOnDocumentBody);
//         }
//         else {
//             initializeOnDocumentBody();
//         }
//     },
//     getDocument() {
//         return document;
//     },
//     getProtocol() {
//         return this.getDocument().location.protocol;
//     },
//     getAuthorizers() {
//         return { ajax: xhr_auth, jsonp: jsonp_auth };
//     },
//     onDocumentBody(callback) {
//         if (document.body) {
//             callback();
//         }
//         else {
//             setTimeout(() => {
//                 this.onDocumentBody(callback);
//             }, 0);
//         }
//     },
//     createJSONPRequest(url, data) {
//         return new jsonp_request_JSONPRequest(url, data);
//     },
//     createScriptRequest(src) {
//         return new ScriptRequest(src);
//     },
//     getLocalStorage() {
//         try {
//             return window.localStorage;
//         }
//         catch (e) {
//             return undefined;
//         }
//     },
//     createXHR() {
//         if (this.getXHRAPI()) {
//             return this.createXMLHttpRequest();
//         }
//         else {
//             return this.createMicrosoftXHR();
//         }
//     },
//     createXMLHttpRequest() {
//         var Constructor = this.getXHRAPI();
//         return new Constructor();
//     },
//     createMicrosoftXHR() {
//         return new ActiveXObject('Microsoft.XMLHTTP');
//     },
//     getNetwork() {
//         return net_info_Network;
//     },
//     createWebSocket(url) {
//         var Constructor = this.getWebSocketAPI();
//         return new Constructor(url);
//     },
//     createSocketRequest(method, url) {
//         if (this.isXHRSupported()) {
//             return this.HTTPFactory.createXHR(method, url);
//         }
//         else if (this.isXDRSupported(url.indexOf('https:') === 0)) {
//             return this.HTTPFactory.createXDR(method, url);
//         }
//         else {
//             throw 'Cross-origin HTTP requests are not supported';
//         }
//     },
//     isXHRSupported() {
//         var Constructor = this.getXHRAPI();
//         return (Boolean(Constructor) && new Constructor().withCredentials !== undefined);
//     },
//     isXDRSupported(useTLS) {
//         var protocol = useTLS ? 'https:' : 'http:';
//         var documentProtocol = this.getProtocol();
//         return (Boolean(window['XDomainRequest']) && documentProtocol === protocol);
//     },
//     addUnloadListener(listener) {
//         if (window.addEventListener !== undefined) {
//             window.addEventListener('unload', listener, false);
//         }
//         else if (window.attachEvent !== undefined) {
//             window.attachEvent('onunload', listener);
//         }
//     },
//     removeUnloadListener(listener) {
//         if (window.addEventListener !== undefined) {
//             window.removeEventListener('unload', listener, false);
//         }
//         else if (window.detachEvent !== undefined) {
//             window.detachEvent('onunload', listener);
//         }
//     },
//     randomInt(max) {
//         const random = function () {
//             const crypto = window.crypto || window['msCrypto'];
//             const random = crypto.getRandomValues(new Uint32Array(1))[0];
//             return random / Math.pow(2, 32);
//         };
//         return Math.floor(random() * max);
//     }
// };
// /* harmony default export */ var runtime = (Runtime);

// // CONCATENATED MODULE: ./src/core/timeline/level.ts
// var TimelineLevel;
// (function (TimelineLevel) {
//     TimelineLevel[TimelineLevel["ERROR"] = 3] = "ERROR";
//     TimelineLevel[TimelineLevel["INFO"] = 6] = "INFO";
//     TimelineLevel[TimelineLevel["DEBUG"] = 7] = "DEBUG";
// })(TimelineLevel || (TimelineLevel = {}));
// /* harmony default export */ var timeline_level = (TimelineLevel);

// // CONCATENATED MODULE: ./src/core/timeline/timeline.ts



// class timeline_Timeline {
//     constructor(key, session, options) {
//         this.key = key;
//         this.session = session;
//         this.events = [];
//         this.options = options || {};
//         this.sent = 0;
//         this.uniqueID = 0;
//     }
//     log(level, event) {
//         if (level <= this.options.level) {
//             this.events.push(extend({}, event, { timestamp: util.now() }));
//             if (this.options.limit && this.events.length > this.options.limit) {
//                 this.events.shift();
//             }
//         }
//     }
//     error(event) {
//         this.log(timeline_level.ERROR, event);
//     }
//     info(event) {
//         this.log(timeline_level.INFO, event);
//     }
//     debug(event) {
//         this.log(timeline_level.DEBUG, event);
//     }
//     isEmpty() {
//         return this.events.length === 0;
//     }
//     send(sendfn, callback) {
//         var data = extend({
//             session: this.session,
//             bundle: this.sent + 1,
//             key: this.key,
//             lib: 'js',
//             version: this.options.version,
//             cluster: this.options.cluster,
//             features: this.options.features,
//             timeline: this.events
//         }, this.options.params);
//         this.events = [];
//         sendfn(data, (error, result) => {
//             if (!error) {
//                 this.sent++;
//             }
//             if (callback) {
//                 callback(error, result);
//             }
//         });
//         return true;
//     }
//     generateUniqueID() {
//         this.uniqueID++;
//         return this.uniqueID;
//     }
// }

// // CONCATENATED MODULE: ./src/core/strategies/transport_strategy.ts




// class transport_strategy_TransportStrategy {
//     constructor(name, priority, transport, options) {
//         this.name = name;
//         this.priority = priority;
//         this.transport = transport;
//         this.options = options || {};
//     }
//     isSupported() {
//         return this.transport.isSupported({
//             useTLS: this.options.useTLS
//         });
//     }
//     connect(minPriority, callback) {
//         if (!this.isSupported()) {
//             return failAttempt(new UnsupportedStrategy(), callback);
//         }
//         else if (this.priority < minPriority) {
//             return failAttempt(new TransportPriorityTooLow(), callback);
//         }
//         var connected = false;
//         var transport = this.transport.createConnection(this.name, this.priority, this.options.key, this.options);
//         var handshake = null;
//         var onInitialized = function () {
//             transport.unbind('initialized', onInitialized);
//             transport.connect();
//         };
//         var onOpen = function () {
//             handshake = factory.createHandshake(transport, function (result) {
//                 connected = true;
//                 unbindListeners();
//                 callback(null, result);
//             });
//         };
//         var onError = function (error) {
//             unbindListeners();
//             callback(error);
//         };
//         var onClosed = function () {
//             unbindListeners();
//             var serializedTransport;
//             serializedTransport = safeJSONStringify(transport);
//             callback(new TransportClosed(serializedTransport));
//         };
//         var unbindListeners = function () {
//             transport.unbind('initialized', onInitialized);
//             transport.unbind('open', onOpen);
//             transport.unbind('error', onError);
//             transport.unbind('closed', onClosed);
//         };
//         transport.bind('initialized', onInitialized);
//         transport.bind('open', onOpen);
//         transport.bind('error', onError);
//         transport.bind('closed', onClosed);
//         transport.initialize();
//         return {
//             abort: () => {
//                 if (connected) {
//                     return;
//                 }
//                 unbindListeners();
//                 if (handshake) {
//                     handshake.close();
//                 }
//                 else {
//                     transport.close();
//                 }
//             },
//             forceMinPriority: p => {
//                 if (connected) {
//                     return;
//                 }
//                 if (this.priority < p) {
//                     if (handshake) {
//                         handshake.close();
//                     }
//                     else {
//                         transport.close();
//                     }
//                 }
//             }
//         };
//     }
// }
// function failAttempt(error, callback) {
//     util.defer(function () {
//         callback(error);
//     });
//     return {
//         abort: function () { },
//         forceMinPriority: function () { }
//     };
// }

// // CONCATENATED MODULE: ./src/core/strategies/strategy_builder.ts





// const { Transports: strategy_builder_Transports } = runtime;
// var strategy_builder_defineTransport = function (config, name, type, priority, options, manager) {
//     var transportClass = strategy_builder_Transports[type];
//     if (!transportClass) {
//         throw new UnsupportedTransport(type);
//     }
//     var enabled = (!config.enabledTransports ||
//         arrayIndexOf(config.enabledTransports, name) !== -1) &&
//         (!config.disabledTransports ||
//             arrayIndexOf(config.disabledTransports, name) === -1);
//     var transport;
//     if (enabled) {
//         options = Object.assign({ ignoreNullOrigin: config.ignoreNullOrigin }, options);
//         transport = new transport_strategy_TransportStrategy(name, priority, manager ? manager.getAssistant(transportClass) : transportClass, options);
//     }
//     else {
//         transport = strategy_builder_UnsupportedStrategy;
//     }
//     return transport;
// };
// var strategy_builder_UnsupportedStrategy = {
//     isSupported: function () {
//         return false;
//     },
//     connect: function (_, callback) {
//         var deferred = util.defer(function () {
//             callback(new UnsupportedStrategy());
//         });
//         return {
//             abort: function () {
//                 deferred.ensureAborted();
//             },
//             forceMinPriority: function () { }
//         };
//     }
// };

// // CONCATENATED MODULE: ./src/core/options.ts

// function validateOptions(options) {
//     if (options == null) {
//         throw 'You must pass an options object';
//     }
//     if (options.cluster == null) {
//         throw 'Options object must provide a cluster';
//     }
//     if ('disableStats' in options) {
//         logger.warn('The disableStats option is deprecated in favor of enableStats');
//     }
// }

// // CONCATENATED MODULE: ./src/core/auth/user_authenticator.ts


// const composeChannelQuery = (params, authOptions) => {
//     var query = 'socket_id=' + encodeURIComponent(params.socketId);
//     for (var key in authOptions.params) {
//         query +=
//             '&' +
//                 encodeURIComponent(key) +
//                 '=' +
//                 encodeURIComponent(authOptions.params[key]);
//     }
//     if (authOptions.paramsProvider != null) {
//         let dynamicParams = authOptions.paramsProvider();
//         for (var key in dynamicParams) {
//             query +=
//                 '&' +
//                     encodeURIComponent(key) +
//                     '=' +
//                     encodeURIComponent(dynamicParams[key]);
//         }
//     }
//     return query;
// };
// const UserAuthenticator = (authOptions) => {
//     if (typeof runtime.getAuthorizers()[authOptions.transport] === 'undefined') {
//         throw `'${authOptions.transport}' is not a recognized auth transport`;
//     }
//     return (params, callback) => {
//         const query = composeChannelQuery(params, authOptions);
//         runtime.getAuthorizers()[authOptions.transport](runtime, query, authOptions, AuthRequestType.UserAuthentication, callback);
//     };
// };
// /* harmony default export */ var user_authenticator = (UserAuthenticator);

// // CONCATENATED MODULE: ./src/core/auth/channel_authorizer.ts


// const channel_authorizer_composeChannelQuery = (params, authOptions) => {
//     var query = 'socket_id=' + encodeURIComponent(params.socketId);
//     query += '&channel_name=' + encodeURIComponent(params.channelName);
//     for (var key in authOptions.params) {
//         query +=
//             '&' +
//                 encodeURIComponent(key) +
//                 '=' +
//                 encodeURIComponent(authOptions.params[key]);
//     }
//     if (authOptions.paramsProvider != null) {
//         let dynamicParams = authOptions.paramsProvider();
//         for (var key in dynamicParams) {
//             query +=
//                 '&' +
//                     encodeURIComponent(key) +
//                     '=' +
//                     encodeURIComponent(dynamicParams[key]);
//         }
//     }
//     return query;
// };
// const ChannelAuthorizer = (authOptions) => {
//     if (typeof runtime.getAuthorizers()[authOptions.transport] === 'undefined') {
//         throw `'${authOptions.transport}' is not a recognized auth transport`;
//     }
//     return (params, callback) => {
//         const query = channel_authorizer_composeChannelQuery(params, authOptions);
//         runtime.getAuthorizers()[authOptions.transport](runtime, query, authOptions, AuthRequestType.ChannelAuthorization, callback);
//     };
// };
// /* harmony default export */ var channel_authorizer = (ChannelAuthorizer);

// // CONCATENATED MODULE: ./src/core/auth/deprecated_channel_authorizer.ts
// const ChannelAuthorizerProxy = (pusher, authOptions, channelAuthorizerGenerator) => {
//     const deprecatedAuthorizerOptions = {
//         authTransport: authOptions.transport,
//         authEndpoint: authOptions.endpoint,
//         auth: {
//             params: authOptions.params,
//             headers: authOptions.headers
//         }
//     };
//     return (params, callback) => {
//         const channel = pusher.channel(params.channelName);
//         const channelAuthorizer = channelAuthorizerGenerator(channel, deprecatedAuthorizerOptions);
//         channelAuthorizer.authorize(params.socketId, callback);
//     };
// };

// // CONCATENATED MODULE: ./src/core/config.ts





// function getConfig(opts, pusher) {
//     let config = {
//         activityTimeout: opts.activityTimeout || defaults.activityTimeout,
//         cluster: opts.cluster,
//         httpPath: opts.httpPath || defaults.httpPath,
//         httpPort: opts.httpPort || defaults.httpPort,
//         httpsPort: opts.httpsPort || defaults.httpsPort,
//         pongTimeout: opts.pongTimeout || defaults.pongTimeout,
//         statsHost: opts.statsHost || defaults.stats_host,
//         unavailableTimeout: opts.unavailableTimeout || defaults.unavailableTimeout,
//         wsPath: opts.wsPath || defaults.wsPath,
//         wsPort: opts.wsPort || defaults.wsPort,
//         wssPort: opts.wssPort || defaults.wssPort,
//         enableStats: getEnableStatsConfig(opts),
//         httpHost: getHttpHost(opts),
//         useTLS: shouldUseTLS(opts),
//         wsHost: getWebsocketHost(opts),
//         userAuthenticator: buildUserAuthenticator(opts),
//         channelAuthorizer: buildChannelAuthorizer(opts, pusher)
//     };
//     if ('disabledTransports' in opts)
//         config.disabledTransports = opts.disabledTransports;
//     if ('enabledTransports' in opts)
//         config.enabledTransports = opts.enabledTransports;
//     if ('ignoreNullOrigin' in opts)
//         config.ignoreNullOrigin = opts.ignoreNullOrigin;
//     if ('timelineParams' in opts)
//         config.timelineParams = opts.timelineParams;
//     if ('nacl' in opts) {
//         config.nacl = opts.nacl;
//     }
//     return config;
// }
// function getHttpHost(opts) {
//     if (opts.httpHost) {
//         return opts.httpHost;
//     }
//     if (opts.cluster) {
//         return `sockjs-${opts.cluster}.pusher.com`;
//     }
//     return defaults.httpHost;
// }
// function getWebsocketHost(opts) {
//     if (opts.wsHost) {
//         return opts.wsHost;
//     }
//     return getWebsocketHostFromCluster(opts.cluster);
// }
// function getWebsocketHostFromCluster(cluster) {
//     return `ws-${cluster}.pusher.com`;
// }
// function shouldUseTLS(opts) {
//     if (runtime.getProtocol() === 'https:') {
//         return true;
//     }
//     else if (opts.forceTLS === false) {
//         return false;
//     }
//     return true;
// }
// function getEnableStatsConfig(opts) {
//     if ('enableStats' in opts) {
//         return opts.enableStats;
//     }
//     if ('disableStats' in opts) {
//         return !opts.disableStats;
//     }
//     return false;
// }
// function buildUserAuthenticator(opts) {
//     const userAuthentication = Object.assign(Object.assign({}, defaults.userAuthentication), opts.userAuthentication);
//     if ('customHandler' in userAuthentication &&
//         userAuthentication['customHandler'] != null) {
//         return userAuthentication['customHandler'];
//     }
//     return user_authenticator(userAuthentication);
// }
// function buildChannelAuth(opts, pusher) {
//     let channelAuthorization;
//     if ('channelAuthorization' in opts) {
//         channelAuthorization = Object.assign(Object.assign({}, defaults.channelAuthorization), opts.channelAuthorization);
//     }
//     else {
//         channelAuthorization = {
//             transport: opts.authTransport || defaults.authTransport,
//             endpoint: opts.authEndpoint || defaults.authEndpoint
//         };
//         if ('auth' in opts) {
//             if ('params' in opts.auth)
//                 channelAuthorization.params = opts.auth.params;
//             if ('headers' in opts.auth)
//                 channelAuthorization.headers = opts.auth.headers;
//         }
//         if ('authorizer' in opts)
//             channelAuthorization.customHandler = ChannelAuthorizerProxy(pusher, channelAuthorization, opts.authorizer);
//     }
//     return channelAuthorization;
// }
// function buildChannelAuthorizer(opts, pusher) {
//     const channelAuthorization = buildChannelAuth(opts, pusher);
//     if ('customHandler' in channelAuthorization &&
//         channelAuthorization['customHandler'] != null) {
//         return channelAuthorization['customHandler'];
//     }
//     return channel_authorizer(channelAuthorization);
// }

// // CONCATENATED MODULE: ./src/core/watchlist.ts


// class watchlist_WatchlistFacade extends dispatcher_Dispatcher {
//     constructor(pusher) {
//         super(function (eventName, data) {
//             logger.debug(`No callbacks on watchlist events for ${eventName}`);
//         });
//         this.pusher = pusher;
//         this.bindWatchlistInternalEvent();
//     }
//     handleEvent(pusherEvent) {
//         pusherEvent.data.events.forEach(watchlistEvent => {
//             this.emit(watchlistEvent.name, watchlistEvent);
//         });
//     }
//     bindWatchlistInternalEvent() {
//         this.pusher.connection.bind('message', pusherEvent => {
//             var eventName = pusherEvent.event;
//             if (eventName === 'pusher_internal:watchlist_events') {
//                 this.handleEvent(pusherEvent);
//             }
//         });
//     }
// }

// // CONCATENATED MODULE: ./src/core/utils/flat_promise.ts
// function flatPromise() {
//     let resolve, reject;
//     const promise = new Promise((res, rej) => {
//         resolve = res;
//         reject = rej;
//     });
//     return { promise, resolve, reject };
// }
// /* harmony default export */ var flat_promise = (flatPromise);

// // CONCATENATED MODULE: ./src/core/user.ts





// class user_UserFacade extends dispatcher_Dispatcher {
//     constructor(pusher) {
//         super(function (eventName, data) {
//             logger.debug('No callbacks on user for ' + eventName);
//         });
//         this.signin_requested = false;
//         this.user_data = null;
//         this.serverToUserChannel = null;
//         this.signinDonePromise = null;
//         this._signinDoneResolve = null;
//         this._onAuthorize = (err, authData) => {
//             if (err) {
//                 logger.warn(`Error during signin: ${err}`);
//                 this._cleanup();
//                 return;
//             }
//             this.pusher.send_event('pusher:signin', {
//                 auth: authData.auth,
//                 user_data: authData.user_data
//             });
//         };
//         this.pusher = pusher;
//         this.pusher.connection.bind('state_change', ({ previous, current }) => {
//             if (previous !== 'connected' && current === 'connected') {
//                 this._signin();
//             }
//             if (previous === 'connected' && current !== 'connected') {
//                 this._cleanup();
//                 this._newSigninPromiseIfNeeded();
//             }
//         });
//         this.watchlist = new watchlist_WatchlistFacade(pusher);
//         this.pusher.connection.bind('message', event => {
//             var eventName = event.event;
//             if (eventName === 'pusher:signin_success') {
//                 this._onSigninSuccess(event.data);
//             }
//             if (this.serverToUserChannel &&
//                 this.serverToUserChannel.name === event.channel) {
//                 this.serverToUserChannel.handleEvent(event);
//             }
//         });
//     }
//     signin() {
//         if (this.signin_requested) {
//             return;
//         }
//         this.signin_requested = true;
//         this._signin();
//     }
//     _signin() {
//         if (!this.signin_requested) {
//             return;
//         }
//         this._newSigninPromiseIfNeeded();
//         if (this.pusher.connection.state !== 'connected') {
//             return;
//         }
//         this.pusher.config.userAuthenticator({
//             socketId: this.pusher.connection.socket_id
//         }, this._onAuthorize);
//     }
//     _onSigninSuccess(data) {
//         try {
//             this.user_data = JSON.parse(data.user_data);
//         }
//         catch (e) {
//             logger.error(`Failed parsing user data after signin: ${data.user_data}`);
//             this._cleanup();
//             return;
//         }
//         if (typeof this.user_data.id !== 'string' || this.user_data.id === '') {
//             logger.error(`user_data doesn't contain an id. user_data: ${this.user_data}`);
//             this._cleanup();
//             return;
//         }
//         this._signinDoneResolve();
//         this._subscribeChannels();
//     }
//     _subscribeChannels() {
//         const ensure_subscribed = channel => {
//             if (channel.subscriptionPending && channel.subscriptionCancelled) {
//                 channel.reinstateSubscription();
//             }
//             else if (!channel.subscriptionPending &&
//                 this.pusher.connection.state === 'connected') {
//                 channel.subscribe();
//             }
//         };
//         this.serverToUserChannel = new channel_Channel(`#server-to-user-${this.user_data.id}`, this.pusher);
//         this.serverToUserChannel.bind_global((eventName, data) => {
//             if (eventName.indexOf('pusher_internal:') === 0 ||
//                 eventName.indexOf('pusher:') === 0) {
//                 return;
//             }
//             this.emit(eventName, data);
//         });
//         ensure_subscribed(this.serverToUserChannel);
//     }
//     _cleanup() {
//         this.user_data = null;
//         if (this.serverToUserChannel) {
//             this.serverToUserChannel.unbind_all();
//             this.serverToUserChannel.disconnect();
//             this.serverToUserChannel = null;
//         }
//         if (this.signin_requested) {
//             this._signinDoneResolve();
//         }
//     }
//     _newSigninPromiseIfNeeded() {
//         if (!this.signin_requested) {
//             return;
//         }
//         if (this.signinDonePromise && !this.signinDonePromise.done) {
//             return;
//         }
//         const { promise, resolve, reject: _ } = flat_promise();
//         promise.done = false;
//         const setDone = () => {
//             promise.done = true;
//         };
//         promise.then(setDone).catch(setDone);
//         this.signinDonePromise = promise;
//         this._signinDoneResolve = resolve;
//     }
// }

// // CONCATENATED MODULE: ./src/core/pusher.ts













// class pusher_Pusher {
//     static ready() {
//         pusher_Pusher.isReady = true;
//         for (var i = 0, l = pusher_Pusher.instances.length; i < l; i++) {
//             pusher_Pusher.instances[i].connect();
//         }
//     }
//     static getClientFeatures() {
//         return keys(filterObject({ ws: runtime.Transports.ws }, function (t) {
//             return t.isSupported({});
//         }));
//     }
//     constructor(app_key, options) {
//         checkAppKey(app_key);
//         validateOptions(options);
//         this.key = app_key;
//         this.config = getConfig(options, this);
//         this.channels = factory.createChannels();
//         this.global_emitter = new dispatcher_Dispatcher();
//         this.sessionID = runtime.randomInt(1000000000);
//         this.timeline = new timeline_Timeline(this.key, this.sessionID, {
//             cluster: this.config.cluster,
//             features: pusher_Pusher.getClientFeatures(),
//             params: this.config.timelineParams || {},
//             limit: 50,
//             level: timeline_level.INFO,
//             version: defaults.VERSION
//         });
//         if (this.config.enableStats) {
//             this.timelineSender = factory.createTimelineSender(this.timeline, {
//                 host: this.config.statsHost,
//                 path: '/timeline/v2/' + runtime.TimelineTransport.name
//             });
//         }
//         var getStrategy = (options) => {
//             return runtime.getDefaultStrategy(this.config, options, strategy_builder_defineTransport);
//         };
//         this.connection = factory.createConnectionManager(this.key, {
//             getStrategy: getStrategy,
//             timeline: this.timeline,
//             activityTimeout: this.config.activityTimeout,
//             pongTimeout: this.config.pongTimeout,
//             unavailableTimeout: this.config.unavailableTimeout,
//             useTLS: Boolean(this.config.useTLS)
//         });
//         this.connection.bind('connected', () => {
//             this.subscribeAll();
//             if (this.timelineSender) {
//                 this.timelineSender.send(this.connection.isUsingTLS());
//             }
//         });
//         this.connection.bind('message', event => {
//             var eventName = event.event;
//             var internal = eventName.indexOf('pusher_internal:') === 0;
//             if (event.channel) {
//                 var channel = this.channel(event.channel);
//                 if (channel) {
//                     channel.handleEvent(event);
//                 }
//             }
//             if (!internal) {
//                 this.global_emitter.emit(event.event, event.data);
//             }
//         });
//         this.connection.bind('connecting', () => {
//             this.channels.disconnect();
//         });
//         this.connection.bind('disconnected', () => {
//             this.channels.disconnect();
//         });
//         this.connection.bind('error', err => {
//             logger.warn(err);
//         });
//         pusher_Pusher.instances.push(this);
//         this.timeline.info({ instances: pusher_Pusher.instances.length });
//         this.user = new user_UserFacade(this);
//         if (pusher_Pusher.isReady) {
//             this.connect();
//         }
//     }
//     channel(name) {
//         return this.channels.find(name);
//     }
//     allChannels() {
//         return this.channels.all();
//     }
//     connect() {
//         this.connection.connect();
//         if (this.timelineSender) {
//             if (!this.timelineSenderTimer) {
//                 var usingTLS = this.connection.isUsingTLS();
//                 var timelineSender = this.timelineSender;
//                 this.timelineSenderTimer = new timers_PeriodicTimer(60000, function () {
//                     timelineSender.send(usingTLS);
//                 });
//             }
//         }
//     }
//     disconnect() {
//         this.connection.disconnect();
//         if (this.timelineSenderTimer) {
//             this.timelineSenderTimer.ensureAborted();
//             this.timelineSenderTimer = null;
//         }
//     }
//     bind(event_name, callback, context) {
//         this.global_emitter.bind(event_name, callback, context);
//         return this;
//     }
//     unbind(event_name, callback, context) {
//         this.global_emitter.unbind(event_name, callback, context);
//         return this;
//     }
//     bind_global(callback) {
//         this.global_emitter.bind_global(callback);
//         return this;
//     }
//     unbind_global(callback) {
//         this.global_emitter.unbind_global(callback);
//         return this;
//     }
//     unbind_all(callback) {
//         this.global_emitter.unbind_all();
//         return this;
//     }
//     subscribeAll() {
//         var channelName;
//         for (channelName in this.channels.channels) {
//             if (this.channels.channels.hasOwnProperty(channelName)) {
//                 this.subscribe(channelName);
//             }
//         }
//     }
//     subscribe(channel_name) {
//         var channel = this.channels.add(channel_name, this);
//         if (channel.subscriptionPending && channel.subscriptionCancelled) {
//             channel.reinstateSubscription();
//         }
//         else if (!channel.subscriptionPending &&
//             this.connection.state === 'connected') {
//             channel.subscribe();
//         }
//         return channel;
//     }
//     unsubscribe(channel_name) {
//         var channel = this.channels.find(channel_name);
//         if (channel && channel.subscriptionPending) {
//             channel.cancelSubscription();
//         }
//         else {
//             channel = this.channels.remove(channel_name);
//             if (channel && channel.subscribed) {
//                 channel.unsubscribe();
//             }
//         }
//     }
//     send_event(event_name, data, channel) {
//         return this.connection.send_event(event_name, data, channel);
//     }
//     shouldUseTLS() {
//         return this.config.useTLS;
//     }
//     signin() {
//         this.user.signin();
//     }
// }
// pusher_Pusher.instances = [];
// pusher_Pusher.isReady = false;
// pusher_Pusher.logToConsole = false;
// pusher_Pusher.Runtime = runtime;
// pusher_Pusher.ScriptReceivers = runtime.ScriptReceivers;
// pusher_Pusher.DependenciesReceivers = runtime.DependenciesReceivers;
// pusher_Pusher.auth_callbacks = runtime.auth_callbacks;
// /* harmony default export */ var core_pusher = __webpack_exports__["default"] = (pusher_Pusher);
// function checkAppKey(key) {
//     if (key === null || key === undefined) {
//         throw 'You must pass your app key when you instantiate Pusher.';
//     }
// }
// runtime.setup(pusher_Pusher);


// /***/ })
// /******/ ]);
// });
