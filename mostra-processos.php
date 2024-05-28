
<div class="accordion" id="accordionExample">
    <?php
    foreach ($retornoDadosProcesso[0]->hits->hits as $contador => $registros) { ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $contador ?>" aria-expanded="false" aria-controls="collapse<?php echo $contador ?>">
            <?php
            if ($registros->_source->grau == 'G1') {
                echo "1a instância - " . $registros->_source->classe->nome;
            } else if ($registros->_source->grau == 'G2'){
                echo "2a instância";
            } else if ($registros->_source->grau == 'JE'){
                echo "Juizado Especial";
            } else {
                echo "Não definido";
            }
            ?>
                - Movimentação
            </button>
            </h2>
            
            <div id="collapse<?php echo $contador ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row align-items-start">
                        <div class="col">
                            <p><b>Tipo de processo: </b> <?php echo $registros->_source->classe->nome . " (" . $registros->_source->classe->codigo . ")" ?></p>
                        </div>
                        <div class="col">
                            <p><b>Formato do processo: </b> <?php echo $registros->_source->formato->nome ?></p>
                        </div>
                        <div class="col">
                            <p><b>Data de instauração nesta instância:</b> <?php 
                            $dataAjuizamento = new datetime($registros->_source->dataAjuizamento);
                            echo $dataAjuizamento->format('d/m/Y') 
                            ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        foreach ($registros->_source->movimentos as $movimentacao) { 
                            echo "<hr>";
                            $dataMovimentacao = '';
                            $dataMovimentacao = new datetime ($movimentacao->dataHora);
                            echo $dataMovimentacao->format('d/m/Y');
                            ?>
                            <p> <?php echo $movimentacao->nome ?> (
                            <?php 
                            if (isset($movimentacao->complementosTabelados[0])) {
                                foreach ($movimentacao->complementosTabelados as $complementoMovimentacao) {
                                    echo $complementoMovimentacao->descricao . " - " . $complementoMovimentacao->nome;
                                }
                            } 
                            ?>
                            )
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>