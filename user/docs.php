<!DOCTYPE html>
<html>
<head>
  <title>Upload Form</title>
</head>
<body>
<form action="../component/php/surat_upload.php" method="POST" enctype="multipart/form-data">
              <div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Nama Baru Anda</label>
								  	<input type="text" class="form-control" name="nama_baru">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                <label>Surat Permohonan Anda</label>
                <input type="file" name="docx_file" accept=".pdf">
                </div>
							</div>
						</div>
						<div>
							<input id="submit" type="submit" value="Kirim" name="kirim_surat" class="btn btn-primary">
							<input type="submit" value="Batal" name="cancel_nama" class="btn btn-light">
						</div>
            </form>
</body>
</html>
