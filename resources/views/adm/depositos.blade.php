<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


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
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tabela de Depósitos</h5>
      <!-- Column -->
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white" id="valorUsuarios1">0</h1>
                        <h4 class="text-white">Nº de Depósitos Concluídos</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white" id="valorUsuarios2">0</h1>
                        <h4 class="text-white">Nº Total de Depósitos Na Data Selecionada</h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white" id="valorUsuarios5">0</h1>
                        <h4 class="text-white">Valor Total Depositado</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white" id="valorUsuarios6">0</h1>
                        <h4 class="text-white">Valor Total Depositado Na Data Selecionada</h4>
                    </div>
                </div>
            </div>
        </div>



           
            <div class="row">
    <div class="col-md-12 mb-3">
        <button class="btn btn-success" id="exportCsvBtn">Exportar CSV</button>
    </div>
</div>


<script>
function escapeCsvValue(value) {
    // Se o valor contiver vírgulas, aspas ou quebras de linha, envolva-o entre aspas
    if (/[",\n\r]/.test(value)) {
        return '"' + value.replace(/"/g, '""') + '"';
    }
    return value;
}

$('#exportCsvBtn').on('click', function () {
    exportTable('user-table', 'user-table.csv', ';', true);
});

$('#exportExcelBtn').on('click', function () {
    exportTable('user-table', 'user-table.xlsx', ',', true);
});

function exportTable(tableId, filename, delimiter, excludeEditColumn) {
    var data = [];
    var headers = [];

    // Adicione os cabeçalhos da tabela
    $('#' + tableId + ' thead th').each(function () {
        // Exclua a coluna de edição se necessário
        if (excludeEditColumn && $(this).text().trim().toLowerCase() === 'editar') {
            return;
        }
        headers.push(escapeCsvValue($(this).text().trim()));
    });
    data.push(headers);

    // Use a API do DataTables para obter todos os dados
    var table = $('#' + tableId).DataTable();
    table.rows().data().each(function (row) {
        var rowData = [];

        row.forEach(function (value, index) {
            // Exclua a coluna de edição se necessário
            if (excludeEditColumn && $('#' + tableId + ' thead th').eq(index).text().trim().toLowerCase() === 'editar') {
                return;
            }
            rowData.push(escapeCsvValue(value));
        });

        data.push(rowData);
    });

    // Crie uma planilha em formato CSV ou Excel, dependendo da extensão do arquivo
    if (filename.endsWith('.csv')) {
        var csvContent = data.map(row => row.join(delimiter)).join('\n');
        var blob = new Blob(["\ufeff" + csvContent], { type: 'text/csv;charset=utf-8;' });
        saveFile(blob, filename);
    } else if (filename.endsWith('.xlsx')) {
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        var blob = XLSX.write(wb, { bookType: 'xlsx', type: 'blob' });
        saveFile(blob, filename);
    }
}

function saveFile(blob, filename) {
    var link = document.createElement('a');
    if (link.download !== undefined) {
        var url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}
</script>




        
      <div class="table-responsive">
        <h5>Filtrar por status</h5>
        <select id="selectedStatus">
            <option value="Todos">Todos</option>
            <option value="PAID_OUT">Aprovado</option>
            <option value="WAITING_FOR_APPROVAL">Pendente</option>
        </select>
        <h5>Escolher intervalo de datas</h5>
        <label for="startDate">Data Inicial:</label>
        <input type="datetime-local" id="startDate">

        <label for="endDate">Data Final:</label>
        <input type="datetime-local" id="endDate">
        <table id="user-table" class="table table-striped table-bordered">
          <thead>
            <tr>
            <th>Data / Hora</th>
              <th>Email</th>
              <th>Cod. Referencia</th>
              <th>Valor</th>
              <th>Status</th>
               
             
            </tr>
          </thead>
          <tbody id="table-body">
            <!-- Dados da tabela serão inseridos aqui -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>

      $(document).ready(function() {

        var depositosN = @json($depositosRealizados);
        $("#valorUsuarios5").text('R$' +
            depositosN.reduce((acumulador, objeto) => {

                if(objeto.status == 'PAID_OUT'){
                    
                    return acumulador + parseFloat(objeto.valor);
                }

                return acumulador
            }, 0)
        );

        $("#valorUsuarios1").text( depositosN.reduce((acumulador, objeto) => {

                if(objeto.status == 'PAID_OUT'){
                    
                    return acumulador + 1;
                }

                return acumulador
                }, 0));
      })

    function filtrarDepositosPorData(depositosN, startDate, endDate) {
            
            function extrairData(dataString){
            return new Date(dataString);
            }
            startDate.setDate(startDate.getDate()+1)
            endDate.setDate(endDate.getDate()+1)
            return depositosN.filter((objeto) => extrairData(objeto.created_at) >= startDate && extrairData(objeto.created_at) <= endDate)

    }

     $(document).ready(function () {
        $('#startDate, #endDate').on('change', function () {

            var startDate = new Date($('#startDate').val());
            var endDate = new Date($('#endDate').val());
            var selectedStatus = $("#selectedStatus").val();
            var depositosN = @json($depositosRealizados);
            var valor = 0;
            var depositos = filtrarDepositosPorData(depositosN, startDate, endDate);
            var somaTotal = depositos.reduce((acumulador, objeto) => {

                const status = objeto.status;
                acumulador[status] = (acumulador[status] || 0) + parseFloat(objeto.valor);
                return acumulador;

            }, {})

            var somaTotalValores = depositos.reduce((acumulador, objeto) => {

                const status = objeto.status;
                acumulador[status] = (acumulador[status] || 0) + 1;
                return acumulador;

                }, {})

            var aprovados = parseFloat(somaTotal['PAID_OUT'] || 0);
            var aguardando = parseFloat(somaTotal['WAITING_FOR_APPROVAL'] || 0)
            
            var aprovadosContagem = parseFloat(somaTotalValores['PAID_OUT'] || 0);
            var aguardandoContagem = parseFloat(somaTotalValores['WAITING_FOR_APPROVAL'] || 0)

            switch(selectedStatus){
                case "WAITING_FOR_APPROVAL":
                    $("#valorUsuarios6").text('R$' + aguardando);
                    $("#valorUsuarios2").text(aguardandoContagem)
                    break;
                case "PAID_OUT":
                    $("#valorUsuarios6").text('R$' + aprovados);
                    $("#valorUsuarios2").text(aprovadosContagem)
                    break;
                case "Todos":
                    $("#valorUsuarios6").text('R$' + (aprovados + aguardando));
                    $("#valorUsuarios2").text(aprovadosContagem + aguardandoContagem)
                    break;
            }
            
        });

        
    });


    function getSelectedValue() {
        return $("#selectedStatus").val();
    }
    $(document).ready(function () {
    // Evento de mudança no elemento select
    $('#selectedStatus').on('change', function () {
        
        var startDate = new Date($('#startDate').val());
        var endDate = new Date($('#endDate').val());
        
        var selectedStatus = $("#selectedStatus").val();
        var depositosN = @json($depositosRealizados);
        var valor = 0;
        var depositos = filtrarDepositosPorData(depositosN, startDate, endDate);

        var somaTotal = depositos.reduce((acumulador, objeto) => {

            const status = objeto.status;
            acumulador[status] = (acumulador[status] || 0) + parseFloat(objeto.valor);
            return acumulador;

        }, {})

        var somaTotalValores = depositos.reduce((acumulador, objeto) => {

        const status = objeto.status;
        acumulador[status] = (acumulador[status] || 0) + 1;
        return acumulador;

        }, {})
        
        var aprovados = parseFloat(somaTotal['PAID_OUT'] || 0);
        var aguardando = parseFloat(somaTotal['WAITING_FOR_APPROVAL'] || 0)

        var aprovadosContagem = parseFloat(somaTotalValores['PAID_OUT'] || 0);
        var aguardandoContagem = parseFloat(somaTotalValores['WAITING_FOR_APPROVAL'] || 0)

        switch(selectedStatus){
            case "WAITING_FOR_APPROVAL":
                $("#valorUsuarios6").text('R$' + aguardando);
                $("#valorUsuarios2").text(aguardandoContagem)
                break;
            case "PAID_OUT":
                $("#valorUsuarios6").text('R$' + aprovados);
                $("#valorUsuarios2").text(aprovadosContagem)
                break;
            case "Todos":
                $("#valorUsuarios6").text('R$' + (aprovados + aguardando));
                $("#valorUsuarios2").text(aprovadosContagem + aguardandoContagem)
                break;
        }
    });
});

</script>

<script>
  $(document).ready(function () {
    // Inicializar a tabela DataTable
    var table = $('#user-table').DataTable({
        order: [[0, 'desc']]  // Ordenar pela primeira coluna (índice 0) de forma descendente
    });

    // Adicione um identificador ao seu campo de entrada
    var statusSelect = $('#selectedStatus');
    statusSelect.val('');

    // Adicione um evento para reagir a mudanças no campo de entrada
    statusSelect.on('change', function () {
        // Obter o valor selecionado
        var statusValue = statusSelect.val();

        // Limpar o corpo da tabela
        table.clear().draw();

        // Recarregar os dados da tabela com o novo valor de status
        loadData(statusValue, table);
    });

    function filtrarDepositosPorData(depositosN, startDate, endDate) {
            
            function extrairData(dataString){
            return new Date(dataString);
            }
            startDate.setDate(startDate.getDate()+1)
            endDate.setDate(endDate.getDate()+1)
            console.log(startDate)
            return depositosN.filter((objeto) => extrairData(objeto.created_at) >= startDate && extrairData(objeto.created_at) <= endDate)

    }

    function loadData(status, dataTable) {
                var data = @json($depositosRealizados);

                var startDate = new Date($('#startDate').val());
                var endDate = new Date($('#endDate').val());
                
                data.forEach(function (row) {
                    var rowCriado = new Date(row.created_at)
                    var dataFormatada = rowCriado.toLocaleString('pt-BR', { timeZone: 'UTC'})
                    if(row.status === status){
                        var statusClass = (row.status === 'Aprovado') ? 'text-success' : 'text-black';
                        dataTable.row.add([
                        dataFormatada,
                        row.email,
                        row.external_reference,
                        row.valor,
                        row.status
                    ]).draw();
                    } else if (status === 'Todos') {
                        var statusClass = (row.status === 'Aprovado') ? 'text-success' : 'text-black';
                        dataTable.row.add([
                        dataFormatada,
                        row.email,
                        row.external_reference,
                        row.valor,
                        row.status
                    ]).draw();
                    }
                       
                });

       
    }

    // Chame a função loadData inicialmente para carregar todos os dados
    loadData('');
});


</script>





<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>







      
        <footer class="footer text-center">
        Melhorado por Jonathan Santos
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
