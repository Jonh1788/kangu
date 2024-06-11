<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">




<!-- Adicione essas linhas ao cabeçalho do seu HTML -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>








    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="Admin Dashboard"
    />
    <meta
      name="description"
      content="Admin Dashboard"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Admin Dashboard</title>
 
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="../assets/images/favicon.png"
    />
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />

  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
  
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="../">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="../assets/images/logo-icon.png "
                  alt="homepage"
                  class="light-logo"
                  width="25"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                <img
                  src="../assets/images/logo-text.png"
                  width="150" height="50"
                  alt="homepage"
                  class="light-logo"
                />
              </span>
           
            </a>
        
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>

          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5">
   
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
            
         
            
            </ul>
          </div>
        </nav>
      </header>
        <!-- ==========    MENU    =================== -->
    
   @extends('layout.aside')
   
<div class="page-wrapper">
    
    
    
    
</div> 
<div class="page-wrapper">
        
      <div class="table-responsive">
      <h5>Escolher intervalo de datas</h5>
        <label for="startDate">Data Inicial:</label>
        <input type="datetime-local" id="startDate">

        <label for="endDate">Data Final:</label>
        <input type="datetime-local" id="endDate">
        <table id="user-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Campanha</th>
              <th>Total Cadastros</th>
              <th>Total depósitos</th>
              <th>Total depósitos p/ data</th>
            </tr>
          </thead>
          <tbody id="table-body">
              
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>

  $(document).ready(function() {
        var data = @json($campanhas);
        var novosDados = @json($resultArray);
        var novoArray = [];
       
        // Iterar sobre as chaves do objeto novosDados
        Object.keys(novosDados).forEach(function(chave) {
            var dados = novosDados[chave];

            // Verificar se dados é um array e se possui pelo menos um elemento
            if (Array.isArray(dados) && dados.length > 0) {
                // Extrair a propriedade 'deposits' do primeiro elemento
                var deposits = dados[0].deposits;

                // Verificar se deposits é um array
                if (Array.isArray(deposits)) {
                    // Criar um objeto com a chave sendo o nome e o valor um array de objetos
                    var novoObjeto = {
                        [chave]: deposits.map(function(deposit) {
                            return { valor: deposit.valor, data: deposit.data };
                        })
                    };

                    // Adicionar o novo objeto ao array
                    novoArray.push(novoObjeto);
                }
            }
        });

                // Objeto para mapear utm_campaign para a soma total dos valores de depósito
        var somaPorCampanha = {};

        // Função para calcular a soma total para cada utm_campaign com base na data do filtro
        function calcularSomaPorCampanha(dataFiltroInicial, dataFiltroFinal) {
            novoArray.forEach(function (objeto) {
                var chave = Object.keys(objeto)[0];
                var deposits = objeto[chave];

                
                if(dataFiltroInicial && dataFiltroFinal){
                  
                  var depositsFiltrados = deposits.filter(function (deposito) {
                      const objetoData = new Date(deposito.data);
                      return objetoData >= dataFiltroInicial && objetoData <= dataFiltroFinal;
                  });
  

                  var somaValores = depositsFiltrados.reduce(function (subtotal, deposito) {
                      return subtotal + parseInt(deposito.valor);
                  }, 0);
                } else {

                  var somaValores = deposits.reduce(function (subtotal, deposito) {
                      return subtotal + parseInt(deposito.valor);
                  }, 0);

                }

                somaPorCampanha[chave] = somaValores;
                
            });
        }

        // Função para criar as linhas da tabela com base na data do filtro
        function criarLinhasTabela(dadoOriginal, dataFiltroInicial, dataFiltroFinal) {
            $('#table-body').empty();

            if(dataFiltroInicial instanceof Date && dataFiltroFinal instanceof Date){
                dadoOriginal.forEach(function (row) {
                  var utmCampaign = row.utm_campaign.toLowerCase();
                  var totalDepositos = somaPorCampanha[utmCampaign] || 0;
                  if(dataFiltroInicial && dataFiltroFinal && totalDepositos > 0){
                      var newRow = "<tr>" +
                          "<td>" + utmCampaign + "</td>" +
                          "<td>" + row.total_cadastros + "</td>" +
                          "<td>R$" + row.total_deposito + "</td>" +
                          "<td>R$" + totalDepositos + "</td>" +
                          "</tr>";
                      $('#table-body').append(newRow);
                  }
              });
            } else {
              dadoOriginal.forEach(function (row) {
                var utmCampaign = row.utm_campaign.toLowerCase();
                var totalDepositos = somaPorCampanha[utmCampaign] || 0;
                    var newRow = "<tr>" +
                        "<td>" + utmCampaign + "</td>" +
                        "<td>" + row.total_cadastros + "</td>" +
                        "<td>R$" + row.total_deposito + "</td>" +
                        "<td>R$" + totalDepositos + "</td>" +
                        "</tr>";
    
                    $('#table-body').append(newRow);
                
            });
            }

            
        }        

        
        


        $('#startDate, #endDate').on('change', function () {

            var startDate = new Date($('#startDate').val());
            var endDate = new Date($('#endDate').val());
            
            calcularSomaPorCampanha(startDate, endDate);
            criarLinhasTabela(data, startDate, endDate);

        })
        var table = $('#user-table').DataTable();
        calcularSomaPorCampanha(null, null);

        criarLinhasTabela(data, startDate, endDate);
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <footer class="footer text-center">
         Melhorado por 
         <p>Jonathan Santos</p>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    </script>
  </body>
</html>
