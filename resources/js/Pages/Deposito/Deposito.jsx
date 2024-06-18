import React, { useEffect, useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { Banknote, Home, Landmark, LogOut, Users } from 'lucide-react';
import FooterCuracao from '@/Components/FooterCuracao';

function verifyCpf(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf === '') return false;
    // Elimina CPFs invalidos conhecidos
    if (
        cpf.length !== 11 ||
        cpf === '00000000000' ||
        cpf === '11111111111' ||
        cpf === '22222222222' ||
        cpf === '33333333333' ||
        cpf === '44444444444' ||
        cpf === '55555555555' ||
        cpf === '66666666666' ||
        cpf === '77777777777' ||
        cpf === '88888888888' ||
        cpf === '99999999999'
    )
        return false;
    // Valida 1o digito
    let add = 0;
    for (let i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
    let rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) rev = 0;
    if (rev !== parseInt(cpf.charAt(9))) return false;
    // Valida 2o digito
    add = 0;
    for (let i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) rev = 0;
    if (rev !== parseInt(cpf.charAt(10))) return false;
    return true;
}

export default function Deposito({auth}) {
    const [isNearDiv, setNearDiv] = useState(false);
    const [modal, setModal] = useState(false);
    const [erroCpf, setErroCpf] = useState(false);
    var params = new URLSearchParams(window.location.search);
    var score = params.get('score') || "";
    useEffect(() => {
        if(score){
            setModal(true);
        }
        const handleScroll = () => {
            const divFooter = document.getElementById('footerC').getBoundingClientRect().top;
            const triggerDistance = 771;
            setNearDiv(divFooter < triggerDistance);
            
        }
        
        window.addEventListener('scroll', handleScroll);

        return () => {
            window.removeEventListener('scroll', handleScroll)
        }
    }, [])
    const { props } = usePage();
    const [loading, setLoading] = useState(false);
    const [formData, setFormData] = useState({
        nome: '',
        cpf: '',
        valor: ''
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleChangeCPF = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });

        if(e.target.value.length == 11){
            e.target.value = e.target.value.replace(/\D/g, ''); 
            console.log(e.target.value);
            setFormData({
                ...formData,
                [e.target.name]: e.target.value
            });
            
            if(verifyCpf(e.target.value)){
                return;    
        }  else {

            setErroCpf(true);
    
            setTimeout(() => {
                setErroCpf(false);
            }, 2000);
        }
    }
      
    
    }

    const handleDeposito = (e) => {
        setLoading(true);
        e.preventDefault();
        axios.post('/depositar', formData)
            .then((response) => {
                router.visit(route('pix', {pix_key: response.data.pix_key, transactionId: response.data.transactionId}));
                setFormData({
                    nome: '',
                    cpf: '',
                    valor: ''
                });
            })
            .catch((error) => {
                alert('Erro ao realizar depósito!');
                console.error(error);
            })
            .finally(()=>{
                setLoading(false);
            
            })
    };

    const handleQuickSelect = (valor) => {
        setFormData({
            ...formData,
            valor
        });
    };



    return (
        <main className='h-max w-screen flex flex-col'>
                    {modal && 
            <div id="modal" className="flex items-center justify-center h-screen w-screen absolute inset-0 bg-slate-800/50 z-10">
                <div className="w-[90%] h-max py-4 px-4 bg-white rounded-lg text-slate-900 text-center pt-4 gap-4 flex flex-col border-4 border-slate-400">
                    <h1 className="font-bold">Parabéns!</h1>
                    <p>Parabéns você chegou a ter R${score} em saldo! Realize o depósito para ter ganhos reais!</p>
                    <button onClick={() => setModal(false)} className="bg-[#FF8A00] shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative" href="#">
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0"/>
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8"/>
                                Depositar
                            </button>
                </div>
            </div>
    }
            <div className="bg-gradient-to-b from-[#7C30F2] to-[#CD0000] absolute inset-0 -z-[10]"></div>
            <img src="/background-2.png" alt="" className="absolute inset-0 object-cover w-full h-full -z-[9]" />
            <div className='h-screen w-full'>
                <div className="flex items-center pr-4">
                    <div className="bg-[#F29B30] w-max mt-4 py-2 pr-4 rounded-r-md text-white font-bold">
                        Saldo: R${auth.user.saldo},00
                    </div>
                    <button onClick={() => router.visit('/dashboard')} className="ml-auto mt-4 bg-slate-400 p-4 rounded-md mr-2 font-bold text-white hover:bg-slate-600 shadow-md">
                        Jogar
                    </button>
                </div>

                <div className="h-max pb-4 w-[90vw] bg-[#7C30F2]/60 mx-auto mt-8 rounded-lg backdrop-blur-sm text-white text-center flex flex-col gap-16 ">
                    <div className="mt-4 flex flex-col items-center">
                        <h1 className="font-bold text-2xl">Depósito</h1>
                        <p className="text-md">
                            Transforme seus depósitos PIX em momentos instantâneos de alegria e praticidade! Aproveite o bônus especial em cada transação!
                        </p>
                        {loading && <div className='size-4 -mb-6 border-2 border-black border-t-transparent rounded-full animate-spin'/>}
                    </div>
                    
                    <form onSubmit={handleDeposito} className="flex flex-col gap-3 px-2 placeholder:text-sm -mt-8">
                        <label className='text-left' htmlFor="">Nome Completo:</label>
                        <input 
                            type="text" 
                            name="nome"
                            placeholder="Nome completo" 
                            className="w-full placeholder:text-sm rounded-lg text-black text-sm"
                            value={formData.nome}
                            onChange={handleChange}
                        />
                        <label className='text-left' htmlFor="">CPF:</label>
                        <input 
                            type="number" 
                            name="cpf"
                            maxLength={16}
                            placeholder="CPF" 
                            className="w-full placeholder:text-sm rounded-lg text-black text-sm"
                            value={formData.cpf}
                            onChange={handleChangeCPF}
                        />
                        {erroCpf && <p className="text-red-500 text-xs">CPF inválido</p>}
                        <label className='text-left' htmlFor="">Valor da transação:</label>
                        <input 
                            type="number"
                            min={20}
                            name="valor"
                            placeholder="Valor da transação" 
                            className="w-full placeholder:text-sm rounded-lg text-black text-sm"
                            value={formData.valor}
                            onChange={handleChange}
                        />
                        <div className="flex gap-2 w-full mt-2">
                            <button 
                                type="button" 
                                className="bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative"
                                onClick={() => handleQuickSelect('20')}
                            >
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0" />
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8" />
                                R$20
                                <p className="text-xs">Sem bônus</p>
                            </button>

                            <button 
                                type="button" 
                                className="bg-[#3EB605] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative animate-bigger"
                                onClick={() => handleQuickSelect('30')}
                            >
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0" />
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8" />
                                R$25
                                <p className="text-xs">Ganhe +R$30</p>
                                <div className="absolute w-full bg-[#7C30F2] -top-4 h-min rounded-t-md text-xs">
                                    Mais comprado
                                </div>
                            </button>

                            <button 
                                type="button" 
                                className="bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative"
                                onClick={() => handleQuickSelect('25')}
                            >
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0" />
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8" />
                                R$30
                                <p className="text-xs">Ganhe +R$50</p>
                            </button>


                            <button 
                                type="button" 
                                className="bg-[#FF8A00] flex-col shadowPersonalizado h-20 w-full rounded-2xl flex items-center justify-center font-bold text-white relative"
                                onClick={() => handleQuickSelect('50')}
                            >
                                <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0" />
                                <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8" />
                                R$50
                                <p className="text-xs">Ganhe +R$100</p>
                            </button>
                        </div>
                        <button type="submit" className="bg-[#30B3F2] flex-col shadowPersonalizado h-12 w-full rounded-2xl flex items-center justify-center font-bold text-white relative">
                            <div className="clip1 size-8 bg-white/30 absolute left-0 rotate-45 top-0" />
                            <div className="clip2 size-3 bg-white/30 absolute left-1 rotate-45 top-8" />
                            Depositar
                        </button>
                    </form>
                </div>

            </div>

            <div className="h-screen bg-[#CD0000] w-full -mt-8">
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
                <Link href="/dashboard">
                    <Home />
                </Link>
                <Link href="/deposito" className={` ease-in-out duration-300
                    rounded-full bg-[#7C30F2]/60 backdrop-blur-sm border-[4px] p-2 -translate-y-6 
                    before:absolute before:bg-transparent before:size-4 before:-left-5 
                    before:rounded-tr-[70%] before:top-5
                    after:absolute after:bg-transparent after:size-4 after:-right-5 
                    after:rounded-tl-[70%] after:top-5  ` + (isNearDiv ? " border-slate-950 before:shadow-[0_-10px_0_0_#020617] after:shadow-[0_-10px_0_0_#020617]" : "border-[#CD0000] before:shadow-[0_-10px_0_0_#CD0000] after:shadow-[0_-10px_0_0_#CD0000]")}>
                    <Landmark />
                </Link>
                <Link href="/saque">
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
    );
}
