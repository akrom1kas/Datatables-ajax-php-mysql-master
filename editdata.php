<form method="post" id="user_form">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div id="alert_message"></div>
            <div class="modal-body">
                <label>Vardas</label>
                <input type="text" name="vardas" id="vardas" class="form-control" />
                <br />
                <label>Epastas</label>
                <input type="text" name="epastas" id="epastas" class="form-control" />
                <br />
                <label>Zinute</label>
                <input type="text" name="zinute" id="zinute" class="form-control" />
                <br />
                <label>Ip</label>
                <input type="text" minlength="7" maxlength="15" placeholder="xxx.xxx.xxx.xxx" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" name="ip" id="ip" class="form-control" />
                <br />
                <label>Laikas</label>
                <input type="datetime-local" name="laikas" id="laikas" class="form-control" required/>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" id="user_id" />
                <input type="hidden" name="operation" id="operation" />
                <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>