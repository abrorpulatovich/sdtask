<?php

/* @var $this yii\web\View */
$this->title = 'Hisobot';

?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="row">
    <div class="col-md-8">
        <h3>Hisobot</h3>
    </div>
    <div class="col-md-4">
        <br>
        <input type="text" name="filter_dates" id="filter_dates" class="form-control">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <?php if($from and $to): ?>
            <p class='text-danger'><?= $from . ' - ' . $to; ?></p>
        <?php else: ?>
            <p class='text-danger'><b>Bugun</b></p>
        <?php endif ?>
        <table class='table table-striped table-bordered'>
            <tbody>
                <?php if(count($data) > 0): ?>
                    <?php 
                        $inc = 1;
                        $all_income = 0;
                        $all_cost = 0;
                        $all_profit = 0;
                    ?>
                    <?php foreach($data as $item): ?>
                        <tr>
                            <td><?= $inc ?></td>
                            <td><?= date('d/m/y H:i', strtotime($item['sell_date'])) ?></td>
                            <td><?= $item['product_name'] . (($item['product_batch_number'])? ' (' . $item['product_batch_number'] . ')': ' (<span class="text-danger"><i>Partiya raqami qiymatlanmagan</i></span>)') ?></td>
                            <td align='right'><?= number_format($item['sell_price'] * $item['sell_quantity'], 2) ?></td>
                            <td align='right'><?= number_format($item['product_price'] * $item['sell_quantity'], 2) ?></td>
                            <td align='right'><?= number_format(($item['sell_price'] * $item['sell_quantity']) - ($item['product_price'] * $item['sell_quantity']), 2) ?></td>
                        </tr>
                    <?php 
                        $inc += 1;
                        $all_income += ($item['sell_price'] * $item['sell_quantity']);
                        $all_cost += ($item['product_price'] * $item['sell_quantity']);
                        $all_profit += (($item['sell_price'] * $item['sell_quantity']) - ($item['product_price'] * $item['sell_quantity']));
                    ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td class='text-center text-danger' colspan='6'>Ma'lumot yo'q</td>
                    </tr>
                <?php endif ?>
            </tbody>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Sana</th>
                    <th>Maxsulot</th>
                    <th>Daromad(so'm)</th>
                    <th>Xarajat(so'm)</th>
                    <th>Foyda(so'm)</th>
                </tr>
                <?php if(count($data) > 0): ?>
                    <tr class="bg-warning">
                        <td colspan="3" align='right'><b>Jami: </b></td>
                        <td align='right'><b><?= number_format($all_income, 2) ?></b></td>
                        <td align='right'><b><?= number_format($all_cost, 2) ?></b></td>
                        <td align='right'><b><?= number_format($all_profit, 2) ?></b></td>
                    </tr>
                <?php endif ?>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    $('input[name="filter_dates"]').daterangepicker({
    //   autoUpdateInput: false,
      locale: {
          cancelLabel: 'Tozalash',
          applyLabel: "Qo'llash",
      }
  });
</script>

<script type="text/javascript">
    $('#filter_dates').change(function() {
        var range_dates = $(this).val();
        location.href = "/report/product?range_dates=" + range_dates;
    });
</script>
