/*************************************************************
 *
 *  MathJax/extensions/tex2jax.js
 *  
 *  Implements the TeX to Jax preprocessor that locates TeX code
 *  within the text of a document and replaces it with SCRIPT tags
 *  for processing by MathJax.
 *
 *  ---------------------------------------------------------------------
 *  
 *  Copyright (c) 2009-2011 Design Science, Inc.
 * 
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

MathJax.Extension.tex2jax = {
  version: "1.1.2",
  config: {
    inlineMath: [              // The start/stop pairs for in-line math
//    ['$','$'],               //  (comment out any you don't want, or add your own, but
      ['\\(','\\)']            //  be sure that you don't have an extra comma at the end)
    ],

    displayMath: [             // The start/stop pairs for display math
      ['$$','$$'],             //  (comment out any you don't want, or add your own, but
      ['\\[','\\]']            //  be sure that you don't have an extra comma at the end)
    ],

    skipTags: ["script","noscript","style","textarea","pre","code"],
                               // The names of the tags whose contents will not be
                               // scanned for math delimiters

    ignoreClass: "tex2jax_ignore",    // the class name of elements whose contents should
                                      // NOT be processed by tex2jax.  Note that this
                                      // is a regular expression, so be sure to quote any
                                      // regexp special characters

    processClass: "tex2jax_process",  // the class name of elements whose contents SHOULD
                                      // be processed when they appear inside ones that
                                      // are ignored.  Note that this is a regular expression,
                                      // so be sure to quote any regexp special characters

    processEscapes: false,     // set to true to allow \$ to produce a dollar without
                               //   starting in-line math mode

    processEnvironments: true, // set to true to process \begin{xxx}...\end{xxx} outside
                               //   of math mode, false to prevent that

    preview: "TeX"             // set to "none" to not insert MathJax_Preview spans
                               //   or set to an array specifying an HTML snippet
                               //   to use the same preview for every equation.

  },
  
  PreProcess: function (element) {
    if (!this.configured) {
      this.config = MathJax.Hub.CombineConfig("tex2jax",this.config);
      if (this.config.Augment) {MathJax.Hub.Insert(this,this.config.Augment)}
      if (typeof(this.config.previewTeX) !== "undefined" && !this.config.previewTeX)
        {this.config.preview = "none"} // backward compatibility for previewTeX parameter
      this.configured = true;
    }
    if (typeof(element) === "string") {element = document.getElementById(element)}
    if (!element) {element = document.body}
    this.createPatterns();
    this.scanElement(element,element.nextSibling);
  },
  
  createPatterns: function () {
    var starts = [], i, m, config = this.config;
    this.match = {};
    for (i = 0, m = config.inlineMath.length; i < m; i++) {
      starts.push(this.patternQuote(config.inlineMath[i][0]));
      this.match[config.inlineMath[i][0]] = {
        mode: "",
        end: config.inlineMath[i][1],
        pattern: this.endPattern(config.inlineMath[i][1])
      };
    }
    for (i = 0, m = config.displayMath.length; i < m; i++) {
      starts.push(this.patternQuote(config.displayMath[i][0]));
      this.match[config.displayMath[i][0]] = {
        mode: "; mode=display",
        end: config.displayMath[i][1],
        pattern: this.endPattern(config.displayMath[i][1])
      };
    }
    this.start = new RegExp(
        starts.sort(this.sortLength).join("|") + 
        (config.processEnvironments ? "|\\\\begin\\{([^}]*)\\}" : "") + 
        (config.processEscapes ? "|\\\\*\\\\\\\$" : ""), "g"
    );
    this.skipTags = new RegExp("^("+config.skipTags.join("|")+")$","i");
    this.ignoreClass = new RegExp("(^| )("+config.ignoreClass+")( |$)");
    this.processClass = new RegExp("(^| )("+config.processClass+")( |$)");
  },
  
  patternQuote: function (s) {return s.replace(/([\^$(){}+*?\-|\[\]\:\\])/g,'\\$1')},
  
  endPattern: function (end) {
    return new RegExp(this.patternQuote(end)+"|\\\\.","g");
  },
  
  sortLength: function (a,b) {
    if (a.length !== b.length) {return b.length - a.length}
    return (a == b ? 0 : (a < b ? -1 : 1));
  },
  
  scanElement: function (element,stop,ignore) {
    var cname, tname, ignoreChild;
    while (element && element != stop) {
      if (element.nodeName.toLowerCase() === '#text') {
        if (!ignore) {element = this.scanText(element)}
      } else {
        cname = (typeof(element.className) === "undefined" ? "" : element.className);
        tname = (typeof(element.tagName)   === "undefined" ? "" : element.tagName);
        if (typeof(cname) !== "string") {cname = String(cname)} // jsxgraph uses non-string class names!
        if (element.firstChild && !cname.match(/(^| )MathJax/) && !this.skipTags.exec(tname)) {
          ignoreChild = (ignore || this.ignoreClass.exec(cname)) && !this.processClass.exec(cname);
          this.scanElement(element.firstChild,stop,ignoreChild);
        }
      }
      if (element) {element = element.nextSibling}
    }
  },
  
  scanText: function (element) {
    if (element.nodeValue.replace(/\s+/,'') == '') {return element}
    var match, prev;
    this.search = {start: true};
    this.pattern = this.start;
    while (element) {
      this.pattern.lastIndex = 0;
      while (element && element.nodeName.toLowerCase() === '#text' &&
            (match = this.pattern.exec(element.nodeValue))) {
        if (this.search.start) {element = this.startMatch(match,element)}
                          else {element = this.endMatch(match,element)}
      }
      if (this.search.matched) {element = this.encloseMath(element)}
      if (element) {
        do {prev = element; element = element.nextSibling}
          while (element && (element.nodeName.toLowerCase() === 'br' ||
                             element.nodeName.toLowerCase() === '#comment'));
        if (!element || element.nodeName !== '#text') {return prev}
      }
    }
    return element;
  },
  
  startMatch: function (match,element) {
    var delim = this.match[match[0]];
    if (delim != null) {                              // a start delimiter
      this.search = {
        end: delim.end, mode: delim.mode,
        open: element, olen: match[0].length, opos: this.pattern.lastIndex - match[0].length
      };
      this.switchPattern(delim.pattern);
    } else if (match[0].substr(0,6) === "\\begin") {  // \begin{...}
      this.search = {
        end: "\\end{"+match[1]+"}", mode: "; mode=display",
        open: element, olen: 0, opos: this.pattern.lastIndex - match[0].length,
        isBeginEnd: true
      };
      this.switchPattern(this.endPattern(this.search.end));
    } else {                                         // escaped dollar signs
      var dollar = match[0].replace(/\\(.)/g,'$1');
      element.nodeValue = element.nodeValue.substr(0,match.index) + dollar +
                          element.nodeValue.substr(match.index + match[0].length);
      this.pattern.lastIndex -= match[0].length - dollar.length;
    }
    return element;
  },
  
  endMatch: function (match,element) {
    if (match[0] == this.search.end) {
      this.search.close = element;
      this.search.cpos = this.pattern.lastIndex;
      this.search.clen = (this.search.isBeginEnd ? 0 : match[0].length);
      this.search.matched = true;
      element = this.encloseMath(element);
      this.switchPattern(this.start);
    }
    return element;
  },
  
  switchPattern: function (pattern) {
    pattern.lastIndex = this.pattern.lastIndex;
    this.pattern = pattern;
    this.search.start = (pattern === this.start);
  },
  
  encloseMath: function (element) {
    var search = this.search, close = search.close, CLOSE, math;
    if (search.cpos === close.length) {close = close.nextSibling}
       else {close = close.splitText(search.cpos)}
    if (!close) {CLOSE = close = MathJax.HTML.addText(search.close.parentNode,"")}
    search.close = close;
    math = (search.opos ? search.open.splitText(search.opos) : search.open);
    while (math.nextSibling && math.nextSibling !== close) {
      if (math.nextSibling.nodeValue !== null) {
        if (math.nextSibling.nodeName === "#comment") {
          math.nodeValue += math.nextSibling.nodeValue.replace(/^\[CDATA\[((.|\n|\r)*)\]\]$/,"$1");
        } else {
          math.nodeValue += math.nextSibling.nodeValue;
        }
      } else if (this.msieNewlineBug) {
        math.nodeValue += (math.nextSibling.nodeName.toLowerCase() === "br" ? "\n" : " ");
      } else {
        math.nodeValue += " ";
      }
      math.parentNode.removeChild(math.nextSibling);
    }
    var TeX = math.nodeValue.substr(search.olen,math.nodeValue.length-search.olen-search.clen);
    math.parentNode.removeChild(math);
    if (this.config.preview !== "none") {this.createPreview(search.mode,TeX)}
    math = this.createMathTag(search.mode,TeX);
    this.search = {}; this.pattern.lastIndex = 0;
    if (CLOSE) {CLOSE.parentNode.removeChild(CLOSE)}
    return math;
  },
  
  insertNode: function (node) {
    var search = this.search;
    search.close.parentNode.insertBefore(node,search.close);
  },
  
  createPreview: function (mode,tex) {
    var preview;
    if (this.config.preview === "TeX") {preview = [this.filterTeX(tex)]}
    else if (this.config.preview instanceof Array) {preview = this.config.preview}
    if (preview) {
      preview = MathJax.HTML.Element("span",{className:MathJax.Hub.config.preRemoveClass},preview);
      this.insertNode(preview);
    }
  },
  
  createMathTag: function (mode,tex) {
    var script = document.createElement("script");
    script.type = "math/tex" + mode;
    MathJax.HTML.setScript(script,tex);
    this.insertNode(script);
    return script;
  },
  
  filterTeX: function (tex) {return tex},
  
  msieNewlineBug: (MathJax.Hub.Browser.isMSIE && document.documentMode < 9)
  
};

MathJax.Hub.Register.PreProcessor(["PreProcess",MathJax.Extension.tex2jax]);
MathJax.Ajax.loadComplete("[MathJax]/extensions/tex2jax.js");