import{q as c,r as o,j as e,y as i,a as s}from"./app-B1U5o3NP.js";import{F as x}from"./FooterCuracao-DInE6Auw.js";import{H as h,L as f,B as m,U as b,a as j}from"./users-BRnDsNZV.js";function v({auth:t}){c().props;const[d,n]=o.useState(!1);return o.useEffect(()=>{const a=()=>{const l=document.getElementById("footerC").getBoundingClientRect().top,r=771;n(l<r),console.log(l<r)};return window.addEventListener("scroll",a),()=>{window.removeEventListener("scroll",a)}},[]),e.jsxs("main",{className:"flex flex-col h-max w-screen",children:[e.jsx("div",{className:"bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"}),e.jsx("img",{src:"/background-2.png",alt:"",className:"absolute inset-0 object-cover w-full h-full -z-[9]"}),e.jsxs("div",{className:"h-screen w-full",children:[e.jsxs("div",{className:"bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold",children:["Saldo: R$",t.user.saldo,",00"]}),e.jsxs("div",{className:"h-[65%] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ",children:[e.jsxs("div",{className:"mt-4",children:[e.jsx("h1",{className:"font-bold text-2xl",children:"BÔNUS DE INDICAÇÃO!"}),e.jsx("p",{className:"text-md",children:"Ganhe instantaneamente R$50 por pessoa convidada que depósitar no minimo R$20"}),e.jsxs("p",{className:"text-md mt-2",children:["Seu link de indicação é: ",e.jsx("span",{className:"font-bold",children:t.user.linkafiliado})]}),e.jsx("button",{children:"Copiar link"})]}),e.jsxs("div",{className:"flex flex-col text-left px-2 -mt-16",children:[e.jsx("h1",{className:"font-bold",children:"Estatisticas"}),e.jsx("div",{className:"",children:e.jsx("h1",{className:"text-md",children:"Saldo disponivel:R$0,00"})}),e.jsxs("div",{className:"flex w-full h-full border border-black rounded-md mt-2 flex-nowrap text-xs divide-x divide-black",children:[e.jsx("div",{className:"flex-1 pl-2",children:e.jsxs("table",{className:"h-48",children:[e.jsxs("tr",{children:[e.jsx("td",{children:"Ganho Total"}),e.jsx("td",{children:"R$"})]}),e.jsxs("tr",{children:[e.jsx("td",{children:"Recorrência"}),e.jsx("td",{children:"R$"})]}),e.jsxs("tr",{children:[e.jsx("td",{children:"Cadastros"}),e.jsx("td",{children:"0"})]}),e.jsx("tr",{children:e.jsxs("button",{className:"bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Saque afiliado"]})})]})}),e.jsx("div",{className:"flex-1 pl-2",children:e.jsxs("table",{className:"h-48",children:[e.jsxs("tr",{children:[e.jsx("td",{children:"Depositantes"}),e.jsx("td",{children:"R$"})]}),e.jsxs("tr",{children:[e.jsx("td",{children:"Valor indicação"}),e.jsx("td",{children:"R$50"})]}),e.jsxs("tr",{children:[e.jsx("td",{children:"Recorrência"}),e.jsx("td",{children:"%"})]}),e.jsx("tr",{children:e.jsxs("button",{onClick:()=>i.visit("/dashboard"),className:"bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Jogar"]})})]})})]})]})]})]}),e.jsx("div",{className:"h-screen bg-[#CD0000] w-full -mt-4",children:e.jsxs("div",{className:"h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto mt-8 rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4",children:[e.jsx("h1",{className:"text-2xl text-center font-bold",children:"INDIQUE UM AMIGO E GANHE R$50 NO PIX"}),e.jsxs("div",{className:"flex flex-col gap-4",children:[e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO FUNCIONA?"}),e.jsx("p",{children:"Convide seus amigos que ainda não estão na plataforma. Você receberá R$50 por cada amigo que se inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso significa que também não há limite para quanto você pode ganhar!"}),e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO RECEBO O DINHEIRO?"}),e.jsx("p",{children:"O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar via PIX."}),e.jsxs("button",{onClick:()=>i.visit("/afiliados"),className:"bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"EU QUERO R$50"]})]})]})}),e.jsxs("footer",{className:"fixed bottom-0 w-full h-12 bg-[#7C30F2]/60 backdrop-blur-sm flex items-center justify-between px-8 text-slate-300",children:[e.jsx(s,{href:"/dashboard",children:e.jsx(h,{})}),e.jsx(s,{href:"/deposito",children:e.jsx(f,{})}),e.jsx(s,{href:"/saque",children:e.jsx(m,{})}),e.jsx(s,{href:"/afiliados",className:` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  `+(d?" border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]":"border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]"),children:e.jsx(b,{})}),e.jsx(s,{href:"/logout",children:e.jsx(j,{})})]}),e.jsx(x,{})]})}export{v as default};
