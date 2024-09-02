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
                <td>Concepto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td class="text-right">Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($d->items as $item):?>
            <tr>
                <td><?php echo $item->concept; ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><?php echo '$'.number_format($item->price); ?></td>
                <td class="text-right"><?php echo '$'.number_format($item->total); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="text-right" colspan="3">Subtotal</td>
                <td class="text-right"><?php echo '$'.number_format($d->subtotal);?></td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Impuestos</td>
                <td class="text-right"><?php echo '$'.number_format($d->taxes);?></td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Envio</td>
                <td class="text-right"><?php echo '$'.number_format($d->shipping);?></td>
            </tr>
            <tr>
                <td class="text-right" colspan="4"><b>Total</b>
                    <h3 class="text-success"><b><?php echo '$'.number_format($d->total);?></b></h3>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>