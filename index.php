<?php
include 'apicnjClass.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js'></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js'></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="scripts/index.js?<?php echo time() ?>"></script>
    
        
        <title>Consulta processual</title>
    
    </head>
    <body>
        <header>
        </header>
        <main>
            <div class="container text-center">
                <div class="row align-items-start">
                    <div class="justify-content-center row">
                        <div class="col-6 card" style="padding: 0;">
                            <div class="card-header">
                                Busca de informações processuais
                            </div>
                            <div class="mb-3" id="campo_erro">      
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="numeroCNJ" class="form-label">Número CNJ</label>
                                    <input type="text" class="form-control" id="numeroCNJ">
                                </div>
                                <div class="mb-3">
                                    <button type="buton" id="botaoConsulta" class="btn btn-primary" data-acao="consulta">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="resultadoProcesso" style="margin: 15px">
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>