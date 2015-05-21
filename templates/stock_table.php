            <table class="table">
                        <tr class="table-title-row"><td>Stock Symbol</td><td>Company Name</td><td>Price</td></tr>
                        <tr class="table-row">
                        <td><?php echo(strtoupper($stock["symbol"]))?></td>
                        <td><?php echo($stock["name"])?></td>
                        <td>$<?php echo(number_format($stock["price"], 2,'.',''))?></td>
                        <td><form action="buy.php" method="post">
                                <fieldset>
                                        <input type="hidden" name="symbol" value="<?=$stock['symbol']?>"/>
                                        <input type="hidden" name="cprice" value="<?=$stock['price']?>"/>
                                        <button type="submit" name="ask" class="btn btn-default">Buy</button>
                                </fieldset>
                            </form></td>
                        </tr>
            </table>
            

