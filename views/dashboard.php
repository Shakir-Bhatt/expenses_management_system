
<div class="col-md-12 col-sm-12">
  <div style="margin-top: 2px;">
    <div class="jumbotron" style="padding: 2rem 4rem !important;">
      <h3> Item Detail Page</h3>         
      <div class="table-responsive">
          <table class="table table-bordered table-hover" id="transactionTable">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Spent</th>
                    <th>Total Amount</th>
                    <th>Credit/Debit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- udpated with ajax -->
            </tbody>
          </table>
      </div>
      <hr style="background: grey;height: 3px;">
      <h3> Item Detail</h3>         
      <div class="table-responsive">
          <table class="table table-bordered table-hover" id="expensesTable">
            <thead>
                <tr>
                  <!-- <th>User Id</th> -->
                  <th>User</th>
                  <th>Item And Prices</th>
                  <th>Total Price</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
              <!-- udpated with ajax -->
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="transactionModal">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <span><h4 class="modal-title">Add Transction Amount</h4><small>Check user to pay amount</small></span>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          <form id="transaction-form">
            <!--  Updated by ajax -->
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="payAmount(this,'#transaction-form');">Save</button>
        </div>

    </div>
  </div>
</div>
