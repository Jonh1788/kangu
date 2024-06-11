

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    body{
        font-family: 'Space Mono', sans-serif !important;
    }
    .colored-toast {
        height: 55px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        color: #a5dc86 !important;
        width: auto !important;
        height: auto !important;

    }

    .html-toast{
        margin-left: -5px !important;
        display: flex !important;
        align-items: center;
        justify-content: center ;
        width: auto !important;
        height: auto !important;
    }

    .html-toast > div {
        display: flex;
        align-items: center;
        justify-content: center;
        width: auto !important;
        height: auto !important;
    }

    .html-toast > svg {
        height: 30px;
        width: 30px;
        
    }
    .html-toast > p {
        margin-left: 10px;
        margin-bottom: 0;
        line-height: 1rem;
    }

    .colored-toast.swal2-icon {
        width: 10px;
    }
    .colored-toast.swal2-icon-success {
  background-color: #a5dc86 !important;
}

    .swal2-success-line-long{
        background-color: #000000 !important;
    }

    .swal2-success-line-tip{
        background-color: #000000 !important;
    }

    .swal2-success-ring{
        border: .25em solid rgba(0, 0, 0, 0.25) !important;
    }

    .swal2-success {
        border: .25em solid rgba(0, 0, 0, 0.01) !important;
    }
.colored-toast .swal2-title {
  color: #000000;
}

.colored-toast .swal2-close {
  color: #000000;
}

.colored-toast .swal2-html-container {
  color: #000000;
}

.icone {
    height: 30px;
    width: 30px;
}

.toast-container{
    background-color: #000000 !important;
}

.toast-progress{
    background-color: #a5dc86 !important;
}

</style>

<script>

    var pause = false;
    let timeoutId;
        // Lista de nomes de exemplo
    const nomes = 
["Ana O.",
  "Pedro S.",
  "Clara C.",
  "Lucas P.",
  "Sofia L.",
  "Enzo R.",
  "Mateus C.",
  "Gabriel S.",
  "Laura F.",
  "Matheus R.",
  "Alice M.",
  "João C.",
  "Davi S.",
  "Maria O.",
  "Miguel S.",
  "Heloísa C.",
  "Lara R.",
  "Bryan M.",
  "Esther R.",
  "Luísa S.",
  "Daniel C.",
  "Samuel P.",
  "Valeria A.",
  "Nicolas R.",
  "Caio C.",
  "Lívia O.",
  "Heitor S.",
  "Clara F.",
  "Isabel S.",
  "Felipe A.",
  "Ana P.",
  "Bruno C.",
  "Sophia R.",
  "Isaac M.",
  "Beatriz R.",
  "Enzo L.",
  "Yasmin C.",
  "Lucas S.",
  "Isabela C.",
  "Aline L." ];

        // Função para exibir nomes aleatórios com tempo aleatório
        function exibirNomesAleatorios() {
            const nomeAleatorio = nomes[Math.floor(Math.random() * nomes.length)];
            const tempoAleatorio = Math.floor(Math.random() * (10000 - 8000) + 8000); // Entre 3 e 5 segundos
            const tempoAleatorio2 = Math.floor(Math.random() * (3000 - 1000) + 1000); // Entre 3 e 5 segundos
            const valorAleatorio = Math.floor(Math.random() * (200 - 10) + 10)
            const mensagem1 = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#016a13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg> <p><strong>${nomeAleatorio}</strong> acaba de ganhar <strong>R$${valorAleatorio},00</strong> no jogo da fruta </p></div`
            const mensagem2 = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#016a13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg> <p><strong>${nomeAleatorio}</strong> realizou um saque de <strong>R$${valorAleatorio},00</strong> </p>`
            //escolher aleatoria entre mensagem1 e mensagem2
            const escolha = Math.floor(Math.random() * 2);

            Swal.fire({
                toast: true,
                position: "bottom-start",
                showConfirmButton: false,
                timer: tempoAleatorio - 2000,
                timerProgressBar: true,
                html: escolha == 0 ? mensagem1 : mensagem2,
                color:"#000000",
                background: "#fff",
                customClass: {
                    popup: 'colored-toast',
                    htmlContainer: 'html-toast',
                    timerProgressBar: 'toast-progress',
            
                },
            })
            
        
                timeoutId = setTimeout(exibirNomesAleatorios, tempoAleatorio + tempoAleatorio2);
        }

        window.addEventListener('load', exibirNomesAleatorios);        
        
        
    </script>