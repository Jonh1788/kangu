import{r as l,q as v,j as e,y as c,a as o}from"./app-BL_GIQk4.js";import{F as N}from"./FooterCuracao-DBcsLQDB.js";import{H as C,L as z,B as y,U as F,a as k}from"./users-CauWcYjT.js";function E({auth:f}){const[b,u]=l.useState(!1),[p,d]=l.useState(!1);var g=new URLSearchParams(window.location.search),x=g.get("score")||"";l.useEffect(()=>{x&&d(!0);const t=()=>{const s=document.getElementById("footerC").getBoundingClientRect().top,h=771;u(s<h),console.log(s<h)};return window.addEventListener("scroll",t),()=>{window.removeEventListener("scroll",t)}},[]),v();const[j,m]=l.useState(!1),[a,i]=l.useState({nome:"",cpf:"",valor:""}),n=t=>{i({...a,[t.target.name]:t.target.value})},w=t=>{m(!0),t.preventDefault(),axios.post("/depositar",a).then(s=>{c.visit(route("deposito.pix",{pix_key:s.data.pix_key,transactionId:s.data.transactionId})),i({nome:"",cpf:"",valor:""})}).catch(s=>{alert("Erro ao realizar depósito!"),console.error(s)}).finally(()=>{m(!1)})},r=t=>{i({...a,valor:t})};return e.jsxs("main",{className:"h-max w-screen flex flex-col",children:[p&&e.jsx("div",{id:"modal",className:"flex items-center justify-center h-screen w-screen absolute inset-0 bg-slate-800/50 z-10",children:e.jsxs("div",{className:"w-[90%] h-max py-4 px-4 bg-white rounded-lg text-slate-900 text-center pt-4 gap-4 flex flex-col border-4 border-slate-400",children:[e.jsx("h1",{className:"font-bold",children:"Parabéns!"}),e.jsxs("p",{children:["Parabéns você chegou a ter R$",x," em saldo! Realize o depósito para ter ganhos reais!"]}),e.jsxs("button",{onClick:()=>d(!1),className:"bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Depositar"]})]})}),e.jsx("div",{className:"bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"}),e.jsx("img",{src:"/background-2.png",alt:"",className:"absolute inset-0 object-cover w-full h-full -z-[9]"}),e.jsxs("div",{className:"h-screen w-full",children:[e.jsxs("div",{className:"flex items-center pr-4",children:[e.jsxs("div",{className:"bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold",children:["Saldo: R$",f.user.saldo,",00"]}),e.jsx("button",{onClick:()=>c.visit("/dashboard"),className:"ml-auto mt-4 bg-slate-400 p-4 rounded-md mr-2 font-bold text-white hover:bg-slate-600 shadow-md",children:"Jogar"})]}),e.jsxs("div",{className:"h-max pb-4 w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ",children:[e.jsxs("div",{className:"mt-4 flex flex-col items-center",children:[e.jsx("h1",{className:"font-bold text-2xl",children:"Depósito"}),e.jsx("p",{className:"text-md",children:"Transforme seus depósitos PIX em momentos instantâneos de alegria e praticidade! Aproveite o bônus especial em cada transação!"}),j&&e.jsx("div",{className:"size-4 -mb-6 border-2 border-black border-t-transparent rounded-full animate-spin"})]}),e.jsxs("form",{onSubmit:w,className:"flex flex-col gap-3 px-2 placeholder:text-sm -mt-8",children:[e.jsx("label",{className:"text-left",htmlFor:"",children:"Nome Completo:"}),e.jsx("input",{type:"text",name:"nome",placeholder:"Nome completo",className:"w-full placeholder:text-sm rounded-lg text-black text-sm",value:a.nome,onChange:n}),e.jsx("label",{className:"text-left",htmlFor:"",children:"CPF:"}),e.jsx("input",{type:"text",name:"cpf",maxLength:11,placeholder:"CPF",className:"w-full placeholder:text-sm rounded-lg text-black text-sm",value:a.cpf,onChange:n}),e.jsx("label",{className:"text-left",htmlFor:"",children:"Valor da transação:"}),e.jsx("input",{type:"text",name:"valor",placeholder:"Valor da transação",className:"w-full placeholder:text-sm rounded-lg text-black text-sm",value:a.valor,onChange:n}),e.jsxs("div",{className:"flex gap-2 w-full mt-2",children:[e.jsxs("button",{type:"button",className:"bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",onClick:()=>r("20"),children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$20",e.jsx("p",{className:"text-xs",children:"Sem bônus"})]}),e.jsxs("button",{type:"button",className:"bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",onClick:()=>r("25"),children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$25",e.jsx("p",{className:"text-xs",children:"Ganhe +R$30"})]}),e.jsxs("button",{type:"button",className:"bg-[#3EB605] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative animate-bigger",onClick:()=>r("30"),children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$30",e.jsx("p",{className:"text-xs",children:"Ganhe +R$50"}),e.jsx("div",{className:"absolute w-full bg-[#7C30F2] -top-4 h-min rounded-t-md text-xs",children:"Mais comprado"})]}),e.jsxs("button",{type:"button",className:"bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",onClick:()=>r("50"),children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"R$50",e.jsx("p",{className:"text-xs",children:"Ganhe +R$100"})]})]}),e.jsxs("button",{type:"submit",className:"bg-[#30B3F2] flex-col shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"Depositar"]})]})]})]}),e.jsx("div",{className:"h-screen bg-[#CD0000] w-full -mt-8",children:e.jsxs("div",{className:"h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto mt-8 rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4",children:[e.jsx("h1",{className:"text-2xl text-center font-bold",children:"INDIQUE UM AMIGO E GANHE R$50 NO PIX"}),e.jsxs("div",{className:"flex flex-col gap-4",children:[e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO FUNCIONA?"}),e.jsx("p",{children:"Convide seus amigos que ainda não estão na plataforma. Você receberá R$50 por cada amigo que se inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso significa que também não há limite para quanto você pode ganhar!"}),e.jsx("h2",{className:"text-xl text-center font-bold",children:"COMO RECEBO O DINHEIRO?"}),e.jsx("p",{children:"O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar via PIX."}),e.jsxs("button",{onClick:()=>c.visit("/afiliados"),className:"bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative",href:"#",children:[e.jsx("div",{className:"clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"}),e.jsx("div",{className:"clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"}),"EU QUERO R$50"]})]})]})}),e.jsxs("footer",{className:"fixed bottom-0 w-full h-12 bg-[#7C30F2]/60 backdrop-blur-sm flex items-center justify-between px-8 text-slate-300",children:[e.jsx(o,{href:"/dashboard",children:e.jsx(C,{})}),e.jsx(o,{href:"/deposito",className:` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  `+(b?" border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]":"border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]"),children:e.jsx(z,{})}),e.jsx(o,{href:"/saque",children:e.jsx(y,{})}),e.jsx(o,{href:"/afiliados",children:e.jsx(F,{})}),e.jsx(o,{href:"/logout",children:e.jsx(k,{})})]}),e.jsx(N,{})]})}export{E as default};
