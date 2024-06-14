import { Link, router, usePage } from "@inertiajs/react";
import { Banknote, Clipboard, Home, Landmark, LogOut, Users } from "lucide-react";
import { useEffect, useState } from "react";
import QRCode from "react-qr-code";

export default function Pix ({ auth }) {
    const app = usePage().props;
    const [pending, setPending] = useState(false);
    const params = new URLSearchParams(window.location.search);
    const pix_key = params.get('pix_key') || "";
    const transactionId = params.get('transactionId') || "";
    const [timer, setTimer] = useState(600);
    const [modal, setModal] = useState(false);
    const [copiado, setCopiado] = useState(false);

    const copiarCodigo = () => {
        navigator.clipboard.writeText(pix_key);
        setCopiado(true);
        setTimeout(() => {
            setCopiado(false);
        }, 2000);
    }
    useEffect(() => {
        const interval = setInterval(() => {
            setTimer(timer - 1);
        }, 1000);
        
        if(timer%10 == 0){
            consultarPagamento();
        }

        if(timer == 0){
            clearInterval(interval);
        }
        return () => clearInterval(interval);
    }, [timer]);

    const consultarPagamento = () => {
        
        axios.get(route('consultaPagamento', {transactionId}))
            .then((response) => {
            if(response.data.message == "Pagamento pendente"){
                
                setPending(true);
                setTimeout(() => {
                    setPending(false);
                }, 2000);
            } else if(response.data.message == "Pagamento aprovado"){
                console.log("confirmado")
                setModal(true);
                setTimeout(() => {
                    router.visit('/dashboard');
                }, 5000);
            }
    })
            .catch((error) => {
                console.error(error);
            });
    }

    return(
        <main className="flex flex-col h-screen w-screen">
            {modal && 
            <div id="modal" className="flex items-center justify-center h-screen w-screen absolute inset-0 bg-slate-800/50 z-10">
                <div className="w-[90%] h-max py-4 px-4 bg-white rounded-lg text-slate-900 text-center pt-4 gap-4 flex flex-col border-4 border-slate-400">
                    <h1 className="font-bold">SUCESSO! Vamos lá?</h1>
                    <p>Caso tenha efetuado o depósito corretamente, seu saldo aparecerá atualizado na próxima página</p>
                    <button onClick={() => router.visit('/dashboard')} className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                Jogar
                            </button>
                </div>
            </div>
    }
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                Saldo: R${auth.user.saldo},00
            </div>
            <div className="h-[70vh] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-2 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16  ">
                <div className="mt-4 mb-2">
                    <h1 className="font-bold text-xl">Bônus de depósito válido por até { `${Math.floor(timer/60)}:${timer%60}` }</h1>
                    <p className="text-sm">Saque instantâneos com PIX</p>
                </div>
                <div className="w-full flex items-center justify-center">
                    <div className="max-w-48 h-14 flex items-center justify-center">
                        <QRCode value={pix_key} />
                    </div>
                </div>
                <div className={"bg-[#30B3F2] mx-2 mt-4 rounded-md py-2 flex items-center justify-center animate-bigger" + (pending ? " bg-[#CD0000]" : "")}>
                    <p>{pending ? "Pagamento Pendente" : "Aguardando pagamento"}</p>
                </div>
                <div  className="px-4 -mt-12 ">
                    <div onClick={copiarCodigo} className="flex items-center justify-center cursor-pointer group">
                        <p>{copiado ? "Copiado": "Código Pix"}</p>
                        <Clipboard className="group-hover:scale-110 transition-all"/>
                    </div>
                    
                    <div  className="text-black text-xs h-12 w-full bg-white break-words overflow-auto">
                        {pix_key}
                    </div>
                    <div onClick={consultarPagamento} className="bg-[#3EB605] mx-2 mt-4 rounded-md py-2 flex items-center justify-center cursor-pointer">
                        <p>Já paguei</p>
                    </div>
                </div>
                
            </div>

            <footer className="fixed bottom-0 w-full h-12 bg-[#7C30F2]/60 backdrop-blur-sm flex items-center justify-between px-8 text-slate-300">
                    <Link href="/dashboard" >
                        <Home />
                    </Link>
                    <Link href="/deposito" className="
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] border-[#CD0000] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5 before:shadow-[0_-10px_0_0_#CD0000] 
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5 after:shadow-[0_-10px_0_0_#CD0000]">
                        <Landmark />
                    </Link>
                    <Link href="/saque" >
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