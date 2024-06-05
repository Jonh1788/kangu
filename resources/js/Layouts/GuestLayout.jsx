import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    return (
        <main className="h-screen border-8 border-yellow-400 bg-sandbrick flex flex-col items-center justify-center gap-8">
            <div className="border border-black nes-container is-rounded bg-white/60 text-center">
                <h1 className="text-2xl font-bold text-black">Você está a um passo de se juntar a nós</h1>
                <div className="flex items-center justify-center">
                    <p>Complete seu cadastro!
                    </p>
                    <img src="/KangJumping.gif" alt=""  className="size-8" />
                    
                </div>

            </div>
            <div className="bg-white/60 nes-container is-rounded">
                {children}
            </div>
        </main>
    );
}
