import { usePage } from "@inertiajs/react";

export default function Cadastro () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const { errors } = usePage().props;
    var params = new URLSearchParams(window.location.search);
    var id = params.get('id') || "";
    console.log(errors);
    return(
        <main>
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className="px-4">
                <img src="/KanguPixLogo.png" alt=""/>
            </div>

            <div className="h-[70vh] w-[90vw] bg-[#7C30F2]/60 mx-auto mt-2 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-2">
                <h1 className="font-bold text-xl">Cadastre-se</h1>
                <p className="text-sm">Parabéns por ter chegado até aqui, falta pouco pra vir lucrar com a gente!</p>
                {errors.email && <p className="text-red-500 text-sm">{errors.email}</p>}
                <form action="/cadastrar" method="post" className="flex flex-col gap-3 px-2 placeholder:text-sm mt-">
                    <input name="_token" type="hidden" value={csrfToken}/>
                    <input name="afiliado" type="hidden" value={id}/>
                    <input name="nome" type="text" placeholder="Nome" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <input name="email" type="email" placeholder="Email" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <input name="telefone" type="text" placeholder="Celular" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <input type="password" placeholder="Senha" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <input name="senha" type="password" placeholder="Confirme a senha" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <button type="submit" className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    Cadastrar
                </button>
                </form>
            </div>
        </main>
    )
}