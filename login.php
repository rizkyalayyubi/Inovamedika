<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default"  style="width:300px; valign">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pegawai</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="?page=Login-Validasi" method="post" id="form1">
                            <fieldset>
        <input class="form-control" name="txtUser" placeholder="Username" type="text" size="30" maxlength="20" /><br/>
        <input class="form-control" name="txtPassword" placeholder="Username" type="password" size="30" maxlength="20" /><br/>
        <select class="form-control" name="cmbLevel">
        <option value="KOSONG">....</option>
        <?php
        $pilihan = array("Klinik", "Apotek", "Admin");
        foreach ($pilihan as $nilai) {
          if ($_POST['cmbLevel']==$nilai) {
            $cek="selected";
          } else { $cek = ""; }
          echo "<option value='$nilai' $cek>$nilai</option>";
          }?>
        </select><br/>
      <input type="submit" name="btnLogin" class="btn btn-lg btn-success btn-block"value=" Login " />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
