import { router } from "@inertiajs/react";

export default function Presell() {
    return(
        <main className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] h-screen w-screen flex flex-col">
              <div className="flex items-center pr-8 mb-12">
                <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                    Saldo: R$10,00
                </div>
            </div>
            <div className="">
                <div className="h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4">
                    <h1 className="text-2xl text-center font-bold">HORA DE PULAR</h1>
                    <div className="flex flex-col gap-4">
                        <p>Pronto para faturar pulando por ai? Colete dinheiro nas plataformas!</p>
                        <div className="font-bold">
                            <p>⚠️ Não caia das plataformas</p>
                            <p>❌ Evite os monstros de areia</p>
                            <p>✅ Saque imediatamente!</p>
                        </div>

                        <p>Você tem 2 tentativas!</p>
                        <button onClick={() => window.location.href = "/demo"} className="bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        Iniciar Jogo
                        </button>
                    </div>
                </div>
            </div>
        </main>
    )
}