import { Link } from "@inertiajs/react"

export default function Welcome(){
    return(
        <main className="h-min flex flex-col items-center justify-between py-12 gap-8 font-space">
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className="px-4">
                <img src="/KanguPixLogo.png" alt=""/>
            </div>
            <div className="w-full flex flex-col items-center justify-center text-center px-12 gap-4 text-lg">
                
                <Link href="/cadastrar" className="bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    Cadastro
                </Link>
                
                <Link className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="/login">
                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    Login
                </Link>
                <Link className="bg-[#EEE501] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    Teste
                </Link>
            </div>
        </main>
    )
}