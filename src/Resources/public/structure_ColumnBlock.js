import{i as u,o as a,c as i,a as e,F as p,r as _,d as b,w as D,u as s,e as c,f as h,g as k,h as x,b as r}from"./structure_index.js";const f={class:"active-widget"},v={class:"active-widget__actions"},y=e("div",{class:"active-widget__drag"},[e("i",{class:"bi bi-grip-horizontal"})],-1),C=["onClick"],B=e("i",{class:"bi bi-gear-fill"},null,-1),S=[B],w=e("button",{type:"button",class:"s-button s-button--transparent"},[e("i",{class:"bi bi-copy"})],-1),z=["onClick"],F=e("i",{class:"bi bi-x-lg"},null,-1),M=[F],j={__name:"ColumnBlock",props:{elementData:{type:Object,default:null}},setup(g){const t=g,m=u("openSettings");for(let o=0;o<t.elementData.columnsCount;o++)t.elementData.columns.push([]);return(o,P)=>(a(),i("div",{class:"columns-block",style:r(["padding-top:"+t.elementData.settings.Padding.top+"px;","padding-right:"+t.elementData.settings.Padding.right+"px;","padding-bottom:"+t.elementData.settings.Padding.bottom+"px;","padding-left:"+t.elementData.settings.Padding.left+"px;","margin-top:"+t.elementData.settings.Margin.top+"px;","margin-right:"+t.elementData.settings.Margin.right+"px;","margin-bottom:"+t.elementData.settings.Margin.bottom+"px;","margin-left:"+t.elementData.settings.Margin.left+"px;","background-color:"+t.elementData.settings.Background+";","color:"+t.elementData.settings.Color+";","text-align:"+t.elementData.settings.Align+";","max-width:"+(t.elementData.settings.Container?"1140px; margin: auto;":"100%;"),t.elementData.settings.FontSize?"font-size:"+t.elementData.settings.FontSize+t.elementData.settings.FontSizeType.code+";":""])},[e("div",{class:"columns-block__columns",style:r("align-items:"+t.elementData.alignVertical)},[(a(!0),i(p,null,_(t.elementData.columnsCount,l=>(a(),i("div",{key:l-1,class:"columns-block__column"},[b(s(x),{class:"drag-area",list:t.elementData.columns[l-1],group:"containers",itemKey:"uid"},{item:D(({element:n})=>[e("div",f,[e("div",v,[y,e("button",{type:"button",class:"s-button s-button--transparent",onClick:d=>s(m)(n)},S,8,C),w,e("button",{type:"button",class:"s-button s-button--transparent",onClick:d=>s(c).removeElement(n.uid)},M,8,z)]),(a(),h(k(s(c).createBlock(n.component)),{elementData:n},null,8,["elementData"]))])]),_:2},1032,["list"])]))),128))],4)],4))}};export{j as default};
