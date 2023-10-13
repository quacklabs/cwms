// SDK version: v2.0.0
// Git commit: 13c861e66c60a498cdaa9c170574f63f6a8a74de

'use strict';

function unwrapExports (x) {
	return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
}

function createCommonjsModule(fn, module) {
	return module = { exports: {} }, fn(module, module.exports), module.exports;
}

var _typeof_1 = createCommonjsModule(function (module) {
function _typeof(o) {
  "@babel/helpers - typeof";

  return (module.exports = _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) {
    return typeof o;
  } : function (o) {
    return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports), _typeof(o);
}
module.exports = _typeof, module.exports.__esModule = true, module.exports["default"] = module.exports;
});

unwrapExports(_typeof_1);

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

var regeneratorRuntime$1 = createCommonjsModule(function (module) {
var _typeof = _typeof_1["default"];
function _regeneratorRuntime() {
  module.exports = _regeneratorRuntime = function _regeneratorRuntime() {
    return e;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  var t,
    e = {},
    r = Object.prototype,
    n = r.hasOwnProperty,
    o = Object.defineProperty || function (t, e, r) {
      t[e] = r.value;
    },
    i = "function" == typeof Symbol ? Symbol : {},
    a = i.iterator || "@@iterator",
    c = i.asyncIterator || "@@asyncIterator",
    u = i.toStringTag || "@@toStringTag";
  function define(t, e, r) {
    return Object.defineProperty(t, e, {
      value: r,
      enumerable: !0,
      configurable: !0,
      writable: !0
    }), t[e];
  }
  try {
    define({}, "");
  } catch (t) {
    define = function define(t, e, r) {
      return t[e] = r;
    };
  }
  function wrap(t, e, r, n) {
    var i = e && e.prototype instanceof Generator ? e : Generator,
      a = Object.create(i.prototype),
      c = new Context(n || []);
    return o(a, "_invoke", {
      value: makeInvokeMethod(t, r, c)
    }), a;
  }
  function tryCatch(t, e, r) {
    try {
      return {
        type: "normal",
        arg: t.call(e, r)
      };
    } catch (t) {
      return {
        type: "throw",
        arg: t
      };
    }
  }
  e.wrap = wrap;
  var h = "suspendedStart",
    l = "suspendedYield",
    f = "executing",
    s = "completed",
    y = {};
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}
  var p = {};
  define(p, a, function () {
    return this;
  });
  var d = Object.getPrototypeOf,
    v = d && d(d(values([])));
  v && v !== r && n.call(v, a) && (p = v);
  var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p);
  function defineIteratorMethods(t) {
    ["next", "throw", "return"].forEach(function (e) {
      define(t, e, function (t) {
        return this._invoke(e, t);
      });
    });
  }
  function AsyncIterator(t, e) {
    function invoke(r, o, i, a) {
      var c = tryCatch(t[r], t, o);
      if ("throw" !== c.type) {
        var u = c.arg,
          h = u.value;
        return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) {
          invoke("next", t, i, a);
        }, function (t) {
          invoke("throw", t, i, a);
        }) : e.resolve(h).then(function (t) {
          u.value = t, i(u);
        }, function (t) {
          return invoke("throw", t, i, a);
        });
      }
      a(c.arg);
    }
    var r;
    o(this, "_invoke", {
      value: function value(t, n) {
        function callInvokeWithMethodAndArg() {
          return new e(function (e, r) {
            invoke(t, n, e, r);
          });
        }
        return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
      }
    });
  }
  function makeInvokeMethod(e, r, n) {
    var o = h;
    return function (i, a) {
      if (o === f) throw new Error("Generator is already running");
      if (o === s) {
        if ("throw" === i) throw a;
        return {
          value: t,
          done: !0
        };
      }
      for (n.method = i, n.arg = a;;) {
        var c = n.delegate;
        if (c) {
          var u = maybeInvokeDelegate(c, n);
          if (u) {
            if (u === y) continue;
            return u;
          }
        }
        if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) {
          if (o === h) throw o = s, n.arg;
          n.dispatchException(n.arg);
        } else "return" === n.method && n.abrupt("return", n.arg);
        o = f;
        var p = tryCatch(e, r, n);
        if ("normal" === p.type) {
          if (o = n.done ? s : l, p.arg === y) continue;
          return {
            value: p.arg,
            done: n.done
          };
        }
        "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg);
      }
    };
  }
  function maybeInvokeDelegate(e, r) {
    var n = r.method,
      o = e.iterator[n];
    if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y;
    var i = tryCatch(o, e.iterator, r.arg);
    if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y;
    var a = i.arg;
    return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y);
  }
  function pushTryEntry(t) {
    var e = {
      tryLoc: t[0]
    };
    1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e);
  }
  function resetTryEntry(t) {
    var e = t.completion || {};
    e.type = "normal", delete e.arg, t.completion = e;
  }
  function Context(t) {
    this.tryEntries = [{
      tryLoc: "root"
    }], t.forEach(pushTryEntry, this), this.reset(!0);
  }
  function values(e) {
    if (e || "" === e) {
      var r = e[a];
      if (r) return r.call(e);
      if ("function" == typeof e.next) return e;
      if (!isNaN(e.length)) {
        var o = -1,
          i = function next() {
            for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next;
            return next.value = t, next.done = !0, next;
          };
        return i.next = i;
      }
    }
    throw new TypeError(_typeof(e) + " is not iterable");
  }
  return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", {
    value: GeneratorFunctionPrototype,
    configurable: !0
  }), o(GeneratorFunctionPrototype, "constructor", {
    value: GeneratorFunction,
    configurable: !0
  }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) {
    var e = "function" == typeof t && t.constructor;
    return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name));
  }, e.mark = function (t) {
    return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t;
  }, e.awrap = function (t) {
    return {
      __await: t
    };
  }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () {
    return this;
  }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) {
    void 0 === i && (i = Promise);
    var a = new AsyncIterator(wrap(t, r, n, o), i);
    return e.isGeneratorFunction(r) ? a : a.next().then(function (t) {
      return t.done ? t.value : a.next();
    });
  }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () {
    return this;
  }), define(g, "toString", function () {
    return "[object Generator]";
  }), e.keys = function (t) {
    var e = Object(t),
      r = [];
    for (var n in e) r.push(n);
    return r.reverse(), function next() {
      for (; r.length;) {
        var t = r.pop();
        if (t in e) return next.value = t, next.done = !1, next;
      }
      return next.done = !0, next;
    };
  }, e.values = values, Context.prototype = {
    constructor: Context,
    reset: function reset(e) {
      if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t);
    },
    stop: function stop() {
      this.done = !0;
      var t = this.tryEntries[0].completion;
      if ("throw" === t.type) throw t.arg;
      return this.rval;
    },
    dispatchException: function dispatchException(e) {
      if (this.done) throw e;
      var r = this;
      function handle(n, o) {
        return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o;
      }
      for (var o = this.tryEntries.length - 1; o >= 0; --o) {
        var i = this.tryEntries[o],
          a = i.completion;
        if ("root" === i.tryLoc) return handle("end");
        if (i.tryLoc <= this.prev) {
          var c = n.call(i, "catchLoc"),
            u = n.call(i, "finallyLoc");
          if (c && u) {
            if (this.prev < i.catchLoc) return handle(i.catchLoc, !0);
            if (this.prev < i.finallyLoc) return handle(i.finallyLoc);
          } else if (c) {
            if (this.prev < i.catchLoc) return handle(i.catchLoc, !0);
          } else {
            if (!u) throw new Error("try statement without catch or finally");
            if (this.prev < i.finallyLoc) return handle(i.finallyLoc);
          }
        }
      }
    },
    abrupt: function abrupt(t, e) {
      for (var r = this.tryEntries.length - 1; r >= 0; --r) {
        var o = this.tryEntries[r];
        if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) {
          var i = o;
          break;
        }
      }
      i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null);
      var a = i ? i.completion : {};
      return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a);
    },
    complete: function complete(t, e) {
      if ("throw" === t.type) throw t.arg;
      return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y;
    },
    finish: function finish(t) {
      for (var e = this.tryEntries.length - 1; e >= 0; --e) {
        var r = this.tryEntries[e];
        if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y;
      }
    },
    "catch": function _catch(t) {
      for (var e = this.tryEntries.length - 1; e >= 0; --e) {
        var r = this.tryEntries[e];
        if (r.tryLoc === t) {
          var n = r.completion;
          if ("throw" === n.type) {
            var o = n.arg;
            resetTryEntry(r);
          }
          return o;
        }
      }
      throw new Error("illegal catch attempt");
    },
    delegateYield: function delegateYield(e, r, n) {
      return this.delegate = {
        iterator: values(e),
        resultName: r,
        nextLoc: n
      }, "next" === this.method && (this.arg = t), y;
    }
  }, e;
}
module.exports = _regeneratorRuntime, module.exports.__esModule = true, module.exports["default"] = module.exports;
});

unwrapExports(regeneratorRuntime$1);

// TODO(Babel 8): Remove this file.

var runtime = regeneratorRuntime$1();
var regenerator = runtime;

// Copied from https://github.com/facebook/regenerator/blob/main/packages/runtime/runtime.js#L736=
try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}

function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
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
    var _ref2 = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee(response) {
      return regenerator.wrap(function _callee$(_context) {
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
  _handleError = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee2(response) {
    var errorMessage, _yield$response$json, _yield$response$json$, error, _yield$response$json$2, description;
    return regenerator.wrap(function _callee2$(_context2) {
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
      var _readProperty2 = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee(name) {
        var state;
        return regenerator.wrap(function _callee$(_context) {
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
      var _writeProperty2 = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee2(name, value) {
        var state;
        return regenerator.wrap(function _callee2$(_context2) {
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

function ownKeys$1(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread$1(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys$1(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys$1(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
self.PusherPushNotifications = {
  endpointOverride: null,
  onNotificationReceived: null,
  _endpoint: function _endpoint(instanceId) {
    return self.PusherPushNotifications.endpointOverride ? self.PusherPushNotifications.endpointOverride : "https://".concat(instanceId, ".pushnotifications.pusher.com");
  },
  _getVisibleClient: function _getVisibleClient() {
    return self.clients.matchAll({
      type: 'window',
      includeUncontrolled: true
    }).then(function (clients) {
      return clients.find(function (c) {
        return c.visibilityState === 'visible';
      });
    });
  },
  _hasVisibleClient: function _hasVisibleClient() {
    return self.PusherPushNotifications._getVisibleClient().then(function (client) {
      return client !== undefined;
    });
  },
  _getFocusedClient: function _getFocusedClient() {
    return self.clients.matchAll({
      type: 'window',
      includeUncontrolled: true
    }).then(function (clients) {
      return clients.find(function (c) {
        return c.focused === true;
      });
    });
  },
  _hasFocusedClient: function _hasFocusedClient() {
    return self.PusherPushNotifications._getFocusedClient().then(function (client) {
      return client !== undefined;
    });
  },
  _getState: function () {
    var _getState2 = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee(pusherMetadata) {
      var instanceId, publishId, hasDisplayableContent, hasData, deviceStateStore, deviceId, userId, appInBackground;
      return regenerator.wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            instanceId = pusherMetadata.instanceId, publishId = pusherMetadata.publishId, hasDisplayableContent = pusherMetadata.hasDisplayableContent, hasData = pusherMetadata.hasData;
            if (!(!instanceId || !publishId)) {
              _context.next = 3;
              break;
            }
            return _context.abrupt("return");
          case 3:
            deviceStateStore = new DeviceStateStore(instanceId);
            _context.next = 6;
            return deviceStateStore.connect();
          case 6:
            _context.next = 8;
            return deviceStateStore.getDeviceId();
          case 8:
            deviceId = _context.sent;
            _context.next = 11;
            return deviceStateStore.getUserId();
          case 11:
            _context.t0 = _context.sent;
            if (_context.t0) {
              _context.next = 14;
              break;
            }
            _context.t0 = null;
          case 14:
            userId = _context.t0;
            _context.next = 17;
            return self.PusherPushNotifications._hasVisibleClient();
          case 17:
            appInBackground = !_context.sent;
            return _context.abrupt("return", {
              instanceId: instanceId,
              publishId: publishId,
              deviceId: deviceId,
              userId: userId,
              appInBackground: appInBackground,
              hasDisplayableContent: hasDisplayableContent,
              hasData: hasData
            });
          case 19:
          case "end":
            return _context.stop();
        }
      }, _callee);
    }));
    function _getState(_x) {
      return _getState2.apply(this, arguments);
    }
    return _getState;
  }(),
  reportEvent: function () {
    var _reportEvent = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee2(_ref) {
      var eventType, state, path, options;
      return regenerator.wrap(function _callee2$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            eventType = _ref.eventType, state = _ref.state;
            path = "".concat(self.PusherPushNotifications._endpoint(state.instanceId), "/reporting_api/v2/instances/").concat(state.instanceId, "/events");
            options = {
              method: 'POST',
              path: path,
              body: {
                publishId: state.publishId,
                event: eventType,
                deviceId: state.deviceId,
                userId: state.userId,
                timestampSecs: Math.floor(Date.now() / 1000),
                appInBackground: state.appInBackground,
                hasDisplayableContent: state.hasDisplayableContent,
                hasData: state.hasData
              }
            };
            _context2.prev = 3;
            _context2.next = 6;
            return doRequest(options);
          case 6:
            _context2.next = 10;
            break;
          case 8:
            _context2.prev = 8;
            _context2.t0 = _context2["catch"](3);
          case 10:
          case "end":
            return _context2.stop();
        }
      }, _callee2, null, [[3, 8]]);
    }));
    function reportEvent(_x2) {
      return _reportEvent.apply(this, arguments);
    }
    return reportEvent;
  }()
};
self.addEventListener('push', function (e) {
  var payload;
  try {
    payload = e.data.json();
  } catch (_) {
    return; // Not a pusher notification
  }

  if (!payload.data || !payload.data.pusher) {
    return; // Not a pusher notification
  }

  var statePromise = self.PusherPushNotifications._getState(payload.data.pusher);
  statePromise.then(function (state) {
    // Report analytics event, best effort
    self.PusherPushNotifications.reportEvent({
      eventType: 'delivery',
      state: state
    });
  });
  var customerPayload = _objectSpread$1({}, payload);
  var customerData = {};
  Object.keys(customerPayload.data || {}).forEach(function (key) {
    if (key !== 'pusher') {
      customerData[key] = customerPayload.data[key];
    }
  });
  customerPayload.data = customerData;
  var pusherMetadata = payload.data.pusher;
  var handleNotification = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/regenerator.mark(function _callee3(payloadFromCallback) {
      var hideNotificationIfSiteHasFocus, title, body, icon, options;
      return regenerator.wrap(function _callee3$(_context3) {
        while (1) switch (_context3.prev = _context3.next) {
          case 0:
            hideNotificationIfSiteHasFocus = payloadFromCallback.notification.hide_notification_if_site_has_focus === true;
            _context3.t0 = hideNotificationIfSiteHasFocus;
            if (!_context3.t0) {
              _context3.next = 6;
              break;
            }
            _context3.next = 5;
            return self.PusherPushNotifications._hasFocusedClient();
          case 5:
            _context3.t0 = _context3.sent;
          case 6:
            if (!_context3.t0) {
              _context3.next = 8;
              break;
            }
            return _context3.abrupt("return");
          case 8:
            title = payloadFromCallback.notification.title || '';
            body = payloadFromCallback.notification.body || '';
            icon = payloadFromCallback.notification.icon;
            options = {
              body: body,
              icon: icon,
              data: {
                pusher: {
                  customerPayload: payloadFromCallback,
                  pusherMetadata: pusherMetadata
                }
              }
            };
            return _context3.abrupt("return", self.registration.showNotification(title, options));
          case 13:
          case "end":
            return _context3.stop();
        }
      }, _callee3);
    }));
    return function handleNotification(_x3) {
      return _ref2.apply(this, arguments);
    };
  }();
  if (self.PusherPushNotifications.onNotificationReceived) {
    self.PusherPushNotifications.onNotificationReceived({
      payload: customerPayload,
      pushEvent: e,
      handleNotification: handleNotification,
      statePromise: statePromise
    });
  } else {
    e.waitUntil(handleNotification(customerPayload));
  }
});
self.addEventListener('notificationclick', function (e) {
  var pusher = e.notification.data.pusher;
  var isPusherNotification = pusher !== undefined;
  if (isPusherNotification) {
    var statePromise = self.PusherPushNotifications._getState(pusher.pusherMetadata);

    // Report analytics event, best effort
    statePromise.then(function (state) {
      self.PusherPushNotifications.reportEvent({
        eventType: 'open',
        state: state
      });
    });
    var deepLink = pusher.customerPayload.notification.deep_link;
    if (deepLink) {
      // if the deep link is already opened, focus the existing window, else open a new window
      var promise = clients.matchAll({
        includeUncontrolled: true
      }).then(function (windowClients) {
        var existingWindow = windowClients.find(function (windowClient) {
          return windowClient.url === deepLink;
        });
        if (existingWindow) {
          return existingWindow.focus();
        } else {
          return clients.openWindow(deepLink);
        }
      });
      e.waitUntil(promise);
    }
    e.notification.close();
  }
});

addEventListener('push', function(event) {
  self.sendMessageToClient(event.data.text());
});


self.sendMessageToClient = async (message) => {
  // Send to any window client controlled by this service worker
   const clientList = await clients.matchAll({ type: "window" });
   const content = JSON.parse(message)
   for (let client of clientList) {
     client.postMessage({
            title: content.data.title,
            body: content.data.body
      });
   }
 }


// const notify = (payload) => {
  
// }

// self.sendMessageToClient = async (message) => {
//   // Send to any window client controlled by this service worker
//   // console.log(message)
  
// }

PusherPushNotifications.onNotificationReceived = ({ pushEvent, payload }) => {
  // pushEvent.waitUntil(() => {

  // })
}
  // return;
  // pushEvent.ports[0].postMessage({'test': 'This is my response.'});
    // console.log('will parse list')
    // pushEvent.waitUntil(
    //   (async () => {
    //     // if(!pushEvent.clientId){
    //     //   console.log('no client id')
    //     //   return;
    //     // }
    //     const client = await clients.matchAll({ type: "window" });

    //     if (!client) {
    //       console.log('no-client')
    //       return;
    //     }

    //     // Send a message to the client.
        // client[0].postMessage(
    //     });
      
    //   })()
    // )

    
  // NOTE: Overriding this method will disable the default notification
  // handling logic offered by Pusher Beams. You MUST display a notification
  // in this callback unless your site is currently in focus
  // https://developers.google.com/web/fundamentals/push-notifications/subscribing-a-user#uservisibleonly_options
  // self.sendMessageToClient(pushEvent)
  // Your custom notification handling logic here 🛠️
  // console.log('this works')
  // self.clients.matchAll().then(function (clients) {
  //   clients.forEach(function (client) {
  //     client.postMessage({
  //       type: 'pushNotification',
  //       options: options,
  //     });
  //   });
  // });

  // self.registration.postMessage(payload)
  
  // iziToast.show({
  //   title: 'Hey',
  //     message: 'What would you like to add?'
  // });
  // return
  // https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerRegistration/showNotification
  // pushEvent.waitUntil((payload) => {
  //   self.postMessage(payload),
  //   console.log('posted')
  // }
    
    // self.registration.showNotification(payload.notification.title, {
    //   body: payload.notification.body,
    //   icon: payload.notification.icon,
    //   data: payload.data,
    // })
  // );
// };

