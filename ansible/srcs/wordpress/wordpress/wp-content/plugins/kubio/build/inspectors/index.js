this.kubio=this.kubio||{},this.kubio.inspectors=function(e){var t={};function o(n){if(t[n])return t[n].exports;var c=t[n]={i:n,l:!1,exports:{}};return e[n].call(c.exports,c,c.exports,o),c.l=!0,c.exports}return o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var c in e)o.d(n,c,function(t){return e[t]}.bind(null,c));return n},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=556)}({0:function(e,t){!function(){e.exports=this.wp.element}()},1:function(e,t){!function(){e.exports=this.wp.i18n}()},10:function(e,t){!function(){e.exports=this.wp.compose}()},12:function(e,t){!function(){e.exports=this.wp.blocks}()},14:function(e,t){!function(){e.exports=this.wp.blockEditor}()},23:function(e,t){!function(){e.exports=this.wp.hooks}()},3:function(e,t){!function(){e.exports=this.wp.components}()},35:function(e,t){!function(){e.exports=this.kubio.editorData}()},4:function(e,t){!function(){e.exports=this.kubio.core}()},5:function(e,t){!function(){e.exports=this.kubio.controls}()},556:function(e,t,o){"use strict";o.r(t),o.d(t,"AdvancedStyleBlockInspector",(function(){return m})),o.d(t,"AdvancedInspectorControls",(function(){return k})),o.d(t,"ContentBlockInspector",(function(){return S})),o.d(t,"ContentInspectorControls",(function(){return j})),o.d(t,"DataHelperContextFromClientId",(function(){return B})),o.d(t,"BlockInspectorTopControls",(function(){return g})),o.d(t,"StyleBlockInspector",(function(){return T})),o.d(t,"StyleInspectorControls",(function(){return N})),o.d(t,"useCurrentInspectorTab",(function(){return P}));var n=o(35),c=o(0),l=o(1),r=o(12),i=o(8),s=o(10),u=o(3),b=o(14);const{Fill:a,Slot:d}=Object(u.createSlotFill)("AdvancedInspectorControls"),p=Object(s.createHigherOrderComponent)((e=>t=>{const o=Object(b.useBlockEditContext)(),{isSelected:n}=o;return n?Object(c.createElement)(e,t):null}),"ifBlockEditSelectedAdvancedInspectorControls"),k=Object(s.compose)([p])(a);k.Slot=d;var O=Object(s.compose)([Object(i.withSelect)((e=>{const{getSelectedBlockClientId:t,getSelectedBlockCount:o,getBlockName:n}=e("core/block-editor"),{getBlockStyles:c}=e("core/blocks"),l=t(),i=l&&n(l),s=l&&Object(r.getBlockType)(i),u=l&&c(i);return{count:o(),hasBlockStyles:u&&u.length>0,selectedBlockName:i,selectedBlockClientId:l,blockType:s}}))])((e=>{let{blockType:t,selectedBlockClientId:o,selectedBlockName:n,showNoBlockSelectedMessage:i=!0}=e;const s=n===Object(r.getUnregisteredTypeHandlerName)();return t&&o&&!s?Object(c.createElement)("div",{className:"block-editor-block-inspector kubio-inspector"},Object(c.createElement)(k.Slot,{bubblesVirtually:!0})):i?Object(c.createElement)("span",{className:"block-editor-block-inspector__no-blocks"},Object(l.__)("No block selected.","kubio")):null}));const m=()=>Object(c.createElement)(c.Fragment,null,Object(c.createElement)(O,null));var f=o(7);const j=e=>{const t=Object(b.useBlockEditContext)(),{isSelected:o}=t;return o&&Object(c.createElement)(u.__experimentalStyleProvider,{document:document},Object(c.createElement)(b.InspectorControls,Object(f.a)({className:"kubio-inspector"},e)))},S=()=>Object(c.createElement)(c.Fragment,null,Object(c.createElement)(b.BlockInspector,null));var y=o(4);const B=Object(s.compose)([Object(y.withObserveOtherBlocks)(((e,t)=>{let{clientId:o}=t;return o})),y.withKubioBlockContext])((e=>{let{children:t}=e;return t})),{Fill:h,Slot:C}=Object(u.createSlotFill)("StyleInspectorControlsTop"),E=Object(s.createHigherOrderComponent)((e=>t=>{const o=Object(b.useBlockEditContext)(),{isSelected:n}=o;return n?Object(c.createElement)(e,t):null}),"ifBlockEditSelectedStyleInspectorControls"),g=Object(s.compose)([E])(h);g.Slot=C;var I=o(23),v=o(5);const{Fill:x,Slot:w}=Object(u.createSlotFill)("StyleInspectorControls"),_=Object(s.createHigherOrderComponent)((e=>t=>{const o=Object(b.useBlockEditContext)(),{isSelected:n}=o;return n?Object(c.createElement)(u.__experimentalStyleProvider,{document:document},Object(c.createElement)(e,t)):null}),"ifBlockEditSelectedStyleInspectorControls"),N=Object(s.compose)([_])(x);N.Slot=e=>!Object(u.__experimentalUseSlot)("StyleInspectorControls").fills.length&&window.isKubioBlockEditor?Object(c.createElement)("div",{className:"kubio-editing-header"},Object(c.createElement)(v.ControlNotice,{content:Object(l.__)("Current block does not support styling","kubio")})):Object(c.createElement)(w,e);const T=Object(s.compose)([Object(i.withSelect)((e=>{const{getSelectedBlockClientId:t,getSelectedBlockCount:o,getBlockName:n}=e("core/block-editor"),{getBlockStyles:c}=e("core/blocks"),l=t(),i=l&&n(l),s=l&&Object(r.getBlockType)(i),u=l&&c(i);return{count:o(),hasBlockStyles:u&&u.length>0,selectedBlockName:i,selectedBlockClientId:l,blockType:s}}))])((e=>{let{blockType:t,selectedBlockClientId:o,selectedBlockName:n,showNoBlockSelectedMessage:i=!0}=e;const s=n===Object(r.getUnregisteredTypeHandlerName)();return t&&o&&!s?Object(c.createElement)("div",{className:"block-editor-block-inspector kubio-inspector"},Object(c.createElement)(N.Slot,{bubblesVirtually:!0})):i?Object(c.createElement)("span",{className:"block-editor-block-inspector__no-blocks"},Object(l.__)("No block selected.","kubio")):null})),F=Object(s.createHigherOrderComponent)((e=>t=>Object(c.createElement)(c.Fragment,null,!window.isKubioBlockEditor&&Object(c.createElement)(b.InspectorControls,null,Object(c.createElement)(v.LinkedNotice,t)),Object(c.createElement)(e,t),!window.isKubioBlockEditor&&Object(c.createElement)(b.InspectorControls,null,Object(c.createElement)(T,null)))),"withKubioStyleInspectorOutsideKubioEditor");Object(I.addFilter)("editor.BlockEdit","kubio.third-party-controls",F);const P=()=>{const[e,t]=Object(n.useGlobalSessionProp)("displayed-block-panel","content");return[e,t]}},7:function(e,t,o){"use strict";function n(){return n=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n])}return e},n.apply(this,arguments)}o.d(t,"a",(function(){return n}))},8:function(e,t){!function(){e.exports=this.wp.data}()}});
