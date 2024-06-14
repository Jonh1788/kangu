import FooterCuracao from "@/Components/FooterCuracao";
import { Link, router, usePage } from "@inertiajs/react";
import { Banknote, Copy, Home, Landmark, LogOut, Users } from "lucide-react";
import { useEffect, useState } from "react";

export default function Afiliado ({auth}) {
    const app = usePage().props; 
    const [isNearDiv, setNearDiv] = useState(false);
    const [copiado, setCopiado] = useState(false);
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

    const copiarCodigo = () => {
        navigator.clipboard.writeText(auth.user.linkafiliado);
        setCopiado(true);
        setTimeout(() => {
            setCopiado(false);
        }, 2000);
    }

    return(
        <main className="flex flex-col h-max w-screen">
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />

            <div className="h-screen w-full">
                <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                    Saldo: R${auth.user.saldo},00
                </div>


                <div className="h-[65%] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ">
                    <div className="mt-4">
                        <h1 className="font-bold text-2xl">BÔNUS DE INDICAÇÃO!</h1>
                        <p className="text-md">Ganhe instantaneamente R$50 por pessoa convidada que depósitar no minimo R$20</p>
                        <p className="text-md mt-2">Seu link de indicação é: <span className="font-bold">{auth.user.linkafiliado}</span></p>
                        <button onClick={copiarCodigo} className="underline w-full flex items-center justify-center gap-2 my-2">{!copiado ? "Copiar link" : "Copiado"}  <Copy /></button>
                    </div>
                    
                    <div className="flex flex-col text-left px-2 -mt-16">
                        <h1 className="font-bold">Estatisticas</h1>
                        <div className="">
                            <h1 className="text-md">Saldo disponivel:R$0,00</h1>
                        </div>

                        <div className="flex w-full h-full border border-black rounded-md mt-2 flex-nowrap text-xs divide-x divide-black">
                            <div className="flex-1 pl-2">
                                <table className="h-48">
                                        <tr>
                                            <td>Ganho Total</td>
                                            <td>R$</td>
                                        </tr>
                                        <tr>
                                            <td>Recorrência</td>
                                            <td>R$</td>
                                        </tr>
                                        <tr>
                                            <td>Cadastros</td>
                                            <td>0</td>
                                        </tr>   
                                        <tr>
                                        <button onClick={() => router.visit("/saque")} className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative">
                                            <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                            <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                            Saque convidado
                                        </button>
                                        </tr>
                                </table>
                            
                            </div>
                            <div className="flex-1 pl-2">
                            <table className="h-48">
                                
                                        <tr>
                                            <td>Depositantes</td>
                                            <td>R$</td>
                                        </tr>
                                        <tr>
                                            <td>Valor indicação</td>
                                            <td>R$50</td>
                                        </tr>
                                        <tr>
                                            <td>Recorrência</td>
                                            <td>%</td>
                                        </tr>
                                        <tr>
                                        <button onClick={() => router.visit('/dashboard')} className="bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                                            <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                            <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                            Jogar
                                        </button>
                                        </tr>
                                </table>
                                
                            </div>

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
            <Link href="/dashboard" >
                        <Home />
                    </Link>
                    <Link href="/deposito" >
                        <Landmark />
                    </Link>
                    <Link href="/saque">
                        <Banknote />
                    </Link>
                    <Link href="/afiliados" className={` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  ` + (isNearDiv ? " border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]" : "border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]")}>
                        <Users />
                    </Link>
                    <Link href="/logout">
                        <LogOut />
                    </Link>     
            </footer>
            <FooterCuracao />
        </ main>
    )
}