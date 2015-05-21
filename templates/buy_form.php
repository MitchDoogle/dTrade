        <p>You are about to buy the stock below. Please check everything to make sure it is correct.</p>
        <table class="table">
                        <tr class="table-title-row"><td>Stock Symbol</td><td>Shares</td><td>Current Price</td></tr>
                        <tr class="table-row"><td><?php echo(strtoupper($stock["symbol"]))?></td>
                        <td><form action="buy.php" method="post">
                            <fieldset>
                                <input name="shares" type="text" placeholder="No. of Shares"/></td>
                        <td>$<?php echo($stock["cprice"])?></td></tr>
        </table>
        <p>After clicking "I agree" this action cannot be undone.</p>
        
        
                <div class="form-group">
                    <input type="hidden" name="symbol" value="<?php echo(strtoupper($stock['symbol']))?>"/>
                    <input type="hidden" name="price" value="<?php echo(number_format($stock['cprice'],2,'.',''))?>">
                    <button type="submit" name="buy" class="btn btn-default">I agree</button>
                </div>
            </fieldset>
        </form>
       
            
