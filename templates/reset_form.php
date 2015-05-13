<form action="reset.php" method="post">
    <fieldset>
		<input name="username" type="hidden" value="<?=$username?>"/>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Confirm Password" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Reset Password</button>
        </div>
    </fieldset>
</form>