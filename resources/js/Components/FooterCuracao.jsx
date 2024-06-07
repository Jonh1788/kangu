import { Link } from "@inertiajs/react";


export default function FooterCuracao(){
    return (
        <div id="footerC" className="w-full h-64 bg-slate-950 flex flex-col pt-6 items-center gap-4">
            <h1 className="text-white text-4xl font-bold">KanguPix</h1>
            <div className="flex flex-col items-center text-white gap-2">
                <p>Todos os direitos reservados.</p>
                <Link href="/termos" className="text-white font-semibold">Termos de uso</Link>
                <img src="/gaming-curacao.png" alt="" className="h-10"/>
            </div>
        </div>
    )
}