<div class="container">
    <div class="row">
        <form  role="form" class="col-md-9" action="." method="post">
            <h2>Create a Question</h2>
            <div class="form-group">
                <label for="question">Question</label>
                <input id="question" name="question" type="text" class="form-control" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="answers">Answers</label>
                <textarea id="answers" name="answers" rows="5" class="form-control" required></textarea>
            </div>
            <div class="form-group-sm pull-right">
                <input class="btn btn-success btn-lg" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>