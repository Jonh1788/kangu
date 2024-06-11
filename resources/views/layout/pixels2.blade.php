

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

    .colored-toast {
        height: 55px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        color: #a5dc86 !important;

    }

    .html-toast{
        margin-left: -5px !important;
        display: flex !important;
        align-items: center;
        justify-content: center ;

    }

    .html-toast > p {
        margin-left: 10px;
        margin-bottom: 0;
        line-height: 0;
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



</style>

<script>
        // Lista de nomes de exemplo
    const nomes = ["Ana O.",
  "Pedro S.",
  "Clara C.",
  "Lucas P.",
  "Sofia L.",
  "Enzo R.",
  "Isabella A.",
  "Mateus C.",
  "Valentina S.",
  "Gabriel S.",
  "Laura F.",
  "Matheus R.",
  "Alice M.",
  "João C.",
  "Giovanna L.",
  "Davi S.",
  "Maria O.",
  "Miguel S.",
  "Heloísa C.",
  "Guilherme A.",
  "Manuela P.",
  "Leonardo C.",
  "Lara R.",
  "Bryan M.",
  "Esther R.",
  "Henrique L.",
  "Luísa S.",
  "Daniel C.",
  "Gabriela C.",
  "Samuel P.",
  "Valeria A.",
  "Nicolas R.",
  "Mariana S.",
  "Caio C.",
  "Lívia O.",
  "Heitor S.",
  "Clara F.",
  "Eduardo L.",
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
  "Gustavo A." ];

        // Função para exibir nomes aleatórios com tempo aleatório
        function exibirNomesAleatorios() {
            const nomeAleatorio = nomes[Math.floor(Math.random() * nomes.length)];
            const tempoAleatorio = Math.floor(Math.random() * (5000 - 3000) + 3000); // Entre 3 e 5 segundos
            const tempoAleatorio2 = Math.floor(Math.random() * (3000 - 1000) + 1000); // Entre 3 e 5 segundos
            const valorAleatorio = Math.floor(Math.random() * (200 - 10) + 10)

            Swal.fire({
                toast: true,
                position: "bottom-start",
                showConfirmButton: false,
                timer: tempoAleatorio,
                timerProgressBar: true,
                html: ` <svg class="icone" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
<path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 34.988281 14.988281 A 1.0001 1.0001 0 0 0 34.171875 15.439453 L 23.970703 30.476562 L 16.679688 23.710938 A 1.0001 1.0001 0 1 0 15.320312 25.177734 L 24.316406 33.525391 L 35.828125 16.560547 A 1.0001 1.0001 0 0 0 34.988281 14.988281 z"></path>
</svg> <p><strong>${nomeAleatorio}</strong> ganhou <strong>R$${valorAleatorio},00</strong> </p>`,
                heightAuto: false,
                color:"#000000",
                background: "#a5dc86",
                customClass: {
                    popup: 'colored-toast',
                    htmlContainer: 'html-toast',
                },
            })
            

            // Chama recursivamente para exibir o próximo nome
            setTimeout(exibirNomesAleatorios, tempoAleatorio + tempoAleatorio2);
        }

        // Inicia a exibição inicial
        exibirNomesAleatorios();
    </script>