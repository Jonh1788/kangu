import FooterCuracao from "@/Components/FooterCuracao";
import { Link, router, usePage } from "@inertiajs/react";
import { Banknote, Home, Landmark, LogOut, Users } from "lucide-react";
import { useEffect, useState } from "react";

export default function Dashboard ({auth, token}) {
    const [isNearDiv, setNearDiv] = useState(false);
    useEffect(() => {
        const handleScroll = () => {
            const divFooter = document.getElementById('footerC').getBoundingClientRect().top;
            const triggerDistance = 771;
            setNearDiv(divFooter < triggerDistance);
            console.log(divFooter < triggerDistance)
        }
        
        window.addEventListener('scroll', handleScroll);

        return () => {
            window.removeEventListener('scroll', handleScroll)
        }
    }, [])
    const irParaJogo = (valor) => {
        if(auth.user.saldo < valor){
            router.visit('/deposito')
            return;
        }
        
        var dados = {
            saldo: auth.user.saldo - valor,
            token: token,
            email: auth.user.email
        }

        console.log(dados)
        axios.post('/game', dados).then((response) => {
            window.location.href = '/game?aposta=' + valor 
        
        }).catch((error) => {
            console.log(error)
        }
        )


       
    }


    const [modal, setModal] = useState(false);
    var params = new URLSearchParams(window.location.search);
    var score = params.get('score') || "";
    useEffect(() => {
        if(score){
            setModal(true);
        }
    },[]);

    return(
        <main className="flex-col flex h-max w-screen">
                  {modal && 
            <div id="modal" className="flex items-center justify-center h-screen w-screen absolute inset-0 bg-slate-800/50 z-10">
                <div className="w-[90%] h-max py-4 px-4 bg-white rounded-lg text-slate-900 text-center pt-4 gap-4 flex flex-col border-4 border-slate-400">
                    <h1 className="font-bold">Parabéns!</h1>
                    <p>Você é um verdadeiro campeão e conseguiu ganhar R${score}. Continue jogando para lucrar ainda mais! #ficaadica</p>
                    <button onClick={() => setModal(false)} className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                Continuar
                            </button>
                </div>
            </div>
    }
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <div className="h-screen w-full">
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className="flex items-center pr-8">
                <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                    Saldo: R${auth.user.saldo},00
                </div>
                <button onClick={() => router.visit('/deposito')} className="ml-auto mt-4 bg-slate-400 p-4 rounded-md font-bold text-white hover:bg-slate-600 shadow-md">
                    Depositar
                </button>
            </div>
            <div className="h-[65%] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ">
                <div className="mt-4 -mb-8">
                    <h1 className="font-bold text-xl">Vamos jogar!</h1>
                    <p className="text-sm">Escolha um valor abaixo:</p>
                </div>
                <div className="flex gap-2 px-2">
                    <button onClick={() => irParaJogo(1)} className="bg-[#30B3F2] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    R$1,00
                </button>
                <button onClick={() => irParaJogo(5)} className="bg-[#30B3F2] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    R$5,00
                </button>
               
                </div>

                <div className="flex flex-col gap-2 -mt-8">
                    <h1>Outras opções:</h1>
                    <div className="flex flex-col gap-4 px-2">
                        <p>Jogue com dinheiro real:</p>
                        <button onClick={() => router.visit('/deposito')} className="bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        Depositar
                        </button>
                        <p>Teste o jogo</p>
                        <button onClick={() => window.location.href = "/demo"} className="bg-[#54859D] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        Testar
                        </button>

                        <p>Indique um amigo</p>
                        <button onClick={() => router.visit('/afiliados')} className="bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        R$50 Grátis
                        </button>

                    </div>

                </div>
                
            </div>
            </div>
            <div className="h-screen bg-[#CD0000] w-full -mt-4">
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
            <Link href="/dashboard" className={` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  ` + (isNearDiv ? " border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]" : "border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]")}>
                        <Home />
                    </Link>
                    <Link href="/deposito" >
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
            <FooterCuracao />
        </main>
    )
}