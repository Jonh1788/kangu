import { Link, router, usePage } from "@inertiajs/react";
import { Banknote, Home, Landmark, LogOut, Users } from "lucide-react";
import { useState } from "react";

export default function Saque ({auth}) {
    const [modal, setModal] = useState(false);
    const [text, setText] = useState('');
    const [title, setTitle] = useState('');
    const [buttonText, setButtonText] = useState('');
    const [link, setLink] = useState('');
    const [error, setError] = useState('');

    const setModal2 = (title, text, link, buttonText) => {
        setTitle(title);
        setText(text);
        setLink(link);
        setButtonText(buttonText);
        setModal(true);
    }
    const processarForm = () => {

        var saldo = auth.user.saldo;
        var depositou = auth.user.depositos;
        
        
        if(saldo <= 0){
          setError("Saldo insuficiente, deposite para começar a lucrar");
          return false;
        }
    
        if(depositou > 1 && depositou  < 48){
          const result = setModal2('ATIVE SEU SAQUE', 'Para liberar o recurso de saque, você precisa ter acumulado R$50 em depositos em sua conta! Faça o depósito para liberar a função automaticamente e ter saques ilimitados.', '/deposito', 'DEPOSITAR');
          return false;
        }
    
        if(depositou >= 49 && depositou  <= 99){

          const result = setModal2('SAQUE PENDENTE', 'Você precisa ter feito um deposito de R$50 em sua conta! Lembrando que precisa ser 1 único no valor R$50. A função saque e liberada automaticamente apôs o deposito', '/deposito', 'ATIVAR AGORA');
          return false;
        }
    
        if(depositou >= 100){
          const result = setModal2('SAQUE SOLICITADO', 'Estamos em alta demanda e o seu saque vai cair dentro de 72h. Indique um amigo e ganhe R$50 por convidado', '/afiliados', 'INDICAR');
          return false;
        }
    
        return false;
    }

    return(
        <main>

{modal && 
            <div id="modal" className="flex items-center justify-center h-screen w-screen absolute inset-0 bg-slate-800/50 z-10">
                <div className="w-[90%] h-max py-4 px-4 bg-white rounded-lg text-slate-900 text-center pt-4 gap-4 flex flex-col border-4 border-slate-400">
                    <h1 className="font-bold">{title}</h1>
                    <p>{text}</p>
                    <button onClick={() => router.visit(link)} className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                {buttonText}
                            </button>
                </div>
            </div>
    }
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className="h-screen w-full">
                <div className="flex items-center">
                    <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                        Saldo: R${auth.user.saldo},00
                    </div>
                    <button onClick={() => router.visit('/dashboard')} className="ml-auto mt-4 bg-slate-400 p-4 rounded-md mr-2 font-bold text-white hover:bg-slate-600 shadow-md">
                        Jogar
                    </button>
                </div>

                <div className="h-[70vh] pb-4 w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ">
                    <div className="mt-4">
                        <h1 className="font-bold text-2xl">Saque</h1>
                        <p className="text-md">Saque instantâneos com PIX</p>
                    </div>
                    
                    <form action="" className="flex flex-col gap-3 px-2 placeholder:text-sm -mt-8">
                        <label className='text-left' htmlFor="">Nome do destinatário:</label>
                        <input type="text" placeholder="Nome do destinatário" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                        <label className='text-left' htmlFor="">Chave pix cpf:</label>
                        <input type="text" placeholder="Chave pix cpf" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                        <label className='text-left' htmlFor="">Valor para saque: (Saldo disponivel: R${auth.user.saldo},00)</label>
                        <input type="text" placeholder="Valor para saque" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    
                        <button onClick={processarForm} type="button" className="bg-[#30B3F2] flex-col shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                            <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                            <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                            Sacar
                            </button>
                    </form>
                    
                    
                </div>

            </div>

            <div className="h-screen bg-[#CD0000] w-full -mt-8">
                <div className="h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto mt-8 rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4">
                    <h1 className="text-2xl text-center font-bold">INDIQUE UM AMIGO E GANHE R$50 NO PIX</h1>
                    <div className="flex flex-col gap-4">
                        <h2 className="text-xl text-center font-bold">COMO FUNCIONA?</h2>
                        <p>Convide seus amigos que ainda não estão na plataforma. Você receberá R$50 por cada amigo que se inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso significa que também não há limite para quanto você pode ganhar!</p>
                        <h2 className="text-xl text-center font-bold">COMO RECEBO O DINHEIRO?</h2>
                        <p>O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar via PIX.</p>
                        <button onClick={() => router.visit('/afiliados')} className="bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        EU QUERO R$50
                        </button>
                    </div>
                </div>
            </div>
            <footer className="fixed bottom-0 w-full h-12 bg-[#7C30F2]/60 backdrop-blur-sm flex items-center justify-between px-8 text-slate-300">
            <Link href="/dashboard" >
                        <Home />
                    </Link>
                    <Link href="/deposito" >
                        <Landmark />
                    </Link>
                    <Link href="/saque" className="
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] border-[#CD0000] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5 before:shadow-[0_-10px_0_0_#CD0000] 
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5 after:shadow-[0_-10px_0_0_#CD0000]">
                        <Banknote />
                    </Link>
                    <Link href="/afiliados">
                        <Users />
                    </Link>
                    <Link href="/logout">
                        <LogOut />
                    </Link>     
            </footer>
        </ main>
    )
}