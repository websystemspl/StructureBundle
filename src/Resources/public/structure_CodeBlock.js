import{o as l,c as i,d as s,n as g,u as t}from"./structure_index.js";import{_ as m}from"./structure_vue-contenteditable.es.js";const d={class:"code-block"},D={__name:"CodeBlock",props:{elementData:{type:Object,default:null}},setup(n){let e=n;return(r,a)=>(l(),i("div",d,[s(t(m),{style:g(["padding-top:"+t(e).elementData.settings.Padding.top+"px;","padding-right:"+t(e).elementData.settings.Padding.right+"px;","padding-bottom:"+t(e).elementData.settings.Padding.bottom+"px;","padding-left:"+t(e).elementData.settings.Padding.left+"px;","margin-top:"+t(e).elementData.settings.Margin.top+"px;","margin-right:"+t(e).elementData.settings.Margin.right+"px;","margin-bottom:"+t(e).elementData.settings.Margin.bottom+"px;","margin-left:"+t(e).elementData.settings.Margin.left+"px;","background-color:"+t(e).elementData.settings.Background+";","color:"+t(e).elementData.settings.Color+";","text-align:"+t(e).elementData.settings.Align+";","max-width:"+(t(e).elementData.settings.Container?"1140px; margin: auto;":"100%;"),t(e).elementData.settings.FontSize?"font-size:"+t(e).elementData.settings.FontSize+t(e).elementData.settings.FontSizeType.code+";":""]),tag:"div",contenteditable:!0,modelValue:t(e).elementData.code,"onUpdate:modelValue":a[0]||(a[0]=o=>t(e).elementData.code=o),"no-nl":!1,"no-html":!1},null,8,["style","modelValue"])]))}};export{D as default};
