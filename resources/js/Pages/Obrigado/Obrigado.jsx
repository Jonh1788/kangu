import { router } from "@inertiajs/react";

export default function Obrigado() {
    return(
        <main className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] h-screen w-screen flex flex-col">
            <div className="">
                <div className="h-min w-[90vw] border-4 shadow-lg border-black bg-white mx-auto rounded-lg backdrop-blur-sm text-black text-center flex flex-col gap-4 p-4">
                    <h1 className="text-2xl text-center font-bold">Sucesso!</h1>
                    <h1 className="text-2xl text-center font-bold">Vamos pular?</h1>
                    <div className="flex flex-col gap-4">
                        <p className="text-green-500">Caso tenha efetuado o depósito corretamente, seu saldo aparecerá atualizado na próxima página</p>
                        <div className="font-bold">
                            <p>⚠️ Não caia das plataformas</p>
                            <p>❌ Evite os monstros de areia</p>
                            <p>✅ Saque imediatamente!</p>
                        </div>

                        <p>Clique no botão abaixo</p>
                        <button onClick={() => window.location.href = "/dashboard"} className="bg-[#CD0000] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                        <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                        <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                        Jogar
                        </button>
                    </div>
                </div>
            </div>
        </main>
    )
}