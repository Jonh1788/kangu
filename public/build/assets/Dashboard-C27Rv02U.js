import{r as d,j as e,y as o,a as l}from"./app-a3TvAY9g.js";import{F as f}from"./FooterCuracao-Cpd9u-xt.js";import{H as h,L as m,B as b,U as u,a as p}from"./users-DIGGfJjW.js";function v({auth:i,token:n}){const[c,x]=d.useState(!1);d.useEffect(()=>{const s=()=>{const t=document.getElementById("footerC").getBoundingClientRect().top,a=771;x(t<a),console.log(t<a)};return window.addEventListener("scroll",s),()=>{window.removeEventListener("scroll",s)}},[]);const r=s=>{if(i.user.saldo<s){o.visit("/deposito");return}var t={saldo:i.user.saldo-s,token:n,email:i.user.email};console.log(t),axios.post("/game",t).then(a=>{window.location.href="/game?aposta="+s}).catch(a=>{console.log(a)})};return e.jsxs("main",{className:"flex-col flex h-max w-screen",children:[e.jsx("div",{className:"bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"}),e.jsxs("div",{className:"h-screen w-full",children:[e.jsx("img",{src:"/background-2.png",alt:"",className:"absolute inset-0 object-cover w-full h-full -z-[9]"}),e.jsxs("div",{className:"flex items-center pr-8",children:[e.jsxs("div",{className:"bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold",children:["Saldo: R$",i.user.saldo,",00"]}),e.jsx("button",{onClick:()=>o.visit("/deposito"),className:"ml-auto mt-4 bg-slate-400 p-4 rounded-md font-bold text-white hover:bg-slate-600 shadow-md",children:"Depositar"})]}),e.jsxs("div",{className:"h-[65%] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ",children:[e.jsxs("div",{className:"mt-4 -mb-8",children:[e.jsx("h1",{className:"font-bold text-xl",children:"Vamos jogar!"}),e.jsx("p",{className:"text-sm",children:"Escolha um valor abaixo:"})]}),e.jsxs("div",{className:"flex gap-2 px-2",children:[e.jsxs("button",{onClick:()=>r(1),className:"bg-[#30B3F2] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$1,00"]}),e.jsxs("button",{onClick:()=>r(5),className:"bg-[#30B3F2] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$5,00"]})]}),e.jsxs("div",{className:"flex flex-col gap-2 -mt-8",children:[e.jsx("h1",{children:"Outras opções:"}),e.jsxs("div",{className:"flex flex-col gap-4 px-2",children:[e.jsx("p",{children:"Jogue com dinheiro real:"}),e.jsxs("button",{onClick:()=>o.visit("/deposito"),className:"bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Depositar"]}),e.jsx("p",{children:"Teste o jogo"}),e.jsxs("button",{onClick:()=>window.location.href="/demo",className:"bg-[#54859D] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Testar"]}),e.jsx("p",{children:"Indique um amigo"}),e.jsxs("button",{onClick:()=>o.visit("/afiliados"),className:"bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$50 Grátis"]})]})]})]})]}),e.jsx("div",{className:"h-screen bg-[#CD0000] w-full -mt-4",children:e.jsxs("div",{className:"h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto mt-8 rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4",children:[e.jsx("h1",{className:"text-2xl text-center font-bold",children:"INDIQUE UM AMIGO E GANHE R$50 NO PIX"}),e.jsxs("div",{className:"flex flex-col gap-4",children:[e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO FUNCIONA?"}),e.jsx("p",{children:"Convide seus amigos que ainda não estão na plataforma. Você receberá R$50 por cada amigo que se inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso significa que também não há limite para quanto você pode ganhar!"}),e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO RECEBO O DINHEIRO?"}),e.jsx("p",{children:"O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar via PIX."}),e.jsxs("button",{onClick:()=>o.visit("/afiliados"),className:"bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"EU QUERO R$50"]})]})]})}),e.jsxs("footer",{className:"fixed bottom-0 w-full h-12 bg-[#7C30F2]/60 backdrop-blur-sm flex items-center justify-between px-8 text-slate-300",children:[e.jsx(l,{href:"/dashboard",className:` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  `+(c?" border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]":"border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]"),children:e.jsx(h,{})}),e.jsx(l,{href:"/deposito",children:e.jsx(m,{})}),e.jsx(l,{href:"/saque",children:e.jsx(b,{})}),e.jsx(l,{href:"/afiliados",children:e.jsx(u,{})}),e.jsx(l,{href:"/logout",children:e.jsx(p,{})})]}),e.jsx(f,{})]})}export{v as default};
