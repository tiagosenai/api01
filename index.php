<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1,0">


    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="DataTables/Buttons-1.6.2/css/buttons.jqueryui.css">
    <link rel="stylesheet" type="text/css" href="DataTables/Buttons-1.6.2/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="DataTables/Buttons-1.6.2/css/buttons.bootstrap4.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <title>Pesquisa Contribuintes</title>
</head>
<body>



<div class="container-fluid">
    <br>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Inscrição;</th>
        <th>Nome Empresarial/Nome;</th>
        <th>Número do CNPJ/CPF;</th>
        <th>Data Homologação;</th>
        <th>Código CNAE Principal;</th>
        <th>Nome Município;</th>
    </tr>
    </thead>


    <tbody>

    <?php

    $data_parametro = '2020-11-21';

    $arquivo = fopen ('H01', 'r');
    while(!feof($arquivo)){
        $linha = fgets($arquivo, 1024);
        $inscricao = substr($linha, 0,8);
        $nome = substr($linha,9, 59);
        $cnpj = substr($linha, 59, 14);
        $data = substr($linha, 73, 8);
        $d = substr($data, 0,2);
        $m = substr($data, 2,2);
        $ano = substr($data, 4,4);
        $data = $ano.'-'.$m.'-'.$d;
        $cnae = substr($linha, 81, 7);
        $municipio = substr($linha, 88, 95);

        if (strtotime($data) >= (strtotime($data_parametro))){
            $novaData = new DateTime($data);
            $data = date_format($novaData, 'd/m/Y');

            echo'<tr>';
            echo'<td>'.$inscricao.'</td>';
            echo'<td>'.$nome.'</td>';
            echo'<td><a href="https://www.receitaws.com.br/v1/cnpj/'.$cnpj.'" target="_blank">'.$cnpj.'</a></td>';
            echo'<td>'.$data.'</td>';
            echo'<td>'.$cnae.'</td>';
            echo'<td>'.$municipio.'</td>';
            echo'</tr>';

        }
    }
    fclose($arquivo);


    ?>

    </tbody>
</thead>
</table>
</div>

<script type="text/javascript" src="DataTables/DataTables-1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.2/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.2/js/buttons.jqueryui.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.2/js/buttons.flash.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.2/js/buttons.html5.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.2/js/buttons.print.js"></script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="DataTables/JSZip-2.5.0/jszip.js"></script>



<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('#example').DataTable( {

            language:{
                url:'Portuguese-Brasil.json'
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copiar'
                },
                'csv', 'excel', 'pdf',
                {
                    extend: 'print',
                    text: 'Imprimir'
                }
            ]
        }
        );
    } );
</script>



<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>