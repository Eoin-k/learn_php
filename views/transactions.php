<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($transactions)): ?>
                <?php foreach($transactions as $transaction): ?>
                    <tr>
                        <td> <?php echo formatDate($transaction['date']) ?> </td>
                        <td> <?php echo $transaction['checkNumber'] ?> </td>
                        <td> <?php echo $transaction['description'] ?> </td>
                        <td> <?php if ($transaction['amount'] < 0): ?>
                            <span style="color:red"><?php echo formatDollarAmount($transaction['amount']) ?> </span>
                            <?php else :?>
                                <span style="color:green"><?php echo formatDollarAmount($transaction['amount']) ?></span>
                             </td>
                    </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                    <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td> <?php echo formatDollarAmount($totals['totalIncome'])?>
                        </td>
                        
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?php echo formatDollarAmount($totals['totalExpense'])?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>
                    <?php if ($totals['netTotal'] < 0): ?>
                        <span style="color:red"><?php echo formatDollarAmount($totals['netTotal'])?></span>
                        <?php else : ?>
                        <span style="color:green"><?php echo formatDollarAmount($totals['netTotal'])?></span>
                        </td>
                </tr>
                <?php endif ?>
            </tfoot>
        </table>
    </body>
</html>
