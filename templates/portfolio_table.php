<tr class="table-row">
        <td><?= $symbol ?></td>
        <td><?= $company ?></td>
        <td><?= $shares ?></td>
        <td>$<?= $cprice ?></td>
        <td>$<?= $value ?></td>
        <td><form action="sell.php" method="post">
            <fieldset>
                    <input type="hidden" name="symbol" value="<?=$symbol?>"/>
                    <input type="hidden" name="shares" value="<?=$shares?>"/>
                    <input type="hidden" name="cprice" value="<?=$cprice?>"/>
                    <button type="submit" name="ask" class="btn btn-default">Sell</button>
            </fieldset>
        </form></td>
</tr>



