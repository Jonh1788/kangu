import { usePage } from "@inertiajs/react";

export default function Login () {
    const {errors} = usePage().props;
    console.log(errors);    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    return(
        <main className="flex flex-col justify-center items-center px-4">
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10] w-screen h-screen"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-screen h-screen -z-[9]" />
            <div className="w-full h-full flex items-center justify-center">
                <img src="/KanguPixLogo.png" alt="" className="w-[80%]"/>
            </div>

            <div className="h-full py-12 w-full bg-[#7C30F2]/60 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ">
                <div className="">
                    <h1 className="font-bold text-xl">Login</h1>
                    <p className="text-sm">Que bom ter você aqui, vamos lá!</p>
                </div>
                {errors.email && <p className="text-red-500 text-sm -mt-12 -mb-8">{errors.email}</p>}
                <form action="/login" method="post" className="flex flex-col gap-3 px-2 placeholder:text-sm mt-">
                    <input type="hidden" name="_token" value={csrfToken}/>
                    <input name="email" type="text" placeholder="Email" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <input name="senha" type="password" placeholder="Senha" className="w-full placeholder:text-sm rounded-lg text-black text-sm"/>
                    <button className="bg-[#3EB605] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                    <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                    <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                    Login
                </button>
                </form>
            </div>
        </main>
    )
}