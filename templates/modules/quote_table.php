<?php if (empty($d->items)): ?>
    <div class="text-center">
        <h3>La cotización está vacía.</h3>
        <img src="<?php echo IMG.'empty.png'?>" alt="Sin Contenido" class="img-fluid" width="150px">
    </div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-hover table-striped table-borderer">
        <thead>
            <tr>
                <th class="text-center">Acción</th>
                <th class="text-center">Concepto</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($d->items as $item):?>
            <tr>
                <td>
                    <div class="button-group">
                        <button class="btn btn-sm btn-success edit_concept" data-id="<?php echo $item->id;?>" >Editar</button>
                        <button class="btn btn-sm btn-danger delete_concept" data-id="<?php echo $item->id;?>" >Borrar</button>
                    </div>
                </td>
                <td class="text-right">
                    <?php echo $item->concept; ?>
                    <small class="text-muted d-block"><?php echo $item->type === '105' ? 'IVA del 10.5%' : 'IVA del 21%'; ?></small>
                </td>
                <td class="text-end"><?php echo '$'.number_format($item->price, 2); ?></td>
                <td class="text-center"><?php echo $item->quantity; ?></td>
                <td class="text-end"><?php echo '$'.number_format($item->total, 2); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="text-end" colspan="4"><h6>Subtotal</h6></td>
                <td class="text-end"><?php echo '$'.number_format($d->subtotal, 2);?></td>
            </tr>
            <tr>
                <td class="text-end" colspan="4"><h6>Impuestos</h6></td>
                <td class="text-end"><?php echo '$'.number_format($d->taxes, 2);?></td>
            </tr>
            <tr>
                <td class="text-end" colspan="4"><h6>Envio</h6></td>
                <td class="text-end"><?php echo '$'.number_format($d->shipping, 2);?></td>
            </tr>
            <tr>
                <td class="text-center" colspan="5"><b>Total</b>
                    <h3 class="text-success"><b><?php echo '$'.number_format($d->total, 2);?></b></h3>
                    <small class="text-muted"><?php echo sprintf('Impuestos incluidos %s%% IVA', TAXES_RATE)?></small>    
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>